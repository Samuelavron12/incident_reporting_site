<?php require_once("../includes/user-check.php"); ?>
<?php
include("../config/database.php");
include("../includes/user-header.php");
/*session_start();  */

$user_id = $_SESSION['user_id'];

$notifications = mysqli_query($conn,
"SELECT * FROM notifications 
 WHERE user_id='$user_id'
 ORDER BY id DESC");
?>

<link rel="stylesheet" href="../assets/CSS/style.css">

<div class="dashboard-content">
    <h1>My Notifications</h1>

    <?php if(mysqli_num_rows($notifications)==0){ ?>
        <div class="card">No notifications yet</div>
    <?php } ?>

    <?php while($note = mysqli_fetch_assoc($notifications)) { ?>
        <div class="notification-card">
            <h3><?php echo $note['title']; ?></h3>
            <p><?php echo $note['message']; ?></p>
            <small><?php echo $note['created_at']; ?></small>
        </div>
    <?php } ?>
</div>
<?php include("../includes/footer.php"); ?>