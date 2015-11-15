<?php
include_once('../include/transporter.php');
?>

<?php

function rangeWeek($datestr) {
    date_default_timezone_set(date_default_timezone_get());
    $dt = strtotime($datestr);
    $res['start'] = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
    $res['end'] = date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
    return $res;
    }

print_r(rangeWeek(date("F jS, Y", strtotime("now")), "\n\n"));

$daterange = rangeWeek(date("F jS, Y", strtotime("now")), "\n\n");

$startkey = "start";
$endkey = "end";

$start = $daterange[$startkey];
$end = $daterange[$endkey];

echo "\n\nStart of Week: " . $start . " End of Week: " . $end;

$userId = "1";
$startDate = $start;
$endDate = $end;

echo "<br><br><br>";

$transporter = new Transporter();
$conn = $transporter->getConnection();


    $sql = "SELECT user_id, scheduled_clock_in, scheduled_clock_out
    FROM user_schedule
    WHERE scheduled_clock_in > '$startDate'
    AND scheduled_clock_out < '$endDate'
    AND user_id = '$userId'";





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
echo($jsonResponse );

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

