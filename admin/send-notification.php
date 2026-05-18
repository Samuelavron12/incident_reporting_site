<?php
include("../config/database.php");
include("../includes/admin-header.php");
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO notifications (title, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $message);

    if ($stmt->execute()) {
        $success = "Notification sent successfully!";
    } else {
        $error = "Something went wrong. Try again.";
    }
}
$users = mysqli_query($conn,"SELECT * FROM users");
?>

<link rel="stylesheet" href="../assets/CSS/style.css">

<div class="admin-content">
<h1>Send Notification</h1>
<?php if($success != ""): ?>
    <div class="alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if($error != ""): ?>
    <div class="alert-error"><?php echo $error; ?></div>
<?php endif; ?>
<form method="POST" class="cardss">
<select name="user_id" required>
<option value="">Select User</option>
<?php while($u = mysqli_fetch_assoc($users)) { ?>
<option value="<?php echo $u['id']; ?>">
<?php echo $u['fullname']; ?> (<?php echo $u['email']; ?>)
</option>
<?php } ?>
</select>

<input type="text" name="title" placeholder="Notification Title" required>
<textarea name="message" placeholder="Write message..." required></textarea>

<button name="send">Send Notification</button>
</form>
</div>
<?php include("../includes/footer.php"); ?>