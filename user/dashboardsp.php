
<?php
session_start();
require_once "../config/database.php";

/*if (!isset($_SESSION['userid'])) {
    header("Location: ../auth/login.php");
    exit();
}  */

$user_id = $_SESSION['user_id'];

$user_id = $_SESSION['user_id'];

/* TOTAL REPORTS */
$totalStmt = $conn->prepare("SELECT COUNT(*) FROM incidents WHERE user_id=?");
$totalStmt->bind_param("i", $user_id);
$totalStmt->execute();
$totalStmt->bind_result($totalReports);
$totalStmt->fetch();
$totalStmt->close();

/* REPORTS THIS WEEK */
$weekStmt = $conn->prepare("
SELECT COUNT(*) 
FROM incidents 
WHERE user_id=? 
AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
");
$weekStmt->bind_param("i", $user_id);
$weekStmt->execute();
$weekStmt->bind_result($weeklyReports);
$weekStmt->fetch();
$weekStmt->close();

?>


<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/CSS/dashboard.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>SMART TRAFFIC SYSTEM</h2>
    <div>
        <span>Welcome, <?php echo $_SESSION['fullname'] ?></span>
        <a href="../auth/logout.php" class="logout">Logout</a>
    </div>
</div>
<section class="first-section">
    <div class="dashboard-hero">
        <div class="hero-slider">
            <div class="slide active" style="background-image:url('../assets/jpg.jpg')"></div>
            <div class="slide" style="background-image:url('../assets/im1.png')"></div>
            <div class="slide" style="background-image:url('../assets/im2.png')"></div>
            <div class="slide" style="background-image:url('../assets/hold1.webp')"></div>
        </div>

        <div class="hero-overlay"></div>

        <div class="hero-text">
            <h1>Welcome to Smart Traffic Incident System</h1>
            <p>Report incidents • Track safety • Get emergency help fast</p>
        </div>

    </div>
<section>

</section>

<!-- HERO SECTION -->
<!---
<section class="hero">
    <div class="hero-text">
        <h1>Help Keep Roads Safe 🚗</h1>
        <p>Report accidents, traffic jams, broken traffic lights and help your city move better.</p>
        <a href="report-incident.php" class="main-btn">Report Traffic Incident!!</a>
    </div>
</section>
---->

<!-- QUICK ACTION CARDS -->
<section class="cards">
    <div class="card">
        <h3>📝 Report Incident</h3>
        <p>Spotted an accident or traffic jam? Report it instantly.</p>
        <a href="report-incident.php">Report Now </a>
    </div>

    <div class="card">
        <h3>📍 View My Reports</h3>
        <p>Track incidents you have submitted.</p>
        <a href="my-reports.php">View Reports </a>
    </div>
    

</section>

<!-- INFO SECTION -->
<section class="info">
    <h2>Traffic Safety Tips</h2>
    <div class="tips">
        <div class="tip">🚦 Always obey traffic lights</div>
        <div class="tip">📱 Avoid phone while driving</div>
        <div class="tip">🛑 Maintain safe distance</div>
        <div class="tip">🚑 Report emergencies quickly</div>
    </div>
</section>

<div class="user-stats">

    <div class="stat-card">
        <h3><?php echo $totalReports; ?></h3>
        <p>Total Reports Submitted</p>
    </div>

    <div class="stat-card">
        <h3><?php echo $weeklyReports; ?></h3>
        <p>Reports This Week</p>
    </div>

</div>
<footer>
    <div class="copyright">
        <p>&copy; 2026 AVRON Tech hub. All Right Reserved</p>
    </div>
</footer>
<script>
let slides = document.querySelectorAll(".slide");
let index = 0;

function changeSlide(){
    slides[index].classList.remove("active");
    index = (index + 1) % slides.length;
    slides[index].classList.add("active");
}

setInterval(changeSlide, 5000); // change every 5 seconds
</script>
</body>
</html>