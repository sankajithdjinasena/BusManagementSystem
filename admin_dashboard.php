<?php
session_start();
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

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
    <title>RIDESYNC - Admin Dashboard</title>
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/nav.css">
    <link rel="stylesheet" href="style/admin_dashboard.css">
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
        transform: scale(1.002);
    }

    .total_board {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    .total_card {
        cursor: pointer;
        background: #fff;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        transition: 0.3s ease;
    }

    .total_card:hover {
        transform: scale(1.02);
    }
    .total_card h3 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }
    .total_card h1 {
        font-size: 24px;
        color:rgb(0, 0, 0);
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


    <div class="total_board">
        <div class="total_card">
            <h3>Total Bus Owners</h3>
            <?php
            $sql = "SELECT * FROM bus_owners";
            $result = $conn->query($sql);
            $total_bus_owners = $result->num_rows;
            ?>
            <h1><?php echo $total_bus_owners; ?></h1>
        </div>
        <div class="total_card">
            <h3>Total Drivers</h3>
            <?php
            $sql = "SELECT * FROM drivers";
            $result = $conn->query($sql);
            $total_drivers = $result->num_rows;
            ?>
            <h1><?php echo $total_drivers; ?></h1>
        </div>
        <div class="total_card">
            <h3>Total Buses</h3>
            <?php
            $sql = "SELECT * FROM buses";
            $result = $conn->query($sql);
            $total_buses = $result->num_rows;
            ?>
            <h1><?php echo $total_buses; ?></h1>
        </div>
        <div class="total_card">
            <h3>Total Routes(Incoming)</h3>
            <?php
            $sql = "SELECT * FROM routes WHERE date >= CURDATE()";
            $result = $conn->query($sql);
            $total_routes = $result->num_rows;
            ?>
            <h1><?php echo $total_routes; ?></h1>
        </div>
        <div class="total_card">
            <h3>Total Users</h3>
            <?php
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            $total_users = $result->num_rows;
            ?>
            <h1><?php echo $total_users; ?></h1>
        </div>
        <div class="total_card">
            <h3>Total Bookings</h3>
            <?php
            $sql = "SELECT * FROM bookings";
            $result = $conn->query($sql);
            $total_bookings = $result->num_rows;
            ?>
            <h1><?php echo $total_bookings; ?></h1>
        </div>
    </div>

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
                    <a href="book_route_admin.php">Book a Route</a>

                </div>
                <div class="card">
                    <a href="post_message.php">Post message</a>
                </div>
                <div class="card">
                    <a href="contact_message.php">Contact messages</a>
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
            <ul style="list-style-type: none;">
                <?php if ($messages->num_rows > 0) { ?>
                    <?php while ($row = $messages->fetch_assoc()) { ?>
                        <li class="message-item" style=" padding: 10px; margin-bottom: 15px;border-left: 5px solid #4CAF50;background-color: #f9f9f9; transition: background-color 0.3s ease"><?php echo $row['message']; ?>
                            <small>(Posted on: <?php echo $row['created_at']; ?>)</small>
                        </li>
                    <?php } 
                    } else {?>
                    <li class="message-item"><h3 style="text-align: center; color:black">No announcements</h3></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div>
        <h3 style="color: #000000;">Contact Messages</h3>
        <div class="total_board">
            <div class="total_card">
                <h3>Total Pendings</h3>
                <?php
                $sql = "SELECT * FROM contacts WHERE replied = 'Pending'";
                $result = $conn->query($sql);
                $total_msg = $result->num_rows;
                ?>
                <h1><?php echo $total_msg; ?></h1>
            </div>
            <div class="total_card">
                <h3>Total Replied</h3>
                <?php
                $sql = "SELECT * FROM contacts WHERE replied = 'Replied'";
                $result = $conn->query($sql);
                $total_msg = $result->num_rows;
                ?>
                <h1><?php echo $total_msg; ?></h1>
            </div>
        </div>
        <?php $messages = $conn->query("SELECT * FROM contacts WHERE replied = 'Pending' ORDER BY created_at  DESC LIMIT 5 ");
        ?>
        <div class="messsage-container" style="text-align: left;">
            sort by: latest message
            <ol>
                <?php while ($row = $messages->fetch_assoc()) { ?>
                    <li class="messsage-item"><?php echo $row['message']; ?><br>
                        <small>Name : <?php echo $row['name']; ?></small><br>
                        <small>Email : <?php echo $row['email']; ?></small><br>
                        <small>Phone : <?php echo $row['phone']; ?></small><br>
                        <small>Posted on: <?php echo $row['created_at']; ?></small><br>
                        <small>Replied : <b style="color: <?php echo ($row['replied'] == 'Replied') ? 'green' : 'red'; ?>;">
                                <?php echo $row['replied']; ?></b></small>
                    </li>
                    <br>
                <?php } ?>
            </ol>
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