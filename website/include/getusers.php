<<<<<<< HEAD
<?php
include_once('transporter.php');

$transporter = new Transporter();
$conn = $transporter->getConnection();

// execute the stored procedure
$sql = "SELECT first_name, last_name, id from user where is_manager = 0 and is_employee = 1;";
$result = $stmt = $conn->query($sql);

$resultSet = array();

while($row = $result->fetch_assoc())
{
    $item = array();
    $item[$row['id']] = $row['first_name'] . ' ' . $row['last_name'];
    $resultSet[] = $item;
}

//$highLevelArray = array($resul);
echo "{" . json_encode($resultSet) . "}";
=======
<?php
include_once('transporter.php');

$transporter = new Transporter();
$conn = $transporter->getConnection();

// execute the stored procedure
$sql = "SELECT first_name, last_name, id from user where is_manager = 0 and is_employee = 1;";
$result = $stmt = $conn->query($sql);

$resultSet = array();

while($row = $result->fetch_assoc())
{
    $item = array();
    $item[$row['id']] = $row['first_name'] . ' ' . $row['last_name'];
    $resultSet[] = $item;
}


echo json_encode($resultSet);
>>>>>>> 524595abf9a27e0a1b65d96b6b86513bac554f9e
