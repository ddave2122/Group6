<?php
include_once("../include/transporter.php");

//Only for Testing
//$_POST['userId'] = 1;
//$_POST['schedule'] = <<< EOT
//{
//    "schedule": [
//        {
//            "clockIn": "2015-06-12 08:00:00",
//            "clockOut": "2015-06-12 16:00:00"
//        },
//        {
//            "clockIn": "2015-06-13 08:00:00",
//            "clockOut": "2015-06-14 16:00:00"
//        },
//        {
//            "clockIn": "2015-06-14 08:00:00",
//            "clockOut": "2015-06-14 16:00:00"
//        },
//        {
//            "clockIn": "2015-06-15 08:00:00",
//            "clockOut": "2015-06-15 16:00:00"
//        },
//        {
//            "clockIn": "2015-06-16 08:00:00",
//            "clockOut": "2015-06-16 16:00:00"
//        }
//    ]
//}
//EOT;

//Grab clocking info
/*if(!isset($_POST['userId']))
    return;
$userId = $_POST['userId'];*/

if(!isset($_POST['schedule']))
    return;
$rawSchedule = $_POST['schedule'];

$jsonSchedule = json_decode($rawSchedule, true);

$scheduleCount = count($jsonSchedule['schedule']);
if($scheduleCount < 1)
{
    echo("0");
    return;
}

$transporter = new Transporter();
$conn = $transporter->getConnection();
$insertValues = "";
foreach($jsonSchedule['schedule'] as $scheduleItem)
{
	$userId = $scheduleItem['id'];
    $clockIn = $scheduleItem['clockIn'];
    $clockOut = $scheduleItem['clockOut'];
    $insertValues .= "('$userId', '$clockIn', '$clockOut'),";
}
$insertValues = rtrim($insertValues, ",");

$sql = "INSERT INTO user_schedule (user_id, scheduled_clock_in, scheduled_clock_out) VALUES " . $insertValues . ";";

if (!$conn->query($sql) ) {
    echo "0";
}
else
    echo $scheduleCount;