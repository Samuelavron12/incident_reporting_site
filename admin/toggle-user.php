<?php require_once("../includes/admin-check.php"); ?>
<?php
require_once "../config/database.php";

$user_id = $_POST['user_id'];
$current_status = $_POST['current_status'];

/* DETERMINE NEW STATUS */
if($current_status == "active"){
    $new_status = "blocked";
}else{
    $new_status = "active";
}

/* UPDATE USER STATUS */
mysqli_query($conn,"UPDATE users SET status='$new_status' WHERE id='$user_id'");


/* 🔔 SEND AUTOMATIC NOTIFICATION */
if($new_status == "blocked"){

    $title = "Account Blocked";
    $message = "Your account has been blocked by the administrator. You will not be able to access the system until it is reactivated.";

    mysqli_query($conn,"INSERT INTO notifications (user_id,title,message,type)
                        VALUES ('$user_id','$title','$message','block')");

}else{

    $title = "Account Activated";
    $message = "Good news! Your account has been reactivated. You can now access the system again.";

    mysqli_query($conn,"INSERT INTO notifications (user_id,title,message,type)
                        VALUES ('$user_id','$title','$message','activation')");
}

header("Location: manage-user.php");
?>