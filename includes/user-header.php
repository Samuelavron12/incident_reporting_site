<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

if($_SESSION['role'] != 'user'){
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body class="dashboard-page">
<button id="menu-toggle" class="menu-toggle">☰</button>
<div class="sidebar" id="sidebar">

    <h2>USER </h2>
    <a href="../user/dashboard.php">Dashboard</a>
    <a href="../user/report-incident.php">Report Incident</a>
    <a href="../user/my-reports.php">My Reports</a>
    <a href="../auth/logout.php">Logout</a>
</div>

<div class="main">

