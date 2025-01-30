<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" href="style/view_booking_users.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>
<body>
    <h2>Bookings</h2>

    <form method="GET" action="">
        <h3 style="color:red">Enter your Telephone number & Email to view your bookings</h3>
        <label for="filter_phone">Telephone no:</label>
        <input type="text" name="filter_phone" id="filter_phone" placeholder="Enter Telephone no." required>

        <label for="filter_email">Email:</label>
        <input type="text" name="filter_email" id="filter_email" placeholder="Enter Email Address" required>
        <button type="submit">Filter</button>
    </form>

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['filter_phone']) && isset($_GET['filter_email'])) {
                $filter_phone = $conn->real_escape_string($_GET['filter_phone']);
                $filter_email = $conn->real_escape_string($_GET['filter_email']);

                $sql = "SELECT bookings.id, customer_name, customer_phone, seats_booked, date, time, departure_place, arrival_place, email 
                        FROM bookings 
                        JOIN routes ON bookings.route_id = routes.id
                        WHERE customer_phone = '$filter_phone' AND email = '$filter_email'";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['customer_name']}</td>
                                <td>{$row['customer_phone']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['seats_booked']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['time']}</td>
                                <td>{$row['departure_place']}</td>
                                <td>{$row['arrival_place']}</td>
                                <td>
                                    <form action='delete_booking_user.php' method='POST'>
                                        <input type='hidden' name='booking_id' value='{$row['id']}'>
                                        <button type='submit'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='message'>No bookings found for the provided phone number and email.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='message'>Please enter both phone number and email to view bookings.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="dashboard.php" class="btn-home">Go to Dashboard</a>
</body>
</html>
