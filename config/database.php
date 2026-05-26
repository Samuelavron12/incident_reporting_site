<?php
$host = "127.0.0.1";   // IMPORTANT: use 127.0.0.1 not localhost
$user = "root";
$password = "";
$database = "smart_traffic_db";
$port = 3307; // change to 3306 if your port is 3306

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?> 