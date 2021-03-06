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

	/*$sql = "SELECT * FROM $dbname.user";*/
	$sql = "SELECT id, username, password_hash from $dbname.user WHERE username='$user' ";

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
		        $_SESSION['id'] = $row['id'];

		        $sql = "SELECT is_manager from $dbname.user WHERE username='$user' ";
		        $result = $conn->query($sql);
		        $row = $result->fetch_assoc();
		        $manageraccess = "{$row['is_manager']}";
		        
		        $sql = "SELECT is_employee from $dbname.user WHERE username='$user' ";
		        $result = $conn->query($sql);
		        $row = $result->fetch_assoc();
		        $empaccess = "{$row['is_employee']}";

		        if ($manageraccess){
		        	$_SESSION['accessLevel'] = $manageraccess + 1;
		        } else {
		        	$_SESSION['accessLevel'] = $empaccess;
		        }

		        $sql = "SELECT first_name from $dbname.user WHERE username='$user' ";
		        $result = $conn->query($sql);
		        $row = $result->fetch_assoc();
		        $fname = "{$row['first_name']}";
		        $_SESSION['firstname'] = $fname;
		        echo $val;
		        die();
		    } else {
		    	header("Location: login.php");
		    	$val = "false";
		    	$_SESSION['access_granted'] = $val;
		        $errormessage = "Username or Password is incorrect.";
		        echo $errormessage;
		        die();
		    }
		}
	   
	} else {
		header("Location: login.php");
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

