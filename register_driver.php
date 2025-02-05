<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Driver Registration</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    
</head>
<body>
    <div class="form">
    <h2>Driver Registration</h2>

    <form action="register_driver.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required autocomplete="off">

        <label>NIC: </label>
        <input type="text" name="nic" required autocomplete="off">

        <label>License Number:</label>
        <input type="text" name="license_number" required autocomplete="off">
        
        <label>Phone:</label>
        <input type="text" name="phone" required autocomplete="off">
        
        <input type="submit" name="submit" value="Register">
    </form>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
    </div>
    

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $license_number = $_POST['license_number'];
        $phone = $_POST['phone'];
        $nic = $_POST['nic'];

        $sql = "INSERT INTO drivers (name, license_number, phone,nic) VALUES ('$name', '$license_number', '$phone','$nic')";
        
        if ($conn->query($sql) === TRUE) {
            $driver_id = $conn->insert_id;  
            echo "<script>
            alert('Driver registered successfully! Driver ID: " . $driver_id . "');
            window.location.href = 'view_records.php'; 
            </script>";
        } else {
            echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'register_driver.php'; 
            </script>";
        }
    }
    ?>
</body>
</html>
