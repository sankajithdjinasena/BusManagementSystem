<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>View Routes</title>
    <link rel="stylesheet" href="style/schedules.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style/navs.css">
    <link rel="stylesheet" href="style/footer.css">
</head>

<body>
    <nav>
        <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>

        <div class="pages">
            <a href="home.php">Home</a>
            <a href="schedules.php" id="active">Schedules</a>
            <a href="booking.php">Booking</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="admin_signin.php" id="adminbtn">Admin Login</a>
        </div>
    </nav>

    <h2>Available Bus Schedules</h2>
    <form method="GET" action="" style="max-width: 800px; margin: 0 auto;">
        <label for="filter_bus">Bus No:</label>
        <input type="text" name="filter_bus" id="filter_bus" placeholder="Enter bus no">
        <label for="filter_departure">Departure Place:</label>
        <input type="text" name="filter_departure" id="filter_departure" placeholder="Enter departure place">
        <label for="filter_arrival">Arrival Place:</label>
        <input type="text" name="filter_arrival" id="filter_arrival" placeholder="Enter arrival place">
        <label for="filter_date">Date:</label>
        <input type="date" name="filter_date" id="filter_date">
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Route ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Departure Place</th>
                <th>Arrival Place</th>
                <th>Duration(hours)</th>
                <th>Bus Number</th>
                <th>Available Seats</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter_bus = isset($_GET['filter_bus']) ? $_GET['filter_bus'] : '';
            $filter_departure = isset($_GET['filter_departure']) ? $_GET['filter_departure'] : '';
            $filter_arrival = isset($_GET['filter_arrival']) ? $_GET['filter_arrival'] : '';
            $filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';

            $sql = "SELECT routes.id, date, time, departure_place, arrival_place, bus_id, total_seats, duration, available_seats, buses.bus_number 
                    FROM routes 
                    JOIN buses ON routes.bus_id = buses.id";

            $conditions = [];
            if (!empty($filter_bus)) {
                $conditions[] = "buses.bus_number LIKE '%$filter_bus%'";
            }
            if (!empty($filter_departure)) {
                $conditions[] = "departure_place LIKE '%$filter_departure%'";
            }
            if (!empty($filter_arrival)) {
                $conditions[] = "arrival_place LIKE '%$filter_arrival%'";
            }
            if (!empty($filter_date)) {
                $conditions[] = "date = '$filter_date'";
            }

            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['time']}</td>
                            <td>{$row['departure_place']}</td>
                            <td>{$row['arrival_place']}</td>
                            <td>{$row['duration']}</td>
                            <td>{$row['bus_number']}</td>
                            <td>{$row['available_seats']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No Schedules available.</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <br>

    <footer>
        >
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
                <style>
                    li a {
                        font-weight: normal;
                    }
                </style>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="schedules.php" id="active">Schedules</a></li>
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