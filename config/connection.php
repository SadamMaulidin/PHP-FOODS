<?php

//create variable that we needed
$server = "localhost";
$username = "root";
$password = "";
$database = "foods";

//connecting and choose database for use
$connection = mysqli_connect($server, $username, $password, $database)
								or die("Connecting Failed");

?>