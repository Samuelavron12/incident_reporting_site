<?php require_once("../includes/admin-check.php"); ?>
<?php
//session_start();
require_once "../config/database.php";
require_once "../includes/admin-header.php";
requireAdmin();

$user_id = $_POST['user_id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

header("Location: manage-user.php");
exit();