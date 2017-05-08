<?php 
	session_start(); 
?>
<!doctype html>

<html lang="en">
<head>	
	<meta charset="utf-8">
	
	<title>Co-op Evaluation Home</title>
	<meta name="description" content="Daniel Roberts Website">
	<meta name="author" content="Daniel Roberts">
	<meta name="viewport" content="width=device-width"/>
	
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
	function addCompany()
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

<body>
	<nav class="navbar navbar-default">
		
	</nav>	
	
	<?php if($_SESSION['loggedin'] == true) : ?>
	
	<!-- Add Company Modal -->
	<div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<h2 class="modal-title" id="addCompanyModal">Add Company</h2>
		  </div>
		  <div class="modal-body">
			<form method="post" action="functions.php?function=addCompany">
				<div class="form-group">
					<label for="name">Company Name</label>
					<input class="form-control" type="text" id="name" name="name" required ></input>
				</div>
				<div class="form-group">
					<label for="name">Address</label>
					<input class="form-control" type="text" id="address" name="address"></input>
				</div>
				<input class="btn btn-primary" type="submit" value="Submit" name="SaveForm"/>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			</form>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Main page content -->
	<div class="container" align="Center">
		<div class="container loggedInHeader">
			<h1>Co-op Evaluation System</h1>
			<h3>Welcome <?php echo ($_SESSION['userInfo']['USERNAME']) ?></h3>
			<a href="logout.php"><button class="btn btn-primary">Sign Out</button></a>
			<button class="btn btn-primary" data-toggle="modal" data-target="#addCompanyModal">Add Company</button>
		</div>
		<div class="container allCompanies" align="center">
			<?php
			
				$url = 'http://vm344f.se.rit.edu/API/API.php?team=coop_eval&function=getCompanies&StudentID=' . $_SESSION['userInfo']['ID'];
				
				$ch = curl_init( $url );
				
				$timeout = 5;
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

				$response = curl_exec( $ch );
				$data = json_decode($response, true);
				
				curl_close($ch);
				
				if ($data)
				{
					$_SESSION['companyInfo'] = $data;
					
					echo '<h1>Companies</h1>';
					foreach ($data as $arr)
					{
						echo '
							<div class="company">
								<h3>Name: ' . $arr['NAME'] . '</h3>
								<h3>Address: ' . $arr['ADDRESS'] . '</h3>		
						';
						
						$sid = $_SESSION['userInfo']['ID'];
						$cid = $arr['ID'];
						
						echo '
						<h3><a href="http://vm344f.se.rit.edu/Website/functions.php?function=loadStudentForm&studentID='.$sid.'&companyID='.$cid.'"/>Evaluation</h3>
						';
						echo "</div>";
					}
				}
			
			?>
		</div>
		
	</div>
	
	
	<?php else : ?>
	<div class="container" align="Center">
		<form method="POST" id="login" action="login.php">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" placeholder="Username" name="username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password" name="password">
			</div>
			<button class="btn btn-primary" type="submit">Sign In</button>			
		</form>
	</div>
	
	
	<?php endif; ?>
		
	<div align="center">
	  <footer>Email: <a href="mailto:djr9478@rit.edu" target="_top">djr9478@rit.edu </a> &copy TeamCoopEval</footer>
	</div>	
	
</body>
</html>

