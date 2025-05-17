<?php include 'db_config.php'; 
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Route Registration</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    <style>
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>

</head>
<body>
    <div class="form">
    <h2>Route Registration</h2>
    <form action="register_route.php" method="POST">
        <label>Date:</label>
        <input id="date" type="date" name="date" required>
        
        <label>Time:</label>
        <input type="time" name="time" required>
        
        <label>Departure Place:</label>
        <input type="text" name="departure_place" required>
        
        <label>City Passed</label>
        <input type="text" name="city_passed" required>

        <label>Arrival Place:</label>
        <input type="text" name="arrival_place" required>
        
        <label>Duration (e.g., 2 hours, 30 mins):</label>
        <input type="text" name="duration" required>
        
        <label>Bus ID:</label>
        <select name="bus_id" required>
                <option value="">-- Select Bus ID --</option>
                <?php
                $query = "SELECT id, bus_number FROM buses"; 
                $result = $conn->query($query);
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['id']} - {$row['bus_number']}</option>";
                }
                ?>
            </select>
        
        <label>Total Seats:</label>
        <p style="color:red">Max : 54</p>
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
                        <td id='firstrow' data-title='ID'>{$row['id']}</td>
                        <td data-title='Bus Number'>{$row['bus_number']}</td>
                        <td data-title='Route'>{$row['route']}</td>
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
        $city_passed = $_POST['city_passed'];

        $sql = "INSERT INTO routes (date, time, departure_place, arrival_place, duration, bus_id, total_seats, available_seats,city_passed) 
                VALUES ('$date', '$time', '$departure_place', '$arrival_place', '$duration', '$bus_id', '$total_seats', '$total_seats','$city_passed')";
        
        if ($conn->query($sql) === TRUE) {
            $route_id = $conn->insert_id; 
            echo "<script>
            window.onload = function() {
            Swal.fire({
                title: 'Success!',
                text: 'Route registered successfully! Route ID: " . $route_id . "',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'view_routes.php';
            });
        };

        </script>";
        } else {
            echo "<script>
            window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Error: " . addslashes($conn->error) . "',
                icon: 'error',
                confirmButtonText: 'Try Again'
            }).then(() => {
                window.location.href = 'register_route.php';
            });
        };
        </script>";
        }
    }
    ?>
</body>

<script>
    document.getElementById("date").min = new Date().toISOString().split("T")[0];
    </script>
</html>
