<?php

include_once('transporter.php');
include_once('geolocation.php');

if (!isset($_POST['userid']) || !isset($_POST['lat']) || !isset($_POST['long']) || !isset($_POST['distance']))
    return;

//$_POST['userid'] = '1';
//$_POST['lat'] = '40.5187154';
//$_POST['long'] = '-74.4120953';
//$_POST['distance'] = '100';

$userId = $_POST['userid'];
$gpslat = $_POST['lat'];
$gpslong = $_POST['long'];
$distance = $_POST['distance']/3280.84;  //Convert ft to km

$edison = GeoLocation::fromDegrees($gpslat, $gpslong);

// get bounding coordinates 40 kilometers from location;
$coordinates = $edison->boundingCoordinates($distance,  6371.01);

//	print_r($coordinates);
$south = $coordinates[0]->degLat . " \n";        //South
$west = $coordinates[0]->degLon . " \n";       //West
$north = $coordinates[1]->degLat . " \n";        //North
$east = $coordinates[1]->degLon . " \n";       //East

$transporter = new Transporter();
$conn = $transporter->getConnection();

// execute the stored procedure
$sql = "CALL set_gps('$userId', '$north', '$east', '$south', '$west');";
echo($sql);
$stmt = $conn->query($sql);
echo($stmt);
return;
