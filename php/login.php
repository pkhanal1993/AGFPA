<?php
	//start a session
	session_start();

?>
<!--
	***********************************************************************
	* Log in page for the automated grading of of programming assingments.
	* Checks for the active session.
	***********************************************************************
-->

<!DOCTYPE HTML>
<html>
<head>
	<title> Log In </title>

	<!-- code to include the bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>



<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 align="center"> Introduction to Programming </h2>
		</div>

		<div class="loginForm">
			<form name="loginForm" action="check_credentials.php" method="post">
				<h4> Select User Type </h4>
				<input type="radio" name="userType" value="student" checked> Student <br>
				<input type="radio" name="userType" value="instructor"> Instructor <br><br><br><br>
				User Name <input type="text" name="userName">
				Password <input type="password" name="password">
				<button name="submit" type="submit">Log In</button>
			</form>
		</div>
	</div>

</body>

</html>


