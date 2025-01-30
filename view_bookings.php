<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" href="style/view_bookings.css">
</head>
<body>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT bookings.id, customer_name, customer_phone, seats_booked, date, time, departure_place, arrival_place,email 
                                    FROM bookings 
                                    JOIN routes ON bookings.route_id = routes.id");
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
                                <form action='delete_booking.php' method='POST'>
                                    <input type='hidden' name='booking_id' value='{$row['id']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No bookings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
</body>
</html>
