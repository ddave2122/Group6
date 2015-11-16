<?php
session_start();
include_once('../../../db.config');

if (isset($_POST['empid']) && isset($_POST['firstname']) && isset($_POST['lastname']) && 
	isset($_POST['username']) && isset($_POST['password']) && 
	isset($_POST['status'])) {
	
	$id = $_POST['empid'];
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
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";

	if ($status == "Manager"){
		$Mstatus = 1;
		$Estatus = 0;
	}else {
		$Mstatus = 0;
		$Estatus = 1;
	}

    if(isset($_POST['removeuser'])) {
    	//$remove = $_POST['removeuser'];
    	//echo "remove set";
    	//echo $remove;
    	$sql = "DELETE FROM user WHERE id='$id'";

    	if ($conn->query($sql) === TRUE) {
		    echo "DELETED";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
    } else {

    	$sql = "UPDATE $dbname.user SET first_name='$fname', 
		last_name='$lname', username='$user', password_hash='$pass', 
		is_manager='$Mstatus', is_employee='$Estatus' 
		WHERE id='$id'";

		if ($conn->query($sql) === TRUE) {
		    echo "UPDATED";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }
    
	$conn->close();
	
} else {
	//Post not set
    echo "Error: No Data Posted";
}

?>