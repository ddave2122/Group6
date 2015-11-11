<?php
include_once("../include/transporter.php");

//only for testing
$_GET['userId'] = "2";
$_GET['startDate'] = "2010-01-01 00:00:00";
$_GET['endDate'] = "2020-01-01 00:00:00";


if(!isset($_GET["userId"]) || !isset($_GET["startDate"]) || !isset($_GET["endDate"]))
    return;

$userId = $_GET["userId"];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

$transporter = new Transporter();
$conn = $transporter->getConnection();

$sql = "SELECT scheduled_clock_in, scheduled_clock_out
    FROM user_schedule
    WHERE scheduled_clock_in > '$startDate'
    AND scheduled_clock_out < '$endDate';";

echo $sql;

$result = $conn->query($sql);
var_dump($result);
$schedule = array();

while($row = $result->fetch_assoc())
{
    $scheduleObject = array();
    $scheduleObject['startTime'] = $row['scheduled_clock_in'];
    $scheduleObject['endTime'] = $row['scheduled_clock_out'];
    $schedule[] = $scheduleObject;
}

$jsonResponse = json_encode($schedule);
print_r($jsonResponse );