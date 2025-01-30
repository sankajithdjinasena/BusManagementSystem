<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the bus owner details
    $sql = "SELECT * FROM bus_owners WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];

    $update_sql = "UPDATE bus_owners SET name='$name', nic='$nic', email='$email' WHERE id=$id";

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
    <title>Edit Bus Owner</title>
    <link rel="stylesheet" href="style/form.css">
</head>
<body>
    <h2>Edit Bus Owner</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label>NIC:</label>
        <input type="text" name="nic" value="<?php echo $row['nic']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>

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
</body>
</html>
