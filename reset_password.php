<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
session_start();

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

if (isset($_POST['update_password'])) {
    if ($_POST['new_password'] !== $_POST['confirm_new_password']) {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Passwords do not match!',
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        };
        </script>";
    } else {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);

        if ($stmt->execute()) {
            unset($_SESSION['reset_email'], $_SESSION['reset_otp']);
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your password has been reset.',
                    icon: 'success',
                    confirmButtonText: 'Login Now'
                }).then(() => {
                    window.location.href = 'signin.php';
                });
            };
            </script>";
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update password.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            };
            </script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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
        <a href="booking.php">Booking</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="signin.php" id="adminbtn" style="color:red">User Login</a>
        <a href="admin_signin.php" id="adminbtn">Admin Login</a>
    </div>
</nav>

<h2>Reset Your Password</h2>
<form action="reset_password.php" method="post" id="resetForm">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" id="new_password" required>

    <label for="confirm_new_password">Confirm New Password:</label>
    <input type="password" name="confirm_new_password" id="confirm_new_password" required>

    <input type="submit" name="update_password" value="Update Password">
</form>

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
                <li><a href="about.php">About</a></li>
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

<script>
const form = document.getElementById('resetForm');
const newPassword = document.getElementById('new_password');
const confirmNewPassword = document.getElementById('confirm_new_password');

form.addEventListener('submit', (e) => {
    if (newPassword.value !== confirmNewPassword.value) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Passwords do not match!',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    }
});
</script>

</body>
</html>
