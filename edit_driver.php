<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the bus owner details
    $sql = "SELECT * FROM drivers WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $license_number = $_POST['license_number'];
    $phone = $_POST['phone'];


    $update_sql = "UPDATE drivers SET name='$name', nic='$nic', license_number='$license_number',phone='$phone' WHERE id=$id";

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
    <title>Edit Driver </title>
    <link rel="stylesheet" href="style/form.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <link rel="stylesheet" href="style/registers.css">
    <link rel="stylesheet" href="style/view_records.css">

</head>
<body>
    <h2>Edit Driver</h2>
    <form method="POST">
        <label>Driver Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label>NIC:</label>
        <input type="text" name="nic" value="<?php echo $row['nic']; ?>" required><br>

        <label>License Number:</label>
        <input type="text" name="license_number" value="<?php echo $row['license_number']; ?>" required><br>

        <label>Teelphone Number:</label>
        <input type="number" name="phone" value="<?php echo $row['phone']; ?>" required><br>

        <button type="submit">Update</button>
        <a href="view_records.php">Cancel</a>
    </form>

    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>

</body>
</html>
