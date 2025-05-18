<?php include 'db_config.php'; 
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Route</title>
</head>
    <link rel="stylesheet" href="style/book_routes.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    <style>
        .table-container{
            max-height: 600px;
            overflow-y: auto;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
    </style>

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
        Enter your email address to receive booking confirmation.   
        <input type="text" name="email" required autocomplete="off">
        <label>Get in location</label>
        <input type="text" name="get_in_location" required autocomplete="off">
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
        $get_in_location = $_POST['get_in_location'];

        $result = $conn->query("SELECT available_seats FROM routes WHERE id = $route_id AND date >= CURDATE()");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['available_seats'] >= $seats) {
                $new_seats = $row['available_seats'] - $seats;
                $conn->query("INSERT INTO bookings (route_id, customer_name, customer_phone,email, seats_booked,get_in_location) 
                              VALUES ($route_id, '$customer_name', '$customer_phone','$email', $seats,'$get_in_location')");
                $booking_id = $conn->insert_id;
                $conn->query("UPDATE routes SET available_seats = $new_seats WHERE id = $route_id");

                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Booking successful! Your Booking ID is: $booking_id',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'view_route_admin.php';
                    });
                };
            </script>";
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Not enough seats available!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            };
        </script>";
            }
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Not enough seats available!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'view_route_admin.php';
                });
            };
        </script>";
        }
    }
    ?>
        <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>

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
            <button type="reset" onclick="window.location='book_route_admin.php'">Clear</button>
        </form>
        <div class="table-container">
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
                $conditions[] = "date >= CURDATE()";

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
                        <td id='firstrow' data-title='Route ID'>{$row['id']}</td>
                        <td data-title='Date'>{$row['date']}</td>
                        <td data-title='Time'>{$row['time']}</td>
                        <td data-title='Departure Place'>{$row['departure_place']}</td>
                        <td data-title='Arrival Place'>{$row['arrival_place']}</td>
                        <td data-title='Duration'>{$row['duration']}</td>
                        <td data-title='Bus Number'>{$row['bus_number']}</td>
                        <td data-title='Available Seats'>{$row['available_seats']}</td>
                      </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No routes available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
<script>
  document.getElementById("filter_date").min = new Date().toISOString().split("T")[0];
</script>
</html>