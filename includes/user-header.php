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
<!-- TOP NAVBAR -->
<div class="top-navbar">
    <div class="nav-logo">INCIDENT REPORTING SYSTEM</div>
    <button id="menu-toggle" class="menu-btn">☰</button>
</div>

<div class="sidebar" id="sidebar">

    <h2>USER </h2>
    <a href="dashboard.php" class="menu-link">Dashboard</a>
<a href="report-incident.php" class="menu-link">Report Incident</a>
<a href="my-reports.php" class="menu-link">My Reports</a>
<a href="../auth/logout.php" class="menu-link">Logout</a>

    <!------<a href="../user/dashboard.php">Dashboard</a>
    <a href="../user/report-incident.php">Report Incident</a>
    <a href="../user/my-reports.php">My Reports</a>
    <a href="../auth/logout.php">Logout</a>  ---->
</div>

<div class="main">

