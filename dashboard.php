<?php
session_start();
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>
<?php include 'db_config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/dashboards.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">


</head>

<style>
    #adminbtn:hover{
        transform: scale(1);
    }
</style>

<body>
    <nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
        <div class="pages">
            <a href="logout.php" id="adminbtn">Logout</a>
        </div>
    </nav>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <div>
        <div class="container">
            <div class="card">
                <a href="book_route.php">Book a Route</a>
            </div>
            <div class="card">
                <a href="view_bookings_users.php">View Bookings</a>
            </div>
            <div class="card">
                <a href="change_credentials.php">Change Credentials</a>
            </div>
        </div>

        <h3>Announcements:</h3>
        <?php $messages = $conn->query("SELECT * FROM admin_messages ORDER BY created_at DESC LIMIT 5");
        ?>
        <div class="messsage-container">
            <ul>
            <?php if ($messages->num_rows > 0) { ?>
                    <?php while ($row = $messages->fetch_assoc()) { ?>
                        <li class="message-item" style=" padding: 10px; margin-bottom: 15px;border-left: 5px solid #4CAF50;background-color: #f9f9f9; transition: background-color 0.3s ease"><?php echo $row['message']; ?>
                            <small>(Posted on: <?php echo $row['created_at']; ?>)</small>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="message-item"><h3 style="text-align: center;">No announcements</h3></li>
                <?php } ?>
            </ul>
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

</html>