<!DOCTYPE html>
<html lang="en">
<?php include 'goup.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDESYNC - Contact</title>
    <link rel="icon" href="Images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/contact.css">

    <style>
        textarea{
    font-family: Arial, Helvetica, sans-serif;
}
    </style>
</head>

<body>
    <nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
        <div class="pages">
            <a href="home.php">Home</a>
            <a href="schedules.php">Schedules</a>
            <a href="booking.php">Booking</a>
            <a href="about.php">About</a>
            <a href="contact.php" id="active">Contact</a>
            <a href="signin.php" id="adminbtn">User Login</a>
            <a href="admin_signin.php" id="adminbtn">Admin Login</a>
        </div>
    </nav>

    <div class="container">
    <div class="box1">
            <h1 id="box1h1">Let's chat</h1>
            <p id="p">Whether you have a question, want to connect</p>
            <p id="p">Feel free to send me a message in the contact form</p>
        </div>
        <div class="box3">
            <h1><center>Contact us</center></h1>
            <form action="contact_form.php" method="POST">
                <input id="contact-form" type="text" name="name" placeholder="Name*" required>
                <input id="contact-form" type="email" name="email" placeholder="Email*" required>
                <input id="contact-form" type="text" name="phone" placeholder="Phone*" required>
                <textarea id="contact-form" name="message" placeholder="Message" required></textarea><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div class="box2">
        <div class="box2b">
            <i id="contact-icon" class='bx bxs-phone'></i>
            <h3>Phone Number</h3>
            <br>
            <p id="p">+91 - 0123456789</p>
        </div>
        <div class="box2b">
            <i id="contact-icon" class='bx bx-envelope'></i>
            <h3>Email</h3>
            <br>
            <p id="p">ridesync@outlook.com</p>
        </div>
        <div class="box2b">
            <i id="contact-icon" class='bx bxs-location-plus'></i>
            <h3>Location</h3>
            <br>
            <p id="p">Kandy</p>
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
                <p style="font-size: 16px;">Email : ridesync@outlook.com</p>
                <h4>Telephone: +91 - 0123456789</h4>
            </div>
            <div class="footer-box">
                <h3>Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="schedules.php">Schedules</a></li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a id="active" href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-box">
                <h3>Social Media</h3>
                <br>
                <div class="social">
                    <a href="https://www.facebook.com/" target="_blank"><i
                            class='bx bxl-facebook'></i></a>
                    <a href="https://www.instagram.com/ridesync/" target="_blank"><i
                            class='bx bxl-instagram'></i></a>
                    <a href="https://www.linkedin.com/in/ridesync/" target="_blank"><i
                            class='bx bxl-linkedin'></i></a>
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