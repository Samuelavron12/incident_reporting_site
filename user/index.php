<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User Dashboard</title>

    <link rel="stylesheet" href="../assets/CSS/dps.css">
</head>
<body>

    <!--  NAVBAR  -->
    <header class="navbar">

        <div class="logo-section">
            <!-- LOGO IMAGE -->
            <img src="../assets/images/tlogo.png" alt="Logo" class="logo-img">

            <div class="logo-text">
                <h2>Traffic Incident</h2>
                <p>Reporting System</p>
            </div>
        </div>

        <!-- TOGGLE BUTTON -->
        <div class="menu-toggle" id="menuToggle">
            <img src="../assets/images/menu1.png" alt="Menu Icon">
        </div>

        <!-- NAV LINKS -->
        <nav class="nav-links" id="navLinks">

            <a href="about.php">
                <img src="../assets/images/about.png" alt="">
                About
            </a>

            <a href="report-incident.php" class="">
                <img src="../assets/images/upload rep.png" alt="">
                Report Incident
            </a>

            <a href="my-reports.php">
                <img src="../assets/images/reports.png" alt="">
                My Reports
            </a>

            <a href="profile.php">
                <img src="../assets/images/prof.png" alt="">
                Profile
            </a>

        </nav>

    </header>

    <!--  HERO SECTION  -->
    <section class="hero">

        <!-- SLIDER IMAGES -->
        <div class="slider">
            <img src="../assets/hold1.webp" alt="" class="slide active">
            <img src="../assets/im1.png" alt="" class="slide">
            <img src="../assets/im2.png" alt="" class="slide">
            <img src="../assets/hold2.avif" alt="" class="slide ">
            <img src="../assets/hold3.jpg" alt="" class="slide ">
            <img src="../assets/acc.jpg" alt="" class="slide">
            <img src="../assets/hold5.jpg" alt="" class="slide">
            <img src="../assets/acc4.jpg" alt="" class="slide">
            <img src="../assets/hold6.jpg" alt="" class="slide">
            <img src="../assets/hol4.webp" alt="" class="slide">
            <img src="../assets/acc.jpg" alt="" class="slide">
        </div>

        <!-- DARK OVERLAY -->
        <div class="overlay"></div>

        <!-- CENTER CONTENT -->
        <div class="hero-content">

            <h1>
                Welcome to <br>
                <span>Traffic Incident</span> Reporting System
            </h1>

            <p>
                Help keep our roads safe for everyone.
                Report incidents, stay informed,
                and make a difference in your community.
            </p>

            <button class="report-btn">
                <img src="../assets/images/warning.png" alt="">
                <a href="report-incident.php">Report an Incident</a>
            </button>

            <!-- DOTS -->
            <div class="dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

        </div>
    </section>
    <section class="tips-wrapper">
        <!-- SAFETY TIPS ---->
        <div class="tips-container">

            <div class="tips-header">

                <div class="tips-title">

                    <img src="../assets/images/shield.png" alt="">
                    <h2>Safety Tips</h2>

                </div>


            </div>

            <div class="tips-grid">

                <div class="tip-card">

                    <img src="../assets/images/safe belt.png" alt="">
                    <h3>Buckle Up</h3>
                    <p>Always wear your seatbelt.</p>

                </div>

                <div class="tip-card">

                    <img src="../assets/images/slim.png" alt="">
                    <h3>Drive Safe</h3>
                    <p>Obey speed limits and traffic rules.</p>

                </div>

                <div class="tip-card">

                    <img src="../assets/images/phone distr.webp" alt="">
                    <h3>Avoid Distractions</h3>
                    <p>Stay focused while driving.</p>

                </div>

                <div class="tip-card">

                    <img src="../assets/images/safe dis.png" alt="">
                    <h3>Keep Distance</h3>
                    <p>Maintain safe following distance.</p>

                </div>

                <div class="tip-card">

                    <img src="../assets/images/alert.png" alt="">
                    <h3>Stay Alert</h3>
                    <p>Be aware of your surroundings.</p>

                </div>

                <div class="tip-card">

                    <img src="../assets/images/cloud.png" alt="">
                    <h3>Check Conditions</h3>
                    <p>Avoid driving in bad weather.</p>

                </div>

            </div>

        </div>  

    </section>

    <!-- JAVASCRIPT  -->
    <script>

        // MOBILE MENU
        const menuToggle = document.getElementById("menuToggle");
        const navLinks = document.getElementById("navLinks");

        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("show");
        });


        // IMAGE SLIDER
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");

        let currentSlide = 0;

        function showSlide(index) {

            slides.forEach((slide) => {
                slide.classList.remove("active");
            });

            dots.forEach((dot) => {
                dot.classList.remove("active");
            });

            slides[index].classList.add("active");
            dots[index].classList.add("active");

        }

        setInterval(() => {

            currentSlide++;

            if(currentSlide >= slides.length){
                currentSlide = 0;
            }

            showSlide(currentSlide);

        }, 4000);

    </script>

</body>
</html>