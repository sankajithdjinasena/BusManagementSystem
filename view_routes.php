<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Routes</title>
    <link rel="stylesheet" href="style/view_route.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>
<body>
    <h2>Available Routes</h2>

    <form method="GET" action="">
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
                <th>Duration</th>
                <th>Bus Number</th>
                <th>Available Seats</th>
                <th>Actions</th>
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
                            <td id='firstrow' data-title='Route ID'>{$row['id']}</td>
                            <td data-title='Date'>{$row['date']}</td>
                            <td data-title='Time'>{$row['time']}</td>
                            <td data-title='Departure Place'>{$row['departure_place']}</td>
                            <td data-title='Arrival Place'>{$row['arrival_place']}</td>
                            <td data-title='Duration'>{$row['duration']}</td>
                            <td data-title='Bus Number'>{$row['bus_number']}</td>
                            <td data-title='Available Seats'>{$row['available_seats']}</td>
                            <td data-title='Actions'>
                                                            <button><a href='edit_route.php?id={$row['id']}'>Edit</a></button>

                                <button><a href='delete_route.php?id={$row['id']}'>Delete</a></button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No routes available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>

</body>
</html>
