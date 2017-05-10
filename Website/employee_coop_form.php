<?php
session_start();

if ($_SESSION['loggedin'] == true)
{
	$userValid = true;
}
else
{
	$userValid = false;
	
	$url = "http://vm344f.se.rit.edu/Website/functions.php?function=generateTempLink&companyID=".$_GET['companyID']."&studentID=".$_SESSION['userInfo']['ID'];
			
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
	}
	
	curl_close($ch);
}
?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Employer  Coop Evaluation</title>
  
  <!-- External CSS -->
	<link rel="stylesheet" href="home.css">
	
	<!-- JQuery -->
	<script
		src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous">
	</script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
	<script>
	function loadFromStorage()
	{
		var eid = document.getElementById("employeeID").value;
		var cid = document.getElementById("companyID").value;
		
		var url = "http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getEmployerEvaluation&employeeID=" + eid + "&companyID=" + cid;
	
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var data = JSON.parse(xmlHttp.responseText);
				if (data.length > 0)
				{		
					document.getElementById("name").value = data[0].NAME;
					document.getElementById("email").value = data[0].EMAIL;
					document.getElementById("sname").value = data[0].SNAME;
					document.getElementById("semail").value = data[0].SEMAIL;
					document.getElementById("position").value = data[0].POSITION;
					$("input[name=q1][value=" + data[0].QUESTION1 + "]").prop("checked",true);
					document.getElementById("q2").value = data[0].QUESTION2;
					document.getElementById("q3").value = data[0].QUESTION3;
					$("input[name=q4][value=" + data[0].QUESTION4 + "]").prop("checked",true);
					$("input[name=q5][value=" + data[0].QUESTION5 + "]").prop("checked",true);
				}
			}
		};
		
		xmlHttp.open( "GET", url, true ); // false for synchronous request
		xmlHttp.send();
	}

    function loadTempFromStorage()
    {
        var sid = document.getElementById("employeeID").value;
        var cid = document.getElementById("companyID").value;

        var url = "http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getEmployerEvaluation&employeeID=" + eid + "&companyID=" + cid;

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(xmlHttp.responseText);
                if (data.length > 0)
                {
                    document.getElementById("name").value = data[0].NAME;
                    document.getElementById("email").value = data[0].EMAIL;
                    document.getElementById("sname").value = data[0].SNAME;
                    document.getElementById("semail").value = data[0].SEMAIL;
                    document.getElementById("position").value = data[0].POSITION;
                    $("input[name=q1][value=" + data[0].QUESTION1 + "]").prop("checked",true);
                    document.getElementById("q2").value = data[0].QUESTION2;
                    document.getElementById("q3").value = data[0].QUESTION3;
                    $("input[name=q4][value=" + data[0].QUESTION4 + "]").prop("checked",true);
                    $("input[name=q5][value=" + data[0].QUESTION5 + "]").prop("checked",true);
                }
            }
        };

        xmlHttp.open( "GET", url, true ); // false for synchronous request
        xmlHttp.send();
    }

	function onFormChange()
	{	
		var input = document.getElementById("name");
		localStorage.setItem("name", input.value)
	
		input = document.getElementById("email");
		localStorage.setItem("email", input.value);
		
		input = document.getElementById("sname");
		localStorage.setItem("sname", input.value);
		
		input = document.getElementById("semail");
		localStorage.setItem("semail", input.value);
		
		input = document.getElementById("position");
		localStorage.setItem("position", input.value);
		
		input = $('input[name=q1]:checked').val()
		localStorage.setItem("q1", input.value);
		
		input = document.getElementById("q2");
		localStorage.setItem("q2", input.value);
		
		input = document.getElementById("q3");
		localStorage.setItem("q3", input.value);
		
		input = $('input[name=q4]:checked').val()
		localStorage.setItem("q4", input.value);
		
		input = $('input[name=q5]:checked').val()
		localStorage.setItem("q5", input.value);
		
	}
	
	function saveForm()
	{
		$url = "http://vm344f.se.rit.edu/Website/functions.php?function=submitEmployeeForm&save=true";
	
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log(xmlHttp.responseText);
			}
		};
		
		xmlHttp.open( "POST", $url, true ); // false for synchronous request
		xmlHttp.send();
	}
	function clearStorage()
	{
		localStorage.clear();
	}
	</script>
</head>

<body onload="loadFromStorage()" onunload="clearStorage()">
<div class="container">
	<h1>Employer Coop Evaluation</h1>
	<form method="post" action="functions.php?function=submitEmployeeForm">
	<?php
	//get and set company and student ID
	echo '
	<div class="form-group">
		<input id="employeeID" name="employeeID" type="hidden" value="'.$_GET['employeeID'].'"></input>
	</div>
	';
	echo '
	<div class="form-group">
		<input id="companyID" name="companyID" type="hidden" value="'.$_GET['companyID'].'"></input>
	</div>
	';
	?>
	<div class="form-group">
		<label for="name">Name</label>
		<input class="form-control" type="text" id="name" name="name" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input class="form-control" type="email" id="email" name="email" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="ename">Student Name</label>
		<input class="form-control" type="text" id="sname" name="sname" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="eemail">Student Email</label>
		<input class="form-control" type="email" id="semail" name="semail" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="position">Company Position</label>
		<input class="form-control" type="text" id="position" name="position" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="q1">How would you rank his or her overall performance?</label><br>
		<label class="radio-inline"><input type="radio" name="q1" value="1">1</label>
		<label class="radio-inline"><input type="radio" name="q1" value="2">2</label>
		<label class="radio-inline"><input type="radio" name="q1" value="3">3</label>
		<label class="radio-inline"><input type="radio" name="q1" value="4">4</label>
		<label class="radio-inline"><input type="radio" name="q1" value="5">5</label>
	</div>
	<div class="form-group">
		<label for="q2">What did he or she work on during his or her Coop?</label>
		<textarea class="form-control" type="text" id="q2" name="q2" required onchange="onFormChange()"></textarea>
	</div>
	<div class="form-group">
		<label for="q3">Was he or she prepared for the tasks he or she was asked to perform?</label>
		<textarea class="form-control" type="text" id="q3" name="q3" required onchange="onFormChange()"></textarea>
	</div>
	<div class="form-group">
		<label for="q4">How would you rate his or her work habits?</label><br>
		<label class="radio-inline"><input type="radio" name="q4" value="1">1</label>
		<label class="radio-inline"><input type="radio" name="q4" value="2">2</label>
		<label class="radio-inline"><input type="radio" name="q4" value="3">3</label>
		<label class="radio-inline"><input type="radio" name="q4" value="4">4</label>
		<label class="radio-inline"><input type="radio" name="q4" value="5">5</label>
	</div>
	<div class="form-group">
		<label for="q5">Would you ask him or her back given the opportunity?</label><br>
		<label class="radio-inline"><input type="radio" name="q5" value="Yes">Yes</label>
		<label class="radio-inline"><input type="radio" name="q5" value="No">No</label>
	</div>
	<input class="btn btn-primary" type="submit" value="Save" name="SaveForm" onclick="saveForm()"/>
	<input class="btn btn-primary" type="submit" value="Submit" name="SubmitForm"/>
	</form>
</div>
</body>
</html>