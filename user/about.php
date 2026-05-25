<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Panel</title>

    <link rel="stylesheet" href="../assets/CSS/about.css">
</head>
<body>

<!--  NAVBAR  -->
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

    <!-- NAVIGATION -->
    <nav class="nav-links" id="navLinks">

      <!---  <a href="index.php">Home</a> ----->
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
            <a href="../user/profile.php">
                <img src="../assets/images/prof.png" alt="">
                profile
            </a>

    </nav>

</header>

<!--  ABOUT SECTION  ---->

<section class="about-section">
    <div class="about-content">
        <h1>About The System</h1>
        <p>
            The Smart Traffic Incident Reporting System is a web-based
            platform developed to improve traffic incident reporting,
            monitoring, and emergency response management.
            The system allows road users to report accidents,
            traffic congestion, broken traffic lights,
            road blockages, and other emergencies in real time.
        </p>
        <p>
            This platform integrates interactive maps,
            live traffic monitoring, notification systems,
            analytics dashboards, and emergency dispatch features
            to support efficient communication between users,
            traffic authorities, hospitals, police stations,
            and fire service agencies.
        </p>
        <p>
            The system is designed to improve road safety,
            reduce emergency response delays,
            and provide valuable traffic data for
            decision-making and traffic management.
        </p>
    
        <div class="author-box">
            <h2>Project Information</h2>
            <div class="info-item">
                <span class="label">Project Title:</span>
                <span class="value">
                    Smart Traffic Incident Reporting & Analytics System
                </span>
            </div>
            <div class="info-item">
                <span class="label">Developed By:</span>
                <span class="value">Folorunsho Samuel Saiki</span>
            </div>
            <div class="info-item">
                <span class="label">Role:</span>
                <span class="value">
                    System Analyst, Programmer & Developer
                </span>
            </div>
            <div class="info-item">
                <span class="label">Supervisor:</span>
                <span class="value">Dr. N. H Okwu</span>
            </div>

        </div>

    </div>
    

    
    <div class="about-image">

        <img src="../assets/hold6.jpg" alt="Traffic System">

    </div>

</section>
<!-- JS -->

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