<?php include 'db_config.php'; 
include 'backbtn.php';
include 'goup.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" href="style/view_booking.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>
<body>
        <?php include 'admin_nav.php'; ?>

    <h2>Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Seats Booked</th>
                <th>Date</th>
                <th>Time</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Get in Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT bookings.id, customer_name, customer_phone, seats_booked, date, time, departure_place, arrival_place,email,get_in_location 
                                    FROM bookings 
                                    JOIN routes ON bookings.route_id = routes.id");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td id='firstrow' data-title='Booking ID'>{$row['id']}</td>
                            <td data-title='Customer Name'>{$row['customer_name']}</td>
                            <td data-title='Phone'>{$row['customer_phone']}</td>
                            <td data-title='Email'>{$row['email']}</td>
                            <td data-title='Seats Booked'>{$row['seats_booked']}</td>
                            <td data-title='Date'>{$row['date']}</td>
                            <td data-title='Time'>{$row['time']}</td>
                            <td data-title='Departure'>{$row['departure_place']}</td>
                            <td data-title='Arrival'>{$row['arrival_place']}</td>
                            <td data-title='Get in Location'>{$row['get_in_location']}</td>
                            <td data-title='Actions'>
                                <form action='delete_booking.php' method='POST'>
                                    <input type='hidden' name='booking_id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No bookings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
    <footer>
        <link rel="stylesheet" href="style/footer.css">
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
