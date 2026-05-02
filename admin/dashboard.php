<?php 
include("../includes/admin-header.php"); 
include("sidebar.php");
include("../config/database.php");


/* TOTAL USERS */
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

/* TOTAL INCIDENTS */
$totalIncidents = $conn->query("SELECT COUNT(*) AS total FROM incidents")->fetch_assoc()['total'];

/* PENDING */
$pendingReports = $conn->query("SELECT COUNT(*) AS total FROM incidents WHERE status='Pending'")->fetch_assoc()['total'];

/* IN PROGRESS */
$inProgressReports = $conn->query("SELECT COUNT(*) AS total FROM incidents WHERE status='In Progress'")->fetch_assoc()['total'];

/* RESOLVED */
$resolvedReports = $conn->query("SELECT COUNT(*) AS total FROM incidents WHERE status='Resolved'")->fetch_assoc()['total'];

/* REJECTED */
$rejectedReports = $conn->query("SELECT COUNT(*) AS total FROM incidents WHERE status='Rejected'")->fetch_assoc()['total'];

?>
<div class="main">
<div class="admin-content">
    <h1>Dashboard Overview</h1>

    <div class="dashboard-cards">

        <div class="card users">
            <h3>Total Users</h3>
            <p><?= $totalUsers ?></p>
        </div>

        <div class="card incidents">
            <h3>Total Incidents</h3>
            <p><?= $totalIncidents ?></p>
        </div>

        <div class="card pending">
            <h3>Pending Reports</h3>
            <p><?= $pendingReports ?></p>
        </div>

        <div class="card progress">
            <h3>In-Progress</h3>
            <p><?= $inProgressReports ?></p>
        </div>

        <div class="card resolved">
            <h3>Resolved</h3>
            <p><?= $resolvedReports ?></p>
        </div>

        <div class="card rejected">
            <h3>Rejected</h3>
            <p><?= $rejectedReports ?></p>
        </div>
    </div>
</div>
</div>
<?php include("../includes/footer.php"); ?>