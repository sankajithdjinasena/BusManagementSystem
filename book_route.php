<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Book a Route</title>
</head>

<link rel="stylesheet" href="style/book_routes.css">

<body>
    <h2>Book a Route</h2>
    <form class="form1" action="book_route.php" method="POST">
        <label>Route ID:</label>
        <input type="number" name="route_id" required autocomplete="off">
        <label>Your Name:</label>
        <input type="text" name="customer_name" required autocomplete="off">
        <label>Your Phone:</label>
        <input type="text" name="customer_phone" required autocomplete="off">
        <label>Your Email:</label>
        <input type="text" name="email" required autocomplete="off">
        <label>Number of Seats:</label>
        <input type="number" name="seats" required>
        <input type="submit" name="submit" value="Book Route">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $route_id = $_POST['route_id'];
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $seats = $_POST['seats'];
        $email = $_POST['email'];

        $result = $conn->query("SELECT available_seats FROM routes WHERE id = $route_id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['available_seats'] >= $seats) {
                $new_seats = $row['available_seats'] - $seats;
                $conn->query("INSERT INTO bookings (route_id, customer_name, customer_phone,email, seats_booked) 
                              VALUES ($route_id, '$customer_name', '$customer_phone','$email', $seats)");

                $booking_id = $conn->insert_id;

                $conn->query("UPDATE routes SET available_seats = $new_seats WHERE id = $route_id");

                echo "<script>alert('Booking successful! Your Booking ID is: " . $booking_id . "');</script>";
            } else {
                echo "<script>alert('Not enough seats available!');</script>";
            }
        } else {
            echo "<script>alert('Invalid Route ID!');</script>";
        }
    }
    ?>

    <br>
    <a href="dashboard.php" class="btn-home">Go to Dashboard</a>

    <div>
        <h2>Available Routes</h2>

        <form class="form2" method="GET" action="">
            <label for="filter_departure">Departure Place:</label>
            <input type="text" name="filter_departure" id="filter_departure" placeholder="Enter departure place" autocomplete="off">
            <label for="filter_arrival">Arrival Place:</label>
            <input type="text" name="filter_arrival" id="filter_arrival" placeholder="Enter arrival place" autocomplete="off">
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
                    <th>Duration</th>
                    <th>Bus Number</th>
                    <th>Available Seats</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filter_departure = isset($_GET['filter_departure']) ? $_GET['filter_departure'] : '';
                $filter_arrival = isset($_GET['filter_arrival']) ? $_GET['filter_arrival'] : '';
                $filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';

                $sql = "SELECT routes.id, date, time, departure_place, arrival_place, bus_id, total_seats, duration, available_seats, buses.bus_number 
                FROM routes 
                JOIN buses ON routes.bus_id = buses.id";

                $conditions = [];
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
                    echo "<tr><td colspan='9'>No routes available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>