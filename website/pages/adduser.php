<?php
session_start();
include_once('../../../db.config');

if (isset($_POST['firstname']) && isset($_POST['lastname']) && 
	isset($_POST['username']) && isset($_POST['password']) && 
	isset($_POST['status'])) {

	$fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $status = $_POST['status'];

	$servername = DB_ENDPOINT;
	$username = DB_USERNAME;
	$password = DB_PASSWORD;
	$dbname = DB_NAME;

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	if ($status == "Manager"){
		$Mstatus = 1;
		$Estatus = 0;
	}else {
		$Mstatus = 0;
		$Estatus = 1;
	}
	
	$sql = "INSERT INTO $dbname.user (first_name, last_name, username, password_hash, is_manager, is_employee) 
	VALUES ('$fname', '$lname', '$user', '$pass', '$Mstatus', '$Estatus')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
} else {
	//Post not set
    echo "Error: No Data Posted";
}

?>