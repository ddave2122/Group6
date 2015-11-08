<?php
session_start();
include_once('../../../db.config');

if (isset($_POST['submit'])) {
	//Grab login info
	$user = $_POST['username'];
    $pass = $_POST['password'];

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

	$sql = "SELECT * FROM $dbname.user";
	$sql = "SELECT username, password_hash from $dbname.user WHERE username='$user' ";

	$result = $conn->query($sql);

	//Validate Credentials
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$dbuser = "{$row['username']}";
	        $dbpass = "{$row['password_hash']}";

	        if ($pass == $dbpass){
	        	header("Location: index.php");
		        $val = "true";
		        $_SESSION['access_granted'] = $val;
		        echo $val;
		        die();
		    } else {
		    	$val = "false";
		    	$_SESSION['access_granted'] = $val;
		        $errormessage = "Username or Password is incorrect.";
		        echo $errormessage;
		        die();
		    }
		}
	   
	} else {
	    echo "0 results";
	}

	$conn->close();
} else {
	//Post not set
    header("Location: login.php");
    $errormessage = "Post not set. Could not connect: " . mysql_error();
    
    die();
}

?>
