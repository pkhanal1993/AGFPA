<?php
	//start session
	session_start();

	//required files
	require 'my_functions.php';

	//connect to the database
	$db = connect_to_database("127.0.0.1", "research", "root", "password");

	//get the data from POST
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	$userType = $_POST['userType'];

	//check if the credentials are correct and display appropriate messages
	if (check_validity($userName, $password, $userType, $db)){
		//store user info in session variables
		$_SESSION['userName'] = $userName;
		$_SESSION['userType'] = $userType;
		$_SESSION['userId'] = get_user_id($userName, $userType, $db);

		//Redirect to appropriate profile page
		if($userType =='instructor'){
			header("Location:instructor_profile.php");
		}
		else{
			header("Location:student_profile.php");
		}
	}
	else{
		echo "<br>Check your Credentials";
	}



?>
