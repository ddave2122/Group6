<?php

include_once('../include/transporter.php');

if (!isset($_POST['username']) || !isset($_POST['password']))
    echo("test");

$user = $_POST['username'];
$pass = $_POST['password'];

$transporter = new Transporter();
$conn = $transporter->getConnection();

// execute the stored procedure
$sql = "CALL check_credentials('$user', '$pass', @userid, @manager, @west, @east, @north, @south, @firstname);";
$stmt = $conn->prepare($sql);

$stmt->execute();

// execute the second query to get values from OUT parameter
$result = $conn->query("SELECT @userid, @manager, @west, @east, @north, @south, @firstname")->fetch_assoc();

$resultSet = array();

foreach($result as $key => $value)
{
    $resultSet[str_replace("@", "", $key)] = $value;
}

echo json_encode($resultSet);