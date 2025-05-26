<?php include 'db_config.php'; 
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>
<!DOCTYPE html>
<html>

<head>
    <title>RIDESYNC - Booking</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/booking.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>

<body>
    <nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
        <div class="pages">
            <a href="home.php">Home</a>
            <a href="schedules.php">Schedules</a>
            <a href="booking.php" id="active">Booking</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="signin.php" id="adminbtn">User Login</a>
            <a href="admin_signin.php" id="adminbtn">Admin Login</a>
        </div>
    </nav>

    <div class="classB">

        <h1>HOW TO SIGN UP</h1>
        <div class="classB-grid">
            <div class="box">
                <div class="box-number">1</div>
                <h1>Register</h1>
                <p>Click on Sign up button.</p>
            </div>
            <div class="box">
                <div class="box-number">2</div>
                <h1>Enter you credential</h1>
                <p>Enter you Name, Email and Password.</p>
            </div>
            <div class="box">
                <div class="box-number">3</div>
                <h1>Login to Account</h1>
                <p>After Creation of your account. Login into Your account to book you ride.</p>
            </div>
        </div>
        <br>
        <div class="classB-book">
            <a href="signup.php">Sign Up</a>
        </div>
        <br><br><br>
        <h1>HOW TO BOOK BUS</h1>
        <div class="classB-grid">
            <div class="box">
                <div class="box-number">1</div>
                <h1>Login to Account</h1>
                <p>Login to your account using your credential.</p>
            </div>
            <div class="box">
                <div class="box-number">2</div>
                <h1>Click on Book a Route</h1>
                <p>Select you route ID from Schedules table, Enter your Name, Email, Phone Number and How many seats need to book. </p>
            </div>
            <div class="box">
                <div class="box-number">3</div>
                <h1>Click on Book Route</h1>
                <p>After add values click on <b>Book Route</b> button to Book your ride. </p>
            </div>
        </div>
        <br>
        <div class="classB-book">
            <a href="signin.php">Sign In</a>
        </div>

        <br><br>        


        <br><br>

        <h1>HOW TO CHECK YOUR BOOKING</h1>
        <div class="classB-grid">
            <div class="box">
                <div class="box-number">1</div>
                <h1>Login to Account</h1>
                <p>Login to your account using your credential.</p>
            </div>
            <div class="box">
                <div class="box-number">2</div>
                <h1>Click on View Bookings</h1>
                <p>After clicked, Enter your phone number when you used in booking and registered email in enter pannel.</p>
            </div>
            <div class="box">
                <div class="box-number">3</div>
                <h1>Click Filter</h1>
                <p>Click Filter button to get review your bookings. </p>
            </div>
        </div>

        <br>

        <div class="classB-grid">
            <div class="box">
                <h1 id="deletemessage"> You can Contact us for delete your bookings </h1>
                <p><b>Please Contact us using registered email or phone number that you used in booking</b></p>
            </div>
        </div>
        <div class="classB-grid">
            <div class="box">
                <h1>Board the Bus</h1>
                <p>Simply show your booking at the entrance. <strong>You can pay after getting into the bus.</strong></p>
            </div>
        </div>
        <div class="classB-grid">
            <div class="box">
                <h1>Get Your Seat</h2>
                <p>Once inside, your seat will be assigned. Enjoy a smooth and organized boarding process!</p>
            </div>
        </div>
    
        </div>
    </div>
    <?php include 'whatsapp.php'; ?>
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
                <style>
                    li a {
                        font-weight: normal;
                    }
                </style>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="schedules.php">Schedules</a></li>
                    <li><a href="booking.php" id="active">Booking</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-box">
                <h3>Social Media</h3>
                <br>
                <div class="social">
                    <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
                    <a href="https://www.instagram.com/ridesync/" target="_blank"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.linkedin.com/in/ridesync/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div>

        <div class="footer-end">
            <h4>&copy; 2025 RIDESYNC. All Rights Reserved</h4>
            <h5>Created by Sankajith Jinasena</h5>
        </div>
    </footer>
</body>
<script src="divtransition.js"></script>
</html>