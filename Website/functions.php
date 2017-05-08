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