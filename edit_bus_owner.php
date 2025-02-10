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
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
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
    <title>Edit Bus Owner</title>
    <link rel="stylesheet" href="style/form.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="stylesheet" href="style/register.css">

    <style>
    .btn-home {
    display: inline-block;
    text-decoration: none;
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    margin: 20px auto;
    display: block;
    width: fit-content;
}
.btn-home:hover {
    background-color: #218838;
}
    </style>
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

    </form>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>


</body>
</html>
