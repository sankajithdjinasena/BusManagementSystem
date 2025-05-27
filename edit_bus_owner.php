<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM bus_owners WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];


    $update_sql = "UPDATE bus_owners SET name='$name', nic='$nic', email='$email' WHERE id=$id";

    if ($conn->query($update_sql)) {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Success!',
                text: 'Record updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'view_records.php'; 
            });
        };
    </script>";
        exit();
    } else {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Error: " . addslashes($conn->error) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        };
        </script>";
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
    <?php include 'admin_nav.php';
    include 'backbtn.php' ?>

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
