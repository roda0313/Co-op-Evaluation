<?php

if (isset($_GET['function']))
{
	switch($_GET['function'])
	{
		case "submitStudentForm":
			return submitStudentForm();
		case "submitEmployeeForm":
			return submitEmployeeForm();
		default:
			return "An error occurred";
	}
}

function submitStudentForm()
{
	if (isset($_GET['save'])
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
	if (isset($_GET['save'])
	{
		echo "form will now save";
	}
	else
	{
		echo "hello this is a employer submit form";
	}
}

?>