<?php
session_start();

// Redirect user to admin login page if not logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_signin.php");
    exit();
}
?>
<?php include 'db_config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navs.css">
    <link rel="stylesheet" href="style/admin_dashboards.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>

<style>
    #board {
        border: 2px solid black;
        margin: 10px;
        padding: 10px;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 5px;
        background-color: #000000;
    }

    .panel {
        display: inline-block;
        padding: 0 50px;
        align-items: center;
        justify-content: center;
    }

    #div {
        display: grid;
        grid-template-columns: auto;
    }

    #adminbtn:hover {
        transform: scale(0.9);
    }
</style>

<body>
    <nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>

        <div class="pages">
            <a href="admin_logout.php" id="adminbtn">Logout</a>
        </div>
    </nav>
    <h2>Welcome, Admin <?php echo $_SESSION['admin_username']; ?>!</h2>

    <div id="board">
        <h1>Admin Dashboard</h1>
        <div class="panel">
            <div id="div">
                <h3>Registrations </h3>
                <div class="card">
                    <a href="register_owner.php">Register Bus Owner</a>
                </div>
                <div class="card">
                    <a href="register_driver.php">Register Driver</a>
                </div>
                <div class="card">
                    <a href="register_bus.php">Register Bus</a>
                </div>
                <div class="card">
                    <a href="register_route.php">Register Route</a>
                </div>
                <div class="card">
                    <a href="admin_signup.php">Register Admin</a>
                </div>
            </div>
        </div>
        <div class="panel">
            <div id="div">
                <h3>Viewings</h3>
                <div class="card">
                    <a href="view_routes.php">View Routes</a>
                </div>
                <div class="card">
                    <a href="view_bookings.php">View Bookings</a>
                </div>
                <div class="card">
                    <a href="view_records.php">View Records</a>
                </div>
                <div class="card">
                    <a href="view_users.php">View Users</a>
                </div>
                <div class="card">
                    <a href="view_admins.php">View Admins</a>
                </div>
            </div>
        </div>
        <div class="panel">
            <div id="div">
                <h3>Other</h3>
                <div class="card">
                    <a href="schedules_user.php">Schedules</a>
                </div>
                <div class="card">
                    <a href="book_route_admin.php">Book a Route</a>

                </div>
                <div class="card">
                    <a href="post_message.php">Post message</a>
                </div>
                <div class="card">
                    <a href="signin.php">User</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h3 style="color: #000000;">Announcements</h3>
        <?php $messages = $conn->query("SELECT * FROM admin_messages ORDER BY created_at DESC");
        ?>
        <div class="messsage-container" style="text-align: left;">
            <ul>
                <?php if ($messages->num_rows > 0) { ?>
                    <?php while ($row = $messages->fetch_assoc()) { ?>
                        <li class="message-item"><?php echo $row['message']; ?>
                            <small>(Posted on: <?php echo $row['created_at']; ?>)</small>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="message-item"><h3 style="text-align: center; color:black">No announcements</h3></li>
                <?php } ?>

            </ul>
        </div>
    </div>
    <div>
        <h3 style="color: #000000;">Contact Messages</h3>
        <?php $messages = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
        ?>
        <div class="messsage-container" style="text-align: left;">
            <ul>
                <?php while ($row = $messages->fetch_assoc()) { ?>
                    <li class="messsage-item"><?php echo $row['message']; ?><br>
                        <small>Name : <?php echo $row['name']; ?></small>
                        <small>Email : <?php echo $row['email']; ?></small>
                        <small>Phone : <?php echo $row['phone']; ?></small>
                        <small>Posted on: <?php echo $row['created_at']; ?></small>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

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