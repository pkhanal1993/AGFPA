<?php
	//start session
	session_start();
	echo "<h2>Student Profile</h2>";

	//print user id
	echo $_SESSION['userId'];
	
?>