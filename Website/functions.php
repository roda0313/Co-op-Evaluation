<?php

if (isset($_GET['function']))
{
	switch($_GET['function'])
	{
		case "submitStudentForm":
			return submitStudentForm();
		case "submitEmployeeForm":
			return submitEmployeeForm();
		case "loadStudentForm":
			return loadStudentForm();
		case "loadEmployeeForm":
			return loadEmployeeForm();
		case "addCompany";
			return addCompany();
		case "handleTempLinkLoad":
			return handleTempLinkLoad();
		case "generateTempLink":
			return generateTempLink();
		default:
			return "An error occurred";
	}
}

//requires student id and company id
function loadStudentForm()
{
	$sid = $_GET['studentID'];
	$cid = $_GET['companyID'];
	header('Location: http://vm344f.se.rit.edu/Website/coop_form.php?studentID=' . $sid . '&companyID=' . $cid);
}

//requires employee id and company id
function loadEmployeeForm()
{	
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getEmployers&companyID='.$_GET['companyID'];
				
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
	
	if ($data != null)
	{
		$eid = $data[0]['ID'];
		$cid = $_GET['companyID'];
		header('Location: http://vm344f.se.rit.edu/Website/employee_coop_form.php?employeeID=' . $eid . '&companyID=' . $cid);
	}
	else
	{
		echo "An error occurred... go back and try again"; //change this eventually
	}
	
}

function submitStudentForm()
{
	
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getStudentEvaluation&studentID=' . $_POST['studentID'] . "&companyID=" . $_POST['companyID'];
				
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
	
	if ($data == null) //no evaluation exists, add new one
	{
		$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=addStudentEvaluation';
			
		$ch = curl_init( $url );
		
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$response = curl_exec( $ch );
		$data = json_decode($response, true);
		
		curl_close($ch);
	}
	else //evaluation exists, update
	{
		$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=updateStudentEvaluation';
			
		$ch = curl_init( $url );
		
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$response = curl_exec( $ch );
		$data = json_decode($response, true);
		
		curl_close($ch);
	}
	
	if (isset($_GET['save']))
	{
		//header("Location: coop_form.php?studentID=" . $_POST['studentID'] . "&companyID=" . $_POST['companyID']);
	}
	else
	{
		
		header("Location: home.php");
	}

}

function submitEmployeeForm()
{
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getEmployerEvaluation&employeeID=' . $_POST['employeeID'] . "&companyID=" . $_POST['companyID'];
				
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
	
	if ($data == null) //no evaluation exists, add new one
	{
		$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=addEmployerEvaluation';
			
		$ch = curl_init( $url );
		
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$response = curl_exec( $ch );
		$data = json_decode($response, true);
		
		curl_close($ch);
	}
	else //evaluation exists, update
	{
		$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=updateEmployerEvaluation';
			
		$ch = curl_init( $url );
		
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$response = curl_exec( $ch );
		$data = json_decode($response, true);
		
		curl_close($ch);
	}
	
	if (isset($_GET['save']))
	{
		//header("Location: employee_coop_form.php?employeeID=" . $_POST['employeeID'] . "&companyID=" . $_POST['companyID']);
	}
	else
	{
		header("Location: home.php");
	}
}

function addCompany()
{
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=addCompany';
			
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
	
	//get companies so we can get the last added company
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getCompanies';
			
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
	
	$_POST['companyID'] = end($data)['ID'];
	addEmployer();
	
	header("Location: home.php");
}

function addEmployer()
{
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=addEmployer';
			
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
}

function handleTempLinkLoad()
{
	$link = $_GET['link'];
	
	$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=addEmployer';
			
	$ch = curl_init( $url );
	
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$response = curl_exec( $ch );
	$data = json_decode($response, true);
	
	curl_close($ch);
}

function getEmployerEval(){
    $cid = $_GET['companyID'];
    $sid = $_GET['studentID'];
    $templink = $_GET['temporaryLink'];
    $link = $_GET['link'];

    //checks link data with temp link entry in database
    $url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getTempLink&studentID=' . $sid . '&companyID=' . $cid;

    $ch = curl_init( $url );

    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $response = curl_exec( $ch );
    $data = json_decode($response, true);

    if ($data != null)
    {

        if ($templink === true){
            $thelink = end($data)['LINK'];
            if($thelink === $link){

                //checks if link has hit access cap
                $url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=isTempLinkAccessCountReached&accessCap=5&studentID=' . $sid . '&companyID=' . $cid;

                $ch0 = curl_init( $url );

                $timeout = 5;
                curl_setopt($ch0, CURLOPT_URL, $url);
                curl_setopt($ch0, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch0, CURLOPT_CONNECTTIMEOUT, $timeout);

                $response = curl_exec( $ch0 );
                $data = json_decode($response, true);

                curl_close($ch0);

                if($data === false) {

                    //gets employee eval form
                    $url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getEmployers&companyID=' . $cid;

                    $ch1 = curl_init($url);

                    $timeout = 5;
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);

                    $response = curl_exec($ch1);
                    $data = json_decode($response, true);

                    curl_close($ch1);

                    if ($data != null) {
                        $eid = $data[0]['ID'];
                        $cid = $_GET['companyID'];
                        header('Location: http://vm344f.se.rit.edu/Website/employee_coop_form.php?employeeID=' . $eid . '&companyID=' . $cid);
                    } else {
                        echo "An error occurred... go back and try again"; //change this eventually
                    }

                    //Temp link accessed called
                    $url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=tempLinkAccessed&studentID=' . $sid . '&companyID=' . $cid;

                    $ch2 = curl_init($url);

                    $timeout = 5;
                    curl_setopt($ch2, CURLOPT_URL, $url);
                    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, $timeout);

                    $response = curl_exec($ch2);
                    $data = json_decode($response, true);

                    curl_close($ch2);
                }

            }
        }
    }

    curl_close($ch);
}

//share the temporary link with student
function shareTempLink()
{
    $cid = $_GET['companyID'];
    $sid = $_GET['studentID'];

    $url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getTempLink&studentID=' . $sid . '&companyID=' . $cid;

    $ch = curl_init( $url );

    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $response = curl_exec( $ch );
    $data = json_decode($response, true);

    if ($data != null)
    {
        $link = end($data)['LINK'];
        $url = "http://vm344f.se.rit.edu/Website/functions.php?function=loadStudentForm&studentID='.$sid.'&companyID='.$cid.'&templink=true&link=".$link;
    }

    curl_close($ch);

    return $url;
}

function generateTempLink()
{
    $cid = $_GET['companyID'];
    $sid = $_GET['studentID'];

    $url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getTempLink&studentID=' . $sid . '&companyID=' . $cid;

    $ch = curl_init($url);

    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $response = curl_exec($ch);
    $data = json_decode($response, true);

    if ($data != null) {
        $link = end($data)['LINK'];
        $url = "http://vm344f.se.rit.edu/Website/employee_coop_form?link=" . $link;
    }

    curl_close($ch);

    return $url;
}


?>