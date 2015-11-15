<?php
include_once('transporter.php');


$_POST['userid'] = '7';
$_POST['startdate'] = '2010-01-01';
$_POST['enddate'] = '2020-01-01';

if(!isset($_POST["userid"]) || !isset($_POST["startdate"]) || !isset($_POST["enddate"]))
    return;


$userId = $_POST["userid"];
$startDate = $_POST['startdate'];
$endDate = $_POST['enddate'];

$transporter = new Transporter();
$conn = $transporter->getConnection();

$query = "SELECT clock_time, is_clocking_in
            FROM time_logging
            WHERE user_id = $userId
            AND clock_time > '$startDate'
            AND clock_time < '$endDate'
            ORDER BY clock_time;";

$result = $conn->query($query);


$resultSet = array();
$counter = 0;
$row = $result->fetch_assoc();

$currentDay = "";
$currentTime = "";
$userIsClockedIn = true;
//Get the fist time to clock in for the day
while($row = $result->fetch_assoc())
{
    if($row['is_clocking_in'] == "1")
    {
        $currentDay = explode(" ", $row['clock_time'])[0];
        $currentTime = $row['clock_time'];
        break;
    }
}
$timeWorkedPerDay = 0;
$conversionRation = 3600;
$previousDay = $currentDay;

//Calculate the time worked for each day
while($row = $result->fetch_assoc())
{
    if($currentDay != explode(" ", $row['clock_time'])[0])
    {
        $currentDay = explode(" ", $row['clock_time'])[0];
        $userIsClockedIn = false;
        $resultSet[$previousDay] = round($resultSet[$previousDay] / $conversionRation, 2);
        $previousDay = $key;
    }
    $key = explode(' ', $row['clock_time'])[0];
    if($userIsClockedIn && $row['is_clocking_in'] == 0) //User is clocking out
    {

        $timeDifference = date_create($row['clock_time'])->getTimestamp()
            - date_create($currentTime)->getTimestamp();
        if(array_key_exists($key, $resultSet))
        {
            $resultSet[$key] += $timeDifference;
        }
        else
        {
            $resultSet[$key] = $timeDifference;
        }
        $userIsClockedIn = false;
    }
    elseif(!$userIsClockedIn && $row['is_clocking_in'] == 1)    //User is clocking in
    {
        $currentDay = explode(" ", $row['clock_time'])[0];
        $currentTime = $row['clock_time'];
        $userIsClockedIn = true;
    }
}

$resultSet[$key] = round($resultSet[$key] / $conversionRation, 2);
echo(json_encode($resultSet));