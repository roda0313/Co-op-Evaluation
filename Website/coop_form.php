<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Student Coop Evaluation</title>
  
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/84/three.min.js" crossorigin="anonymous"</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
	<script>
		function loadFromStorage()
		{
			document.getElementById("name").value = localStorage.getItem("name")
			document.getElementById("email").value = localStorage.getItem("email");
			document.getElementById("ename").value = localStorage.getItem("ename");
			document.getElementById("eemail").value = localStorage.getItem("eemail");
			document.getElementById("position").value = localStorage.getItem("position");
			//document.getElementById("q1").value = localStorage.getItem("q1");
			document.getElementById("q2").value = localStorage.getItem("q2");
			document.getElementById("q3").value = localStorage.getItem("q3");
			//document.getElementById("q4").value = localStorage.getItem("q4");
			document.getElementById("q5").value = localStorage.getItem("q5");
		}
	
		function onFormChange()
		{	
			var input = document.getElementById("name");
			localStorage.setItem("name", input.value)
		
			input = document.getElementById("email");
			localStorage.setItem("email", input.value);
			
			input = document.getElementById("ename");
			localStorage.setItem("ename", input.value);
			
			input = document.getElementById("eemail");
			localStorage.setItem("eemail", input.value);
			
			input = document.getElementById("position");
			localStorage.setItem("position", input.value);
			
			//input = document.getElementById("q1");
			//localStorage.setItem("q1", input.value);
			
			input = document.getElementById("q2");
			localStorage.setItem("q2", input.value);
			
			input = document.getElementById("q3");
			localStorage.setItem("q3", input.value);
			
			//input = document.getElementById("q4");
			//localStorage.setItem("q4", input.value);
			
			input = document.getElementById("q5");
			localStorage.setItem("q5", input.value);
			
		}
		function saveForm()
		{
			$url = "http://vm344f.se.rit.edu/Website/functions.php?function=submitStudentForm&save=true";
		
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					console.log(xmlHttp.responseText);
				}
			};
			
			xmlHttp.open( "POST", $url, true ); // false for synchronous request
			xmlHttp.send();
		}
	</script>
</head>

<body onload="loadFromStorage()">

<?php
session_start();

//get and set company and student ID
echo '<input id="studentID" type="hidden" value="'.$_GET['studentID'].'>';
echo '<input id="companyID" type="hidden" value="'.$_GET['companyID'].'>';
?>

<div class="container">
	<h1>Student Coop Evaluation</h1>
	<form method="post" action="functions.php?function=submitStudentForm">
	<div class="form-group">
		<label for="name">Name</label>
		<input class="form-control" type="text" id="name" name="name" required onchange="onFormChange()" ></input>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input class="form-control" type="email" id="email" name="email" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="ename">Employee Name</label>
		<input class="form-control" type="text" id="ename" name="ename" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="eemail">Employee Email</label>
		<input class="form-control" type="email" id="eemail" name="eemail" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="position">Company Position</label>
		<input class="form-control" type="text" id="position" name="position" required onchange="onFormChange()"></input>
	</div>
	<div class="form-group">
		<label for="q1">How would you rank your Coop experience?</label><br>
		<label class="radio-inline"><input type="radio" name="q1" value="1">1</label>
		<label class="radio-inline"><input type="radio" name="q1" value="2">2</label>
		<label class="radio-inline"><input type="radio" name="q1" value="3">3</label>
		<label class="radio-inline"><input type="radio" name="q1" value="4">4</label>
		<label class="radio-inline"><input type="radio" name="q1" value="5">5</label>
	</div>
	<div class="form-group">
		<label for="q2">What did you work on during your Coop?</label>
		<textarea class="form-control" type="text" id="q2" name="q2" required onchange="onFormChange()"></textarea>
	</div>
	<div class="form-group">
		<label for="q3">What skills or experience did you gain from your Coop?</label>
		<textarea class="form-control" type="text" id="q3" name="q3" required onchange="onFormChange()"></textarea>
	</div>
	<div class="form-group">
		<label for="q4">How would you rate your Coop employers?</label><br>
		<label class="radio-inline"><input type="radio" name="q4" value="1">1</label>
		<label class="radio-inline"><input type="radio" name="q4" value="2">2</label>
		<label class="radio-inline"><input type="radio" name="q4" value="3">3</label>
		<label class="radio-inline"><input type="radio" name="q4" value="4">4</label>
		<label class="radio-inline"><input type="radio" name="q4" value="5">5</label>
	</div>
	<div class="form-group">
		<label for="q5">What comments do you have about you employers?</label>
		<textarea class="form-control" type="text" id="q5" name="q5" required onchange="onFormChange()"></textarea>
	</div>
		<input class="btn btn-primary" type="button" value="Save" name="SaveForm" onclick="saveForm()"/>
		<input class="btn btn-primary" type="submit" value="Submit" name="SubmitForm"/>
	</form>
</div>
</body>
</html>