<?php
require_once("../includes/user-check.php");
require_once("../config/database.php");

/* GET USER INFO */
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

/* UPDATE AVATAR */
if(isset($_POST['save_avatar']))
{
    $avatar = $_POST['avatar'];

    mysqli_query($conn,
    "UPDATE users SET avatar='$avatar' WHERE id='$user_id'");

    $_SESSION['avatar'] = $avatar;

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile</title>

<link rel="stylesheet" href="../assets/CSS/profile.css">
</head>

<body>

<!-- NAVBAR  -->

<header class="navbar">

    <div class="logo-section">

        <img src="../assets/images/tlogo.png" class="logo-img">

        <div class="logo-text">
            <h2>Traffic Incident</h2>
            <p>Reporting System</p>
        </div>

    </div>
    <!-- TOGGLE -->
    <div class="menu-toggle" id="menuToggle">
        <img src="../assets/images/menu1.png" alt="">
    </div>
    <nav class="nav-links" id="navLinks">

    
            <a href="../user/index.php">
                <img src="../assets/images/home.png" alt="">
                home
            </a>
            <a href="../user/report-incident.php">
                <img src="../assets/images/upload rep.png" alt="">
                report incident
            </a>
            <a href="../user/my-reports.php">
                <img src="../assets/images/reports.png" alt="">
                my reports
            </a>
    </nav>

</header>

<!-- PROFILE SECTION  -->

<section class="profile-section">

    <div class="profile-card">

        <!-- USER IMAGE -->
        <div class="profile-image">
         <img src="../assets/images/avatar.png" alt="">
        </div>

        <!-- USER DETAILS -->
        <div class="profile-info">

            <h1><?php echo $user['fullname']; ?></h1>

            <p class="email">
                <?php echo $user['email']; ?>
            </p>

        </div>

        <!-- LOGOUT -->
        <div class="logout-box">

            <a href="../auth/logout.php" class="logout-btn">
                Logout
            </a>

        </div>

    </div>

</section>

<!--  JS  -->

<script>

    // MOBILE TOGGLE
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("show");
    });

</script>

</body>
</html>