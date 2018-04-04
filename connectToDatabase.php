<?php
$serverName = "";
$DBusername = "";
$DBpassword = "";

$connection = mysqli_connect($serverName, $DBusername, $DBpassword);
$database = mysqli_select_db($connection, astudent6);
$connection->set_charset("utf8");
