<?php
session_start();
require_once "../config/database.php";
require_once "../includes/admin-header.php";

$user_id = $_POST['user_id'];
$current = $_POST['current_status'];

$newStatus = ($current == 'active') ? 'blocked' : 'active';

$stmt = $conn->prepare("UPDATE users SET status=? WHERE id=?");
$stmt->bind_param("si", $newStatus, $user_id);
$stmt->execute();

header("Location: manage-user.php");
exit();