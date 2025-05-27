<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM drivers WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $license_number = $_POST['license_number'];
    $phone = $_POST['phone'];

    $update_sql = "UPDATE drivers SET name='$name', nic='$nic', license_number='$license_number',phone='$phone' WHERE id=$id";

    if ($conn->query($update_sql)) {
    echo "<script>
    window.onload = function() {
        Swal.fire({
            title: 'Success!',
            text: 'Record updated successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'view_records.php'; // Redirect to the records page
        });
        };
    </script>";
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
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">




</head>
<body>
    <?php include 'admin_nav.php';
    include 'backbtn.php' ?>
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
