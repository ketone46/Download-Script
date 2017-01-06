<?php
//Change the database connection variables with your details.
$db_host = "localhost";
$db_name = "dl";
$db_user = "root";
$db_pass = "";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if($link === false)
   {
    die("ERROR: Unable to connect to mysql server. " . mysqli_connect_error());
   }
?>