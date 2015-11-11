<!-- 
database host:
frankencluster.com:3306

g06dbf15admin
}Q5)f$NS9WMB

g06dbf15webuser
;$B)R9+sA=lh

-->
<?php
session_start();

if (isset($_POST['submit'])) {
	//Grab login info
	$user = $_POST['username'];
    $pass = $_POST['password'];

	$servername = "frankencluster.com:3306/g06dbf15";
	$username = "g06dbf15admin";
	$password = "}Q5)f\$NS9WMB";
	$dbname = "g06dbf15";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	$sql = "SELECT * FROM g06dbf15.user";
	$sql = "SELECT username, password_hash from g06dbf15.user WHERE username='$user' ";

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