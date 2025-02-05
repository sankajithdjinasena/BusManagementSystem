<?php include 'db_config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Bus Registration</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>

<body>
    <div class="form">
        <h2>Bus Registration</h2>
        <form action="register_bus.php" method="POST">
            <label>Bus Number:</label>
            <input type="text" name="bus_number" required>

            <label>Owner ID:</label>
            <input type="text" name="owner_id" required>

            <label>Driver ID:</label>
            <input type="text" name="driver_id" required>

            <label>Route:</label>
            <input type="text" name="route">

            <label>Capacity:</label>
            <input type="number" name="capacity">

            <input type="submit" name="submit" value="Register">
        </form>
        <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
    </div>

    <h2>Bus Owners</h2>
    <form method="GET" action="">
        <label for="filter_bus_owner">Filter by NIC:</label>
        <input type="text" name="filter_bus_owner" id="filter_bus_owner" placeholder="Enter NIC">
        <button type="submit">Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIC</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter = isset($_GET['filter_bus_owner']) ? $_GET['filter_bus_owner'] : '';
            $sql = "SELECT * FROM bus_owners";
            if (!empty($filter)) {
                $sql .= " WHERE nic = '$filter'";
            }
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td id='firstrow' data-title='ID'>{$row['id']}</td>
                        <td data-title='Name'>{$row['name']}</td>
                        <td data-title='NIC'>{$row['nic']}</td>
                        <td data-title='Email'>{$row['email']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Drivers</h2>
    <form method="GET" action="">
        <label for="filter_driver">Filter by License:</label>
        <input type="text" name="filter_license" id="filter_driver" placeholder="Enter License No:">
        <button type="submit">Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIC</th>
                <th>License</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter = isset($_GET['filter_license']) ? $_GET['filter_license'] : '';
            $sql = "SELECT * FROM drivers";
            if (!empty($filter)) {
                $sql .= " WHERE license_number LIKE '%$filter%'";
            }
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td id='firstrow' data-title='ID'>{$row['id']}</td>
                        <td data-title='Name'>{$row['name']}</td>
                        <td data-title='NIC'>{$row['nic']}</td>
                        <td data-title='License'>{$row['license_number']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    if (isset($_POST['submit'])) {
        $bus_number = $_POST['bus_number'];
        $owner_id = $_POST['owner_id'];
        $driver_id = $_POST['driver_id'];
        $route = $_POST['route'];
        $capacity = $_POST['capacity'];

        $sql = "INSERT INTO buses (bus_number, owner_id, driver_id, route, capacity) 
                VALUES ('$bus_number', '$owner_id', '$driver_id', '$route', '$capacity')";

        if ($conn->query($sql) === TRUE) {
            $bus_id = $conn->insert_id;
            echo "<script>
            alert('Bus registered successfully! Bus ID: " . $bus_id . "');
            window.location.href = 'view_records.php'; 
            </script>";
        } else {
            echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'register_bus.php'; 
            </script>";
        }
    }
    ?>
</body>

</html>