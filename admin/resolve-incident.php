<?php require_once("../includes/admin-check.php"); ?>
<?php
//session_start();
require_once "../config/database.php";
require_once "../includes/admin-header.php";


if(isset($_POST['resolve'])){

    $incident_id = $_POST['incident_id'];
    $user_id = $_POST['user_id'];

    // 1️⃣ Update incident status
    $update = mysqli_query($conn,
        "UPDATE incidents 
         SET status='Resolved' 
         WHERE id='$incident_id'"
    );

    if($update){

        // 2️⃣ Send notification to user
        $message = "Your reported incident has been RESOLVED. Thank you for helping improve traffic.";

        mysqli_query($conn,
        "INSERT INTO notifications (user_id, message, status)
         VALUES ('$user_id','$message','unread')");

        // 3️⃣ Redirect back
        header("Location: ../admin/incident-details.php?success=resolved");
        exit();
    }
    else{
        echo "Error updating incident.";
    }
}
?>