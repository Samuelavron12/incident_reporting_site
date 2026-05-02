<?php
$host = "127.0.0.1";   // IMPORTANT: use 127.0.0.1 not localhost
$user = "root";
$password = "";
$database = "smart_traffic_db";
$port = 3307; // change to 3306 if your port is 3306
/*
try{
    $conn = new mysqli($host, $user, $password, $database, $port)
    if ($conn -> connect_error) {
        throw new Exception("conection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
}
catch (Exception $e) {
    error_log($e->getMessage());  //log to server error_log
    die("system temporarily unavailable. please try again later.");
}
*/
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?> 