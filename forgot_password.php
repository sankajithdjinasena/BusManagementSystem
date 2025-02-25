<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['send_otp'])) {
    $email = $_POST['email'];    

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $otp = rand(100000, 999999);

        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_otp'] = $otp;

        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jobsanke26198@gmail.com'; 
            $mail->Password = 'iscwzyvhbbanhoov'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ridysync@outlook.com', 'RIDESYNC');
            $mail->addAddress($email); 

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP';
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; color: #333; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px;'>
                <h2 style='color: #4CAF50;'>🔐 Password Reset Request</h2>
                <p>You requested to reset your password. Use the OTP below to proceed:</p>
                <div style='padding: 15px; background-color: #fff; border: 1px dashed #4CAF50; border-radius: 5px; text-align: center;'>
                    <p style='font-size: 24px; font-weight: bold; color: #4CAF50;'>$otp</p>
                </div>
                <p style='margin-top: 20px;'>If you didn't request this, please ignore this email.</p>
                <p>Thank you,<br>RIDESYNC</p>
            </div>
            ";
            $mail->send();

            echo "<script>
            window.onload = function() {
            Swal.fire({
                title: 'OTP Sent!',
                text: 'An OTP has been sent to your email.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'verify_otp.php';
            });
            };

            </script>";

        } catch (Exception $e) {
            echo "<script>
            window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Failed to send OTP. Mailer Error: {$mail->ErrorInfo}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            };
            </script>";
        }

    } else {
        echo "<script>
        window.onload = function(){
        Swal.fire({
            title: 'Error!',
            text: 'No user found with this email!',
            icon: 'error',
            confirmButtonText: 'Try Again'
        }).then(() => {
            window.location.href = 'signin.php'; 
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
    <title>Forgot Password - OTP</title>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <link rel="stylesheet" href="style/signin.css">
    
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
    <h2>Forgot Password</h2>
    <form action="forgot_password.php" method="post">
        <p>Enter your registered Email to get your OTP code</p>
        <label for="email">Enter your email:</label>
        <input type="email" name="email" id="email" required>
        <input type="submit" name="send_otp" value="Send OTP">
    </form>
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
