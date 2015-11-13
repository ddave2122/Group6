<?php
include_once("../include/transporter.php");

//only for testing
//$_GET['userId'] = "2";
//$_GET['startDate'] = "2010-01-01 00:00:00";
//$_GET['endDate'] = "2020-01-01 00:00:00";


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
    AND scheduled_clock_out < '$endDate'
    AND user_id = '$userId';";

$result = $conn->query($sql);
<<<<<<< HEAD
//var_dump($result);
=======

>>>>>>> origin/master
$schedule = array();

$counter = 0;

while($row = $result->fetch_assoc())
{
    $counter++;
    $scheduleObject = array();
    $scheduleObject['startTime'] = $row['scheduled_clock_in'];
    $scheduleObject['endTime'] = $row['scheduled_clock_out'];

    $schedule[] = $scheduleObject;
}
$responseObject = array();
$responseObject['schedule'] = $schedule;
$responseObject['numberOfRecords'] = $counter;

$jsonResponse = json_encode($responseObject);

header('Content-Type: application/json');
echo($jsonResponse );