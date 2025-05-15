<?php
session_start();
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

if (isset($_POST['verify_otp'])) {
    $entered_otp = $_POST['otp'];

    if ($entered_otp == $_SESSION['reset_otp']) {
        echo "<script>
        window.onload = function() {
        Swal.fire({
            title: 'OTP Verified!',
            text: 'You can now reset your password.',
            icon: 'success',
            confirmButtonText: 'Proceed'
        }).then(() => {
            window.location.href = 'reset_password.php';
        });
        };
        </script>";
    } else {
        echo "<script>
        window.onload = function() {
        Swal.fire({
            title: 'Invalid OTP!',
            text: 'The OTP you entered is incorrect.',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
        };
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    <link rel="stylesheet" href="style/signin.css">

    <style>
        input[type="text"] {
            font-size: 16px;    
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
        <div class="pages">
            <a href="home.php">Home</a>
            <a href="schedules.php">Schedules</a>
            <a href="booking.php" >Booking</a>
            <a href="about.php" >About</a>
            <a href="contact.php">Contact</a>
            <a href="signin.php" id="adminbtn" style="color:red">User Login</a>
            <a href="admin_signin.php" id="adminbtn">Admin Login</a>
        </div>
    </nav>
    <h2>Verify OTP</h2>
    <form action="verify_otp.php" method="post">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" id="otp" maxlength="6" required>
        <input type="submit" name="verify_otp" value="Verify">
        <a href="signin.php" style="text-align:center; text-decoration:none;">Back to Sign In</a>
    </form>
    <div class="otp-info">
        <p>Enter the OTP sent to your registered email: <strong><?php echo $_SESSION['reset_email']; ?></strong></p>
        <p>If you didn't receive the OTP, please check your spam folder or <a href="forgot_password.php">request a new one</a>.</p>
        
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
                <p class="email-id" style="text-align: left;">Email : ridesync@outlook.com</p>
                <h4>Telephone: +91 - 0123456789</h4>
            </div>
            <div class="footer-box">
                <h3>Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="schedules.php">Schedules</a></li>
                    <li><a href="booking.php" id="active">Booking</a></li>
                    <li><a href="about.php" >About</a></li>
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
