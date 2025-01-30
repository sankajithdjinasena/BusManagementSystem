<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style/view_records.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    <title>View Records</title>
</head>

<body>

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
                <th>Actions</th>
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
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['nic']}</td>
                        <td>{$row['email']}</td>
                        
                        <td>
                            <button><a href='edit_bus_owner.php?table=bus_owners&id={$row['id']}'>Edit</a></button>
                            <button><a href='delete_record.php?table=bus_owners&id={$row['id']}'>Delete</a></button>
                        </td>
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
                <th>Updated At</th>
                <th>Actions</th>
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
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['nic']}</td>
                        <td>{$row['license_number']}</td>
                        <td>{$row['updated_at']}</td>
                        <td>
                            <button><a href='edit_driver.php?table=drivers&id={$row['id']}'>Edit</a></button>
                            <button><a href='delete_record.php?table=drivers&id={$row['id']}'>Delete</a></button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Buses</h2>
    <form method="GET" action="">
        <label for="filter_bus">Filter by Bus Number:</label>
        <input type="text" name="filter_bus" id="filter_bus" placeholder="Enter bus number">
        <button type="submit">Filter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bus Number</th>
                <th>Route</th>
                <th>Actions</th>
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
                        <td>
                            <button><a href='edit_bus.php?table=buses&id={$row['id']}'>Edit</a></button>
                            <button><a href='delete_record.php?table=buses&id={$row['id']}'>Delete</a></button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>

</body>

</html>