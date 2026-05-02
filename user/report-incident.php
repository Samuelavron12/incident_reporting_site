<?php 
include("../includes/user-header.php");
include("../config/database.php");

$message = "";

if(isset($_POST['submit_incident']))
{
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['incident_type'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $location = $latitude . "," . $longitude;

    // IMAGE UPLOAD
    $imageName = "";

    if(!empty($_FILES['image']['name']))
    {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $target = "../uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    // INSERT INTO DATABASE
    $sql = "INSERT INTO incidents 
(user_id,title,description,incident_type,location,image,latitude,longitude)
VALUES 
('$user_id','$title','$description','$type','$location','$imageName','$latitude','$longitude')";
    if(mysqli_query($conn,$sql)){
        $message = "Incident Reported Successfully!";
    }else{
        $message = "Error reporting incident.";
    }
}
?>


<h2>Report Traffic Incident</h2>
<div class="card">

<?php if($message != "") echo "<p style='color:green;'>$message</p>"; ?>

<form method="POST" enctype="multipart/form-data">

    <label>Incident Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description" required></textarea>

    <label>Incident Type</label>
    <select name="incident_type" required>
        <option>Accident</option>
        <option>Traffic Jam</option>
        <option>Road Block</option>
        <option>Vehicle Breakdown</option>
        <option>Other</option>
    </select>

    <label>Location</label>
    <label>Select Incident Location on Map</label>
<div id="map" style="height:300px;"></div>

<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">

    <label>Upload Image</label>
    <input type="file" name="image">

    <br><br>
    <button type="submit" name="submit_incident">Submit Report</button>

</form>
</div>
<script src="../assets/JS/map.js"></script>

<?php include("../includes/footer.php"); ?>