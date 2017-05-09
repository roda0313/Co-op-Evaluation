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
	$eid = $_GET['employeeID'];
	$cid = $_GET['companyID'];
	header('Location: http://vm344f.se.rit.edu/Website/employee_coop_form.php?employeeID=' . $eid . '&companyID=' . $cid);
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
	
	header("Location: home.php");
}

?>