<?php
include_once('../include/transporter.php');

if(!isset($_GET["userId"]) || $_GET["userId"] == '') {
    $msg = "Didn't get it";
    echo json_encode($msg);
    return;
}else {

    $userId = $_GET["userId"];
    // Create connection

    $transporter = new Transporter();
    $conn = $transporter->getConnection();

    // Check connection
    if ($conn->connect_error) {
        echo "Failed";
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE id = $userId";
    
    $result = $conn->query($sql);
    //var_dump($result);
    

    while ($row = $result->fetch_assoc()) {
        $empObject = array();

        $empObject['id'] = $row['id'];
        $empObject['fname'] = $row['first_name'];
        $empObject['lname'] = $row['last_name'];
        $empObject['username'] = $row['username'];
        $empObject['password'] = $row['password_hash'];
        $empObject['statusId'] = $row['is_manager'];

        $employee[] = $empObject;
    }
   
    $responseObject = array();
    $responseObject['employee'] = $employee;


    $jsonResponse = json_encode($responseObject);
    //header('Content-Type: application/json');
    echo $jsonResponse;
}
/*
$userId = "1";

    $sql = "SELECT user_id, scheduled_clock_in, scheduled_clock_out
    FROM user_schedule
    WHERE scheduled_clock_in > '$startDate'
    AND scheduled_clock_out < '$endDate'
    AND user_id = '$userId'";


$result = $conn->query($sql);


//var_dump($result);

$schedule = array();

$counter = 0;*/
/*
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

    echo $scheduleObject['empName'] = $name;
    echo $scheduleObject['startTime'] = $row['scheduled_clock_in'];
    echo $scheduleObject['endTime'] = $row['scheduled_clock_out'];

    $schedule[] = $scheduleObject;
}
$responseObject = array();
$responseObject['schedule'] = $schedule;
$responseObject['numberOfRecords'] = $counter;

$jsonResponse = json_encode($responseObject);

//header('Content-Type: application/json');
echo($jsonResponse ); */

/*
echo date("F jS, Y", strtotime("now")), "\n";
echo date("F jS, Y", strtotime("last Sunday")), "\n";
echo date("F jS, Y", strtotime("Saturday")), "\n";
echo strtotime("10 September 2000"), "\n";
echo strtotime("+1 day"), "\n";
echo strtotime("+1 week"), "\n";
echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
echo strtotime("next Thursday"), "\n";
echo strtotime("last Monday"), "\n";*/


?>

