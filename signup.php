<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

include 'db_config.php';

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        $conn->query($sql);

        $mail = new PHPMailer(true);
        try {

            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User registered successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'signin.php'; 
                    });
                };
                </script>";

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jobsanke26198@gmail.com';
            $mail->Password   = 'iscwzyvhbbanhoov'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('ridesync@outlook.com', 'RideSync');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to RideSync!';
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; color: #333; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; max-width: 600px; margin: auto;'>
                <h2 style='color: #4CAF50; margin-top: 20px;'>📬 Welcome to RideSync, $username!</h2>
                <p style='font-size: 16px; color: #555;'>Thank you for signing up with RideSync! We're excited to have you on board.</p>

                <p style='font-size: 15px;'>Your account has been successfully created. Here are your login details:</p>
                <p style='font-size: 15px;'><strong>Username:</strong> $username</p>
                <p style='font-size: 15px;'><strong>Email:</strong> $email</p>


                <p style='margin-top: 30px; font-size: 15px;'>We're glad to have you on board. You can now manage bookings, schedules, and much more.</p>

                <p style='margin-top: 40px; font-size: 13px; color: #999;'>If you did not sign up for RideSync, please contact us.</p>

                <h3>Contact</h3>
                <Telephone:>Email : ridesync@outlook.com \nTelephone: +91 - 0123456789</p>

                <p style='margin-top: 20px;'>Thank you,<br>RideSync Team</p>
            </div>
            ";

            $mail->send();
        } catch (Exception $e) {
                echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            title: 'Email Error!',
                            text: 'Message could not be sent. Mailer Error: " . addslashes($mail->ErrorInfo) . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    };
                </script>";
            return;
        }

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            $errorMessage = "Username or Email already exists!";
        } else {
            $errorMessage = "Database Error: " . addslashes($e->getMessage());
        }

        echo "<script>
            window.onload = function(){
                Swal.fire({
                    title: 'Error!',
                    text: '$errorMessage',
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
    <title>Signup</title>
    <link rel="stylesheet" href="style/signups.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
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

    <h2>Create an Account</h2>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required autocomplete="off">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required autocomplete="off">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required autocomplete="off">

        <input style="font-size: 16px;" type="submit" name="signup" value="Sign Up">
    </form>
    <p>Already have an account? <a href="signin.php">Sign In</a></p>
    <?php include 'whatsapp.php'; ?>

    <footer style="margin-top: 100px;">
        <div class="footer-grid">
            <div class="footer-box">
                <h3>About</h3>
                <h4 style="font-size: 1.5rem;">
                    Manage your bus schedules, routes, and bookings efficiently
                </h4>
            </div>
            <div class="footer-box">
                <h3>Contact</h3>
                <p class="email-id" style="text-align:left;">Email : ridesync@outlook.com</p>
                <h4>Telephone: +91 - 0123456789</h4>
            </div>
            <div class="footer-box">
                <h3>Links</h3>
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