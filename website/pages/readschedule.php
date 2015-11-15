<?php
include_once("../include/transporter.php");

//only for testing
//$_REQUEST['userId'] = "2";
//$_REQUEST['startDate'] = "2010-01-01 00:00:00";
//$_REQUEST['endDate'] = "2020-01-01 00:00:00";


if(!isset($_REQUEST["userId"]) || !isset($_REQUEST["startDate"]) || !isset($_REQUEST["endDate"]))
    return;
echo("Missing Params");
} 

$userId = $_REQUEST["userId"];
$startDate = $_REQUEST['startDate'];
$endDate = $_REQUEST['endDate'];

$transporter = new Transporter();
$conn = $transporter->getConnection();

if ($userId == "all"){
    $sql = "SELECT user_id, scheduled_clock_in, scheduled_clock_out
    FROM user_schedule
    WHERE scheduled_clock_in > '$startDate'
    AND scheduled_clock_out < '$endDate'";
}else {
    $sql = "SELECT user_id, scheduled_clock_in, scheduled_clock_out
    FROM user_schedule
    WHERE scheduled_clock_in > '$startDate'
    AND scheduled_clock_out < '$endDate'
    AND user_id = '$userId'";
}




$result = $conn->query($sql);


//var_dump($result);



$schedule = array();

$counter = 0;

while($row = $result->fetch_assoc())
{
    $counter++;
    $scheduleObject = array();
    $id = $row['user_id'];

    $sql2 = "SELECT first_name, last_name FROM user WHERE id = '$id'";
    $result2 = $conn->query($sql2);

    while($row2 = $result2->fetch_assoc()) {
        $name = $row2['last_name'] . ", ". $row2['first_name'];
    }

    $scheduleObject['empName'] = $name;
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
