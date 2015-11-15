<?php
session_start();

include_once("../include/transporter.php");

if(isset($_POST['time'])) {
	
	$transporter = new Transporter();
	$conn = $transporter->getConnection();
	$insertValues = "";

	$time = $_POST['time'];
	$status = $_POST['status'];
	$user_id = $_SESSION['userId'];

	$insertValues = "('$user_id', '$time', '$status')";
	$sql = "INSERT INTO time_logging (user_id, clock_time, is_clocking_in) VALUES " . $insertValues . ";";

	if (!$conn->query($sql) ) {
	    echo "0";
	} else {
		echo "success";
	}
	

	}

?>