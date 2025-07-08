<?php include 'db_config.php'; 
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include 'backbtn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Registration</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    
</head>
<body>
    <?php include 'admin_nav.php'; ?>
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

        try {
            $sql = "INSERT INTO drivers (name, phone, license_number) VALUES ('$name',  '$phone', '$license_number')";
            
            if ($conn->query($sql) === TRUE) {
                $driver_id = $conn->insert_id;
                
                echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Driver registered successfully!\\nDriver ID: $driver_id',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'view_records.php';
                    });
                </script>";
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $errorMessage = "Email, Phone, or License Number already exists!";
            } else {
                $errorMessage = "Error: " . addslashes($e->getMessage());
            }
        
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: '$errorMessage',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location.href = 'register_driver.php';
                });
            </script>";
        }
    }        
    ?>
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
                        <td id='firstrow'  data-title='ID'>{$row['id']}</td>
                        <td data-title='Name'>{$row['name']}</td>
                        <td data-title='NIC'>{$row['nic']}</td>
                        <td data-title='License'>{$row['license_number']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <link rel="stylesheet" href="style/footer.css">
        <div class="footer-grid">
            <div class="footer-box">
                <h3>About</h3>
                <h4 style="font-size: 1.5rem;">
                    Manage your bus schedules, routes, and bookings efficiently
                </h4>
            </div>
            <div class="footer-box">
                <h3>Contact</h3>
                <p class="email-id" style="text-align: left;">Email : ridesync@outlook.com</p>
                <h4>Telephone: +91 - 0123456789</h4>
            </div>
            <div class="footer-box">
                <h3>Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="schedules.php">Schedules</a></li>
                    <li><a href="booking.php" id="active">Booking</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-box">
                <h3>Social Media</h3>
                <br>
                <div class="social">
                    <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
                    <a href="https://www.instagram.com/ridesync/" target="_blank"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.linkedin.com/in/ridesync/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div>
        <div class="footer-end">
            <h4>&copy; 2025 RIDESYNC. All Rights Reserved</h4>
            <h5>Created by Sankajith Jinasena</h5>
        </div>
    </footer>
</body>
</html>
