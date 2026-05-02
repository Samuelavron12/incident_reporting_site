
<!----php code for linking the database to the auth process---->

<?php
session_start();
require_once "../config/database.php";

if(isset($_POST['register'])){

    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s",$email);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        $error = "Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users(fullname,email,password) VALUES (?,?,?)");
        $stmt->bind_param("sss",$fullname,$email,$password);

        if($stmt->execute()){
            $success = "Account created successfully. You can login.";
        } else {
            $error = "Something went wrong.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="../assets/CSS/style.css">
<!----<style>
body{font-family:Arial;background:#f4f6f9}
.box{width:350px;margin:80px auto;padding:20px;background:#fff;border-radius:8px}
input,button{width:100%;padding:10px;margin:8px 0}
button{background:#007bff;color:#fff;border:none}
.error{color:red}.success{color:green}
</style> ---->
</head>
<body>
<div class="auth-page">
    <div class="auth-container">
<div class="box">
<h2>Create Account</h2>

<!--------  register section ------>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>

<form method="POST">
<input type="text" name="fullname" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="register">Register</button>
</form>

<p><a href="login.php">Already have account? Login</a></p>
</div>
</div>
</div>
</body>
</html>