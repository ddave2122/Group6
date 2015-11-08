<?php 

session_start();
if(empty($_SESSION['access_granted']) || (!empty($_SESSION['access_granted']) && $_SESSION['access_granted'] != true)) { 
    session_start();
    header("Location: login.php");
    $errormessage = "Access Denied" . mysql_error();
    die();
}

?>
<?php include_once("../include/header.php"); ?>


<div class="welcome">

	<h1>Hello User</h1>

</div>



<?php include_once("../include/bottomwrapper.php") ?>

