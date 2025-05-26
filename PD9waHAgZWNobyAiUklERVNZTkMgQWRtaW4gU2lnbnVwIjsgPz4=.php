<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];



    if ($password !== $confirm_password) {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Passwords do not match!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        };
    </script>";

    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql_email = "SELECT * FROM users WHERE email = '$email'";
        $sql_username = "SELECT * FROM users WHERE username = '$username'";
        $result_email = $conn->query($sql_email);
        $result_username = $conn->query($sql_username);

        if ($result_email->num_rows > 0) {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Email already exists!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            };
        </script>";
        } elseif ($result_username->num_rows > 0) {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Username already exists!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            };
        </script>";
        }
        else {
            $sql = "INSERT INTO users (username, email, password, is_admin) 
                    VALUES ('$username', '$email', '$hashed_password', 1)";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Admin account created successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'admin_signin.php';
                    });
                };
            </script>";            
        } 
            else {
                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error: " . addslashes($conn->error) . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                };
            </script>";            
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RIDESYNC - Admin Sign Up</title>
    <link rel="stylesheet" href="style/admin_signup.css">
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
            <a href="booking.php">Booking</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="signin.php" id="adminbtn">User Login</a>
            <a href="admin_signin.php" id="adminbtn" style="color: red;">Admin Login</a>
        </div>
    </nav>

    <h2>Admin Sign Up</h2>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required autocomplete="off">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required autocomplete="off">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required autocomplete="off">

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required autocomplete="off">

        <input style="font-size: 16px;" type="submit" name="signup" value="Sign Up">
    </form>
    <p>Already have an account? <a href="admin_signin.php">Sign In</a></p>

    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
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
                    <li><a id="active" href="booking.php">Booking</a></li>
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