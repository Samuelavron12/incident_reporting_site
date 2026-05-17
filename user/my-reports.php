<?php require_once("../includes/user-check.php"); ?>
<?php 
include("../includes/user-header.php");
include("../config/database.php");

$user_id = $_SESSION['user_id'];

//$sql = "SELECT * FROM incidents WHERE user_id='$user_id' ORDER BY created_at DESC";

$stmt = $conn->prepare("SELECT * FROM incidents WHERE user_id=? ORDER BY id DESC");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
//$result = mysqli_query($conn,$sql);
?>
<div class="hea">
<h2>MY REPORTED INCIDENT</h2>
</div>
<table border="1" cellpadding="10" width="100%">
<tr>
    <th>Image</th>
    <th>Title</th>
    <th>Type</th>
    <th>Status</th>
    <th>Date</th>
    <th>Location</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td>
        <?php if($row['image'] != ""): ?>
            <img src="../uploads/<?php echo $row['image']; ?>" width="80">
        <?php endif; ?>
    </td>

    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['incident_type']; ?></td>
    <td>
   <span class="status-user <?= strtolower(str_replace(' ','-',$row['status'])) ?>">
      <?= $row['status']; ?>
   </span>
</td>
    <td><?php echo $row['created_at']; ?></td>
    <td>
        <a href="map-view.php?lat=<?php echo $row['latitude']; ?>&lng=<?php echo $row['longitude']; ?>">
            View Map
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php include("../includes/footer.php"); ?>