<?php 

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login";
mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong");
}

?>