<?php require_once("../includes/admin-check.php"); ?>
<?php
include("../config/database.php");

$query = "SELECT id, description FROM incidents 
          WHERE LOWER(status) = 'pending'
          ORDER BY id DESC";
$result = mysqli_query($conn,$query);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) == 0){
    echo "<option value=''>No pending incidents found</option>";
    exit();
}

echo "<option value=''>Select Incident</option>";

while($row = mysqli_fetch_assoc($result)){
    echo "<option value='".$row['id']."'>
            Incident #".$row['id']." - ".$row['description']."
          </option>";
}
?>