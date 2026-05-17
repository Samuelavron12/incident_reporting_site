<?php require_once("../includes/admin-check.php"); ?>
<?php
require_once "../config/database.php";
require_once "../includes/admin-header.php";

/* 1️⃣ Check if service id exists in URL */
if(!isset($_GET['id']))
{
    echo "No service selected.";
    exit();
}

$service_id = $_GET['id'];

/* 2️⃣ Fetch service from database */
$result = mysqli_query($conn,"SELECT * FROM emergency_services WHERE id=$service_id");

/* 3️⃣ Check if service actually exists */
if(mysqli_num_rows($result) == 0)
{
    echo "Service not found.";
    exit();
}

$service = mysqli_fetch_assoc($result);

/* 4️⃣ Fetch pending incidents */
$incidents = mysqli_query($conn,"SELECT * FROM incidents WHERE status='Pending'");
?>

<?php
include("../config/database.php");

$success = "";

$service_id = $_GET['id'];
$service = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM emergency_services WHERE id=$service_id")
);

if(isset($_POST['dispatch']))
{
    $incident_id = $_POST['incident_id'];

    mysqli_query($conn,
    "UPDATE incidents SET status='Dispatched' WHERE id=$incident_id");

    $success = "Incident dispatched successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dispatch Incident</title>
<link rel="stylesheet" href="../assets/CSS/admin.css">
</head>
<body>

<div class="admin-content">
<div class="card">

<h1>Dispatch Incident to <?php echo $service['service_name']; ?></h1>
<?php if($success != "") { ?>
    <div class="success-box">
        <?php echo $success; ?>
    </div>
<?php } ?>

<form method="POST" class="dispatch-form">

<label>Select Pending Incident</label>

<select name="incident_id" id="incidentDropdown" required>
    <option value="">Click to Load Pending Incidents</option>
</select>

<button name="dispatch" class="dispatch-btn">Send Alert</button>

</form>


</div>
</div>
<script>
const dropdown = document.getElementById("incidentDropdown");

dropdown.addEventListener("focus", loadIncidents);

function loadIncidents() {

    if(dropdown.dataset.loaded === "true") return;

    fetch("load-incident.php")
    .then(response => response.text())
    .then(data => {
        dropdown.innerHTML = data;
        dropdown.dataset.loaded = "true";
    })
    .catch(error => {
        dropdown.innerHTML = "<option>Error loading incidents</option>";
        console.log(error);
    });

}
</script>
</body>
</html>