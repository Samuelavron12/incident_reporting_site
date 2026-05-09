<?php require_once("../includes/admin-check.php"); ?>
<?php
session_start();
include("../config/database.php");

// check admin login
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit();
}

// get form data
$incident_id = $_POST['incident_id'];
$status = $_POST['status'];

// update database
$sql = "UPDATE incidents SET status=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $incident_id);
$stmt->execute();

// go back to manage page
header("Location: ../admin/manage-incident.php");
exit();
?>