<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDESYNC - About</title>
    <link rel="stylesheet" href="style/aboutcs.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="icon" href="Images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>

<body>
    <nav>
    <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
        <div class="pages">
            <a href="home.php">Home</a>
            <a href="schedules.php">Schedules</a>
            <a href="booking.php">Booking</a>
            <a href="about.php" id="active">About</a>
            <a href="contact.php">Contact</a>
            <a href="signin.php" id="adminbtn">User Login</a>
            <a href="admin_signin.php" id="adminbtn">Admin Login</a>
        </div>
    </nav>

    <h1><center>About us</center></h1>

    <div style="padding: 10px; margin:0 100px; font-size:1.5em;"><center>Welcome to <b>Ridesync</b>, an innovative <b>Bus Management System</b> designed to revolutionize public transportation. Our goal is to streamline bus operations, improve passenger experience, and optimize route management through cutting-edge technology.</center></div>

    <h1>
        <center>Our Mission</center>
    </h1>

    <div style="padding: 10px; margin:0 100px; font-size:1.5em;"><center>At Ridesync, we believe in creating a <b>smarter, more efficient, and eco-friendly</b> public transport system. By integrating <b>real-time scheduling, digital ticketing, and user-friendly management tools</b>, we help passengers, administrators, and drivers navigate a seamless transit experience.</center></div>

    <h1>
        <center>Vision</center>
    </h1>

    <div style="padding: 10px; margin:0 100px; font-size:1.5em;"><center>To revolutionize urban public transportation with cutting-edge technology</center></div>

    <h1><center>Why Ridesync?</center></h1>

    <div class="mission-vision">
        <div class="mission-vision-grid">
            <div class="box">
                <h2>Efficient Bus Operations</h2>
                <h3>Optimized scheduling and route management to minimize delays and fuel consumption.</h3>
            </div>
            <div class="box">
                <h2>Seamless Ticket Booking</h2>
                <h3>Digital ticketing and seat reservations for enhanced passenger convenience.</h3>
            </div>
            <div class="box">
                <h2>Smart Fleet Management</h2>
                <h3>Real-time updates on bus availability, driver schedules, and vehicle status.</h3>
            </div>
            <div class="box">
                <h2>Passenger Engagement</h2>
                <h3>User feedback and complaint handling for continuous service improvement.</h3>
            </div>
            <div class="box">
                <h2>Sustainable Urban Mobility</h2>
                <h3>Reduced carbon footprint through optimized bus routes and schedules.</h3>
            </div>
        </div>
    </div>

    <div class="key-benifits">
        <h1>Key Benifits</h1>
        <div class="key-benifits-grid">
            <div class="box">
                <h3>Online booking</h3>
            </div>
            <div class="box">
                <h3>Route optimization</h3>
            </div>
            <div class="box">
                <h3>Driver and staff management</h3>
            </div>
            <div class="box">
                <h3>Customer support or feedback system</h3>
            </div>
        </div>
    </div>

    <?php include 'whatsapp.php'; ?>

    <div class="target-audiance">
        <h1>Target Audiance</h1>
        <div class="target-audiance-grid">
            <div class="box">
                <i id="audience-card" class="fa-solid fa-clipboard-check audience-icon"></i>
                <h3>Bus operators</h3>
                <p>Manage schedules, routes, and operations efficiently.</p>
            </div>
            <div class="box">
                <i id="audience-card" class="fa-solid fa-ticket audience-icon"></i>
                <h3>Passengers</h3>
                <p>Book tickets, track buses, and enjoy seamless travel.</p>
            </div>
            <div class="box">
                <i id="audience-card" class="fa-solid fa-chart-line audience-icon"></i>
                <h3>Administrators</h3>
                <p>Monitor performance and analytics for better decisions.</p>
            </div>
            <div class="box">
                <i id="audience-card" class="fa-solid fa-building audience-icon"></i>
                <h3>Transport companies</h3>
                <p>Optimize operations and ensure smooth transport services.</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-box">
                <h3>About</h3>
                <h4 style="font-size: 1.5rem;">
                    Manage your bus schedules, routes, and bookings efficiently
                </h4>
            </div>
            <div class="footer-box">
                <h3>Contact</h3>
                <p class="email-id">Email : ridesync@outlook.com</p>
                <h4>Telephone: +91 - 0123456789</h4>
            </div>
            <div class="footer-box">
                <h3>Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="schedules.php">Schedules</a></li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="about.php" id="active">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-box">
                <h3>Social Media</h3>
                <br>
                <div class="social">
                    <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
                    <a href="https://www.instagram.com/buslink/" target="_blank"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.linkedin.com/in/buslink/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div>
        <div class="footer-end">
            <h4>&copy; 2025 RIDESYNC. All Rights Reserved</h4>
            <h5>Created by Sankajith Jinasena</h5>
        </div>
    </footer>
</body>
</html>