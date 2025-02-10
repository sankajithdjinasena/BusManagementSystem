<?php
include 'db_config.php';     
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


session_start(); 

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND is_admin = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Admin login successful!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'admin_dashboard.php'; // Redirect after clicking OK
                    });
                };
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                 Swal.fire({
                    title: 'Error!',
                    text: 'Incorrect password!',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            };
            </script>";        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'No admin found with this email!',
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RIDESYNC - Admin Sign In</title>
    <link rel="stylesheet" href="style/admin_signins.css">
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
            <a href="admin_signin.php" id="adminbtn" style="color:red">Admin Login</a>
            <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
        </div>
    </nav>

    <h2>Admin Sign In</h2>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required >

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required >

        <input type="submit" name="signin" value="Sign In">
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
                <p style="text-align:left" >Email : ridesync@outlook.com</p>
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
