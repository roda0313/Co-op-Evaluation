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
	if (isset($_GET['save']))
	{
		echo "form will now save";
	}
	else
	{
		echo "hello this is a student submit form";
	}
}

function submitEmployeeForm()
{
	if (isset($_GET['save']))
	{
		echo "form will now save";
	}
	else
	{
		echo "hello this is a employer submit form";
	}
}

?>