<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the bus owner details
    $sql = "SELECT * FROM buses WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $owner_id = $_POST['owner_id'];
    $driver_id = $_POST['driver_id'];
    $route = $_POST['route'];
    $capacity = $_POST['capacity'];


    $update_sql = "UPDATE buses SET owner_id='$owner_id', driver_id='$driver_id', route='$route',capacity='$route' WHERE id=$id";

    if ($conn->query($update_sql)) {
        echo "Record updated successfully!";
        header("Location: view_records.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Bus </title>
    <link rel="stylesheet" href="style/form.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <link rel="stylesheet" href="style/registers.css">
    <link rel="stylesheet" href="style/view_records.css">

</head>
<body>
    <h2>Edit Bus </h2>
    <form method="POST">
        <label>Owner ID:</label>
        <input type="text" name="owner_id" value="<?php echo $row['owner_id']; ?>" required><br>

        <label>Driver ID:</label>
        <input type="text" name="driver_id" value="<?php echo $row['driver_id']; ?>" required><br>

        <label>Route:</label>
        <input type="text" name="route" value="<?php echo $row['route']; ?>" required><br>

        <label>Capacity:</label>
        <input type="number" name="capacity" value="<?php echo $row['capacity']; ?>" required><br>

        <button type="submit">Update</button>
        <a href="view_records.php">Cancel</a>
    </form>

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
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['nic']}</td>
                        <td>{$row['email']}</td>
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
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['nic']}</td>
                        <td>{$row['license_number']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
</body>
</html>
