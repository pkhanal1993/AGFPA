<?php
/*********************************************************
* This file provides a form for uploading the assignments
* 
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administration - upload new files</title>
</head>

<body>
	<h1>Upload new news files</h1>
	<form enctype="multipart/form-data" action="assignment_upload.php" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
			Upload this file: <input name="userfile" type="file">
		<input type="submit" value="Send File">
	</form>
</body>
</html>

