<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "web";
$con = mysqli_connect($host, $user, $password, $database);
mysqli_query($con, "set names utf8");
if (mysqli_connect_errno()){
    echo "kết nối thất bại: ".mysqli_connect_errno();exit;
}