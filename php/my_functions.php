<?php
/*****************************************
** This function connects to a given database
** Return the database resource
*********************************************
*/
function connect_to_database($serverName, $database_name, $userName, $password){
	try {
			$dbh = new PDO("mysql:host=$serverName; dbname=$database_name", $userName, $password);
			echo 'Connected to database<br><br>';
			return $dbh;
		
		}

		catch(PDOException $e)
		{
			echo $e ->getMessage();
		}
}

/*###########################################################################################################*/

/********************************************************************
** This functions checks the provided credentials
** and returns true or false
*********************************************************************
*/
function check_validity($userName, $password, $userType, $db){
	//prepare a query statement
	$query = $db->prepare("SELECT * FROM $userType where BINARY userName=:usrName and BINARY password=:pwd");

	//Bind parameters to the query variables
	$query->bindParam(':usrName', $userName);
	$query->bindParam(':pwd', $password);

	// execute the prepared query statement
	$query->execute();

	// fetch the results in the form of an array
	$result = $query->fetchAll();

	//Return the result of checking
	if (count($result) > 0){
		return true;
	}
	else{
		return false;
	}

}

/*##########################################################################################################*/

/**********************************************************************
** This function returns the user id for a given user name and type
***********************************************************************
*/
function get_user_id($userName, $userType, $db){
	//prepare a query statement
	$query = $db->prepare("SELECT $userType.Id from $userType where BINARY userName=:usrName");

	//Bind parameters to the query variable
	$query->bindParam(':usrName', $userName);

	echo $query;

	//execute the prepared statement
	$query->execute();

	//fetch the results in the form of an arrya
	$result = $query->fetchAll();

	//return the user id
	return $result[0];
}





?>