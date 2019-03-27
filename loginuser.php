<?php

//connecting with connection.php file
include './config/connection.php';

//create variable response
$response = array();

//check parameter condition
if (isset($_POST["username"]) && isset($_POST["password"])) {
	//put username and password into variable
	$username = $_POST["username"];
	//use md5 so that the password that the user entered is not visible
	$password = md5($_POST["password"]);

	//make a command to take user's detail
	$sql = "SELECT * FROM table_user WHERE username = '$username' AND password = '$password' ";

	//execute command in $sql variable
	$check = mysqli_query($connection, $sql);

	//check
	if (!$check) {
		echo "Can't do command" . mysqli_error($connection);
		exit;
	}

	//put result of query into variable
	//put first row
	$row = mysqli_fetch_row($check);

	//put result into array
	$result_data = array(
		'id_user' => $row[0], 
		'user_name' => $row[1], 
		'address' => $row[2], 
		'gender' => $row[3], 
		'phone_num' => $row[4], 
		'username' => $row[5], 
		'password' => $row[6], 
		'level' => $row[7]);

	//check, does data is exist?
	if (mysqli_num_rows($check) > 0) {
		//message if nothing data is exist
		$response['result'] = 1;
		$response['message'] = "Login Success";
		$response['data'] = $result_data;
	}else{
		$response['result'] = 0;
		$response['message'] = "Login Failed";
	}

	//convert response into json
	echo json_encode($response);

}

?>