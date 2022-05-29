<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "web";
$con = mysqli_connect($host, $user, $password, $database);
// mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
mysqli_query($con, 'set names utf8');
?>