<?php require_once("../includes/admin-check.php"); ?>
<?php
 //session_start();
include("../config/database.php");

// check admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit();
}

// get incident id from URL
$id = $_GET['id'];

// fetch incident + user info
$sql = "SELECT incidents.*, fullname 
        FROM incidents 
        JOIN users ON incidents.user_id = users.id
        WHERE incidents.id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$incident = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Incident Details</title>
<link rel="stylesheet" href="../assets/CSS/style.css">
</head>
<body>

<div class="admin-content">

    <h1 class="page-title">Incident Details</h1>

    <div class="incident-card">

        <div class="detail-row">
            <span class="label">Reported By</span>
            <span class="value"><?= $incident['fullname']; ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Incident Title</span>
            <span class="value"><?= $incident['title']; ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Description</span>
            <span class="value"><?= $incident['description']; ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Incident Type</span>
            <span class="value"><?= $incident['incident_type']; ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Location</span>
            <span class="value"><?= $incident['location']; ?></span>
        </div>
        <div class="detail-row">
            <?php if($incident['image']){ ?>
            <p><strong>Evidence:</strong></p>
            <img src="../uploads/<?= $incident['image']; ?>" width="400">
            <?php } ?>
        </div>
        <div class="detail-row">
            <span class="label">Status</span>
            <span class="value status-badge"><?= $incident['status']; ?></span>
        </div>
        <?php if($incident['status'] != "Resolved"): ?>

        <form action="../admin/resolve-incident.php" method="POST" style="margin-top:25px;">
            <input type="hidden" name="incident_id" value="<?= $incident['id']; ?>">
            <button class="resolve-btn" style="padding:12px 25px;font-size:16px;">
                Mark as Resolved
            </button>
        </form>

        <?php else: ?>
        <p style="color:green;font-weight:bold;margin-top:20px;">
            ✔ This incident has been resolved
        </p>
        <?php endif; ?>
</body>
</html>