<?php
require_once "session.php"; 
/*
If session expired or not user → go to login */
if(!isset($_SESSION['user_id']) || !isset($_SESSION['role'])){
    header("Location: ../auth/login.php");
    exit();
}

if($_SESSION['role'] !== 'user'){
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}
?>