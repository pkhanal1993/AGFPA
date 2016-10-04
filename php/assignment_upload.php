<?php
	//start session
	session_start();

	$root_files_dir = '/home/pk619/Research/Scripts/';
	$target_dir = '/home/pk619/Research/Scripts/StudentPrograms/';
	$file_basename = basename($_FILES['userfile']['name'], ".java");
	//echo $file_basename."<br>";
	
	if ($_FILES['userfile']['error'] > 0)
		{
echo 'Problem: ';
switch ($_FILES['userfile']['error'])
{
case 1: echo 'File exceeded upload_max_filesize'; break;
case 2: echo 'File exceeded max_file_size'; break;
case 3: echo 'File only partially uploaded'; break;
case 4: echo 'No file uploaded'; break;
}
exit;
}

// put the file where we'd like it
$upfile = $target_dir.$_FILES['userfile']['name'];
//echo $upfile."<br>";

if (is_uploaded_file($_FILES['userfile']['tmp_name']))
{
	if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
	{
		echo 'Problem: Could not move file to destination directory';
		exit;
	}
}

else {
	echo 'Problem: Possible file upload attack. Filename:';
	echo $_FILES['userfile']['name'];
	exit;
}

// compile the uploaded file
exec("javac $upfile");

// Run the binary file created against the provided test cases
$testfile = $root_files_dir.'Tests/t_'.$file_basename.'.txt';
//echo $testfile;

$binary_file = $file_basename;

$execute = "java $binary_file < $testfile > result.txt"; 
//echo "<br>$execute";

exec("cd $target_dir && $execute");


// compare the output from user with expected output

// Get the contents of both user output, expected output, and test cases in arrays
$fp_user_output = file("/home/pk619/Research/Scripts/StudentPrograms/result.txt");
//echo "<br>output opened!! <br>";
$fp_expected_output = file("/home/pk619/Research/Scripts/CorrectResults/cr_$file_basename.txt");
//echo "expected result opened! <br>";
$fp_test_cases = file("$testfile");
//echo "test cases opened <br>";

// compare the results 
if ($fp_user_output === $fp_expected_output){
	echo "****Congratulations!! Your program runs correctly !!*****<br>";
	exit;
}

else
{
	//print_r($fp_user_output);
	//print_r($fp_expected_output);
	//echo count($fp_user_output)."<br>User Output<br>";
	//echo count($fp_expected_output)."<br>Expected Output<br>";

	// check if all the test cases were run
	if (count($fp_user_output) != count($fp_expected_output))
	{
		echo "Not all test cases were checked. Please check your loop<br>";
		exit;
	}

	echo "<table border=\"1\"><tr><td>Test-Case</td>
					<td>Expected-Output</td>
					<td>Your-Output</td></tr>";

	for($i=0; $i<count($fp_expected_output); $i++){
		if($fp_expected_output[$i] !== $fp_user_output[$i])
		{
			echo "<tr><td>".$fp_test_cases[$i+1]."</td>".
					"<td>$fp_expected_output[$i]</td>
						<td>$fp_user_output[$i]</td>";
		}
	}
	echo "</table>";
}
?>