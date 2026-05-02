<?php
session_start();
require_once "../config/database.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, fullname, password, role FROM users WHERE email=?");
   // $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../user/dashboard.php");
            }
            exit();
           /* $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: ../user/dashboard.php");
            exit(); */
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="../assets/CSS/style.css">
<!----<style>
body{font-family:Arial;background:#f4f6f9}
.box{width:350px;margin:80px auto;padding:20px;background:#fff;border-radius:8px}
input,button{width:100%;padding:10px;margin:8px 0}
button{background:#28a745;color:#fff;border:none}
.error{color:red}
</style>----->
</head>
<body>
<div class="auth-page">
    <div class="auth-container">
<div class="box">
<h2>Login</h2>
<!----  login input section------>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

<p><a href="register.php">Create account</a></p>
</div>
</div>
</div>
</body>
</html>