<?php
include_once("../include/transporter.php");

//Only for Testing
//$_POST['userId'] = 1;
//$_POST['isClockingIn'] = 1;

//Grab clocking info
if(isset($_POST['userId']))
    $userId = $_POST['userId'];

if(isset($_POST['isClockingIn']))
    $clockingIn = $_POST['isClockingIn'];

$transporter = new Transporter();

$conn = $transporter->getConnection();

$sql = "call clock_in_user('$userId','$clockingIn');";

if (!$conn->query($sql) ) {
    echo "Statement Failed: (" . $conn->errno . ") " . $conn->error;
}


