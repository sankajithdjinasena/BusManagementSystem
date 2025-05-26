<?php include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .message-item:hover {
        background-color: #e8f5e9;
        transform: scale(1.015);
    }

    textarea {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDESYNC - Home</title>
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style/contact.css">
    <link rel="stylesheet" href="style/message.css">

</head>

<body>
    <nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
        <div class="pages">
            <a href="home.php" id="active">Home</a>
            <a href="schedules.php">Schedules</a>
            <a href="booking.php">Booking</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="signin.php" id="adminbtn">User Login</a>
            <a href="admin_signin.php" id="adminbtn">Admin Login</a>
        </div>
    </nav>

    <div class="classA">
        <div class="classA-start">
            <div class="classA-Image"><img src="Images/LogoN.png" alt="RIDESYNC Logo"></div>
            <div class="classA-content">
<h1 style="font-size: 32px; text-align: center; color: white; background-color:rgb(0, 0, 0); padding: 15px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.3); font-family: Georgia, serif;">WELCOME TO THE RIDESYNC</h1>
                <p>Manage your bus schedules, routes, and bookings efficiently.</p>
                <p id="bookp" style="font-size: 30px; font-weight:bold;">Book Your Ride </p>

                <div class="classB-book">
                    <a href="booking.php">Book</a>
                </div>
            </div>
        </div>
    </div>

    <style>
    </style>
    <div>
        <h3 style="color: #000000; font-size:40px; text-align:center;">ANNOUNCEMENT</h3>
        <?php $messages = $conn->query("SELECT * FROM admin_messages ORDER BY created_at DESC LIMIT 5");
        ?>

        <div class="messsage-container" style="width: 80%;
                                                margin: 20px auto;
                                                background-color: #fff;
                                                padding: 20px;
                                                border-radius: 8px;
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <ul style="list-style-type: none;
                        padding: 0;">
                <?php if ($messages->num_rows > 0) { ?>
                    <?php while ($row = $messages->fetch_assoc()) { ?>
                        <li class="message-item" style="cursor: pointer;
                        
                                                        border-radius: 5px;
                                                        padding: 15px 25px;
                                                        font-size: 20px;
                                                        margin-bottom: 15px;
                                                        border-left: 5px solid #4CAF50;
                                                        background-color: #f9f9f9;
                                                        transition: background-color 0.3s ease;
                                                        transition: 0.3s ease; ">
                            <?php echo $row['message']; ?>
                            <small style="display: block;
                                                        color: #888;
                                                        font-size: 14px;
                                                        margin-top: 5px;">
                                (Posted on: <?php echo $row['created_at']; ?>)</small>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <h1>
                        <center>No Announcements</center>
                    </h1>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="classB">
        <h1><a href="booking.php" style="text-decoration: none; color:#000000">HOW TO BOOK BUS</a></h1>
        <div class="classB-grid">
            <div class="box">
                <div class="box-number">1</div>
                <h1>Register</h1>
                <p>Register to the RIDESYNC web application.</p>

            </div>
            <div class="box">
                <div class="box-number">2</div>
                <h1>Login to Account</h1>
                <p>Login to your account using your credential.</p>
            </div>
            <div class="box">
                <div class="box-number">3</div>
                <h1>Book Your Ride</h1>
                <p>Select you route and click on <span id="book">Book</span> to booking your ride. </p>
            </div>
        </div>
        <br>
        <div class="classB-book">
            <a href="signin.php">Sign In</a>
            <a href="signup.php">Sign Up</a>
        </div>
    </div>

    <h3 id="contact" style="color: #000000; font-size:40px; text-align:center;">Contact us</h3>

    <link rel="stylesheet" href="style/contact.css">
    <div class="container">
        <div class="box1">
            <h1 id="box1h1">Let's chat</h1>
            <p id="p">Whether you have a question, want to connect</p>
            <p id="p">Feel free to send me a message in the contact form</p>
        </div>
        <div class="box3">
            <h1>Contact us</h1>
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
    <footer style="margin-top:100px">
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
                    <li><a id="active" href="home.php">Home</a></li>
                    <li><a href="schedules.php">Schedules</a></li>
                    <li><a href="booking.php">Booking</a></li>
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

<script src="divtransition.js" text="text/javascript"></script>

</html>