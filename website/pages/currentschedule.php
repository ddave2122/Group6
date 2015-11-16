<?php
include_once("../include/header.php");
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

//print_r(rangeWeek(date("F jS, Y", strtotime("now")), "\n\n"));

$daterange = rangeWeek(date("F jS, Y", strtotime("now")), "\n\n");

$startkey = "start";
$endkey = "end";

$start = $daterange[$startkey];
$end = $daterange[$endkey];

$d1 = strtotime($start);
$dstart = date("F jS, Y", $d1);

$d2 = strtotime($end);
$dend = date("F jS, Y", $d2);
echo '<div id="currentSchedule">';
echo '<h3 style="text-align:center;padding-bottom:60px;">Week<br><br>' . $dstart . ' -  <i class="fa fa-calendar" id="cal"></i>  - ' . $dend .'</h3>';

$userId = $_SESSION['id'];
$startDate = $start;
$endDate = $end;

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
echo '<div class="row">';
while($row = $result->fetch_assoc())
{
    $counter++;
    $scheduleObject = array();
    $id = $row['user_id'];

    $sql2 = "SELECT first_name, last_name FROM user WHERE id = '$id'";
    $result2 = $conn->query($sql2);

    $startdate = str_replace(' ', 'T', $row['scheduled_clock_in']);
    $enddate = str_replace(' ', 'T', $row['scheduled_clock_out']);

    while($row2 = $result2->fetch_assoc()) {
        $name = $row2['last_name'] . ", ". $row2['first_name'];
    }

    echo '<div class="col-md-3" style="">
             <div class="form-group" style="padding-left:15px;padding-right:15px;">
             	<p style="font-size:18px;padding-top:31px;text-align:center;">'.$name.'</p>
             </div>
          </div>';

    echo '<div class="col-md-4">
	        <div class="form-group" style="padding-left:15px;padding-right:15px;">
	            <label class="control-label">Start Date & Time</label>
	            <input class="form-control" type="datetime-local" value="'.$startdate.'" id="startDate" name="startDate" disabled>
	        </div>
	      </div>';

	echo '<div class="col-md-4">
          	<div class="form-group" style="padding-left:15px;padding-right:15px;">
            	<label class="control-label">End Date & Time</label>
              	<input class="form-control" type="datetime-local" value="'.$enddate.'" id="endDate" name="endDate" disabled>
           </div>
           
           </div>';

    /*$scheduleObject['empName'] = $name;
    $scheduleObject['startTime'] = $row['scheduled_clock_in'];
    $scheduleObject['endTime'] = $row['scheduled_clock_out'];

    $schedule[] = $scheduleObject;*/
}

echo '</div></div>';

/*$responseObject = array();
$responseObject['schedule'] = $schedule;
$responseObject['numberOfRecords'] = $counter;

$jsonResponse = json_encode($responseObject);

//header('Content-Type: application/json');
echo($jsonResponse );*/

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



		

<?php include_once("../include/bottomwrapper.php") ?>