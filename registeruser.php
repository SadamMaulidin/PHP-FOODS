<?php

//connecting with connection.php file
include './config/connection.php';

//create array
$response = array();

//check user's method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//check parameter condition
	if (isset($_POST["user_name"]) && 
		isset($_POST["password"]) && 
		isset($_POST["address"]) && 
		isset($_POST["gender"]) && 
		isset($_POST["phonenum"]) && 
		isset($_POST["username"]) && 
		isset($_POST["level"])) {
		//put user's data in parameter into variable
	$user_name = $_POST["user_name"];
	$password = md5($_POST["password"]);
	$address = $_POST["address"];
	$gender = $_POST["gender"];
	$phone_num = $_POST["phonenum"];
	$username = $_POST["username"];
	$level = $_POST["level"];

	//check, whether the username entered has already been used
	$sql = "SELECT * FROM table_user WHERE username = '$username'";
	$check = mysqli_fetch_array(mysqli_query($connection, $sql));
	//check data in the variable $check
	if (isset($check)) {
		//response when register is failed, cause of username is alredy exist
		$response["result"] = 0;
		$response["message"] = "Oh oh, username is alredy exist";
	}else{
		//put user's data into database
		$sql = "INSERT INTO table_user (user_name, address, gender, phone_num, username, password, level) VALUES('$user_name', '$address', '$gender', '$phone_num', '$username', '$password', '$level')";
		//execute command in $sql
		if (mysqli_query($connection, $sql)) {
			$response["result"] = 1;
			$response["message"] = "Register Success";
		}else{
			$response["result"] = 0;
			$response["message"] = "Register Failed";
		}
	}
	
	//convert response into json
	echo json_encode($response);

	}
}

?>