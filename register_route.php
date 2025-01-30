<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Route Registration</title>
    <link rel="stylesheet" href="style/registers.css">
    <link rel="stylesheet" href="style/view_records.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>
<body>
    <div class="form">
    <h2>Route Registration</h2>
    <form action="register_route.php" method="POST">
        <label>Date:</label>
        <input type="date" name="date" required>
        
        <label>Time:</label>
        <input type="time" name="time" required>
        
        <label>Departure Place:</label>
        <input type="text" name="departure_place" required>
        
        <label>Arrival Place:</label>
        <input type="text" name="arrival_place" required>
        
        <label>Duration (e.g., 2 hours, 30 mins):</label>
        <input type="text" name="duration" required>
        
        <label>Bus ID:</label>
        <input type="number" name="bus_id" required>
        
        <label>Total Seats:</label>
        <input type="number" name="total_seats" required>
        
        <input type="submit" name="submit" value="Register Route">
    </form>  
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
    </div>

    <h2>Buses</h2>
    <form method="GET" action="">
        <label for="filter_bus">Filter by Bus Number:</label>
        <input type="text" name="filter_bus" id="filter_bus" placeholder="Enter Bus number">
        <button type="submit">Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bus Number</th>
                <th>Route</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter = isset($_GET['filter_bus']) ? $_GET['filter_bus'] : '';
            $sql = "SELECT * FROM buses";
            if (!empty($filter)) {
                $sql .= " WHERE bus_number LIKE '%$filter%'";
            }
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['bus_number']}</td>
                        <td>{$row['route']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    

    <?php
    if (isset($_POST['submit'])) {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $departure_place = $_POST['departure_place'];
        $arrival_place = $_POST['arrival_place'];
        $duration = $_POST['duration'];
        $bus_id = $_POST['bus_id'];
        $total_seats = $_POST['total_seats'];

        $sql = "INSERT INTO routes (date, time, departure_place, arrival_place, duration, bus_id, total_seats, available_seats) 
                VALUES ('$date', '$time', '$departure_place', '$arrival_place', '$duration', '$bus_id', '$total_seats', '$total_seats')";
        
        if ($conn->query($sql) === TRUE) {
            $route_id = $conn->insert_id; 
            echo "<script>
            alert('Route registered successfully! Route ID: " . $route_id . "');
            window.location.href = 'view_routes.php'; 
            </script>";
        } else {
            echo "<script>
            alert('Error: " . addslashes($conn->error) . "');
            window.location.href = 'register_route.php'; 
            </script>";
        }
    }
    ?>
</body>
</html>
