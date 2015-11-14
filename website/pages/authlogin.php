<?php
session_start();

if (!isset($_POST['username']) || !isset($_POST['password']))
    return;

//Grab login info
$user = $_POST['username'];
$pass = $_POST['password'];

//Check the user login
$postdata = http_build_query(
    array(
        'username' => 'jmary',
        'password' => '12345'
    )
);
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$baseUrl  = $_SERVER['SERVER_NAME'];
//This URL might need to be updated depending on the hostname...
$loginResults = json_decode(file_get_contents(
        "http://localhost/csc4998/Group6/website/include/checkcredentials.php"
        , false
        , stream_context_create($opts)
        )
    , true);

/*if($loginResults['userid'] == null )
{
    header("Location: login.php");
    return;
}*/

$_SESSION['access_granted'] = true;
$_SESSION['accessLevel'] = 1;/*$_SESSION['is_manager'] ? 1 : 2;*/
$_SESSION['userId'] = $loginResults['userid'];
$_SESSION['isManager'] = $loginResults['manager'];
$_SESSION['firstname'] = $loginResults['firstname'];

header("Location: index.php");
