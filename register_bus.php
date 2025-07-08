<?php include 'db_config.php'; 
include 'backbtn.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>
<?php include 'goup.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <title>Bus Registration</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    <style>
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
<?php include 'admin_nav.php'; ?>
    <div class="form">
        <h2>Bus Registration</h2>
        <form action="register_bus.php" method="POST">
            <label>Bus Number:</label>
            <input type="text" name="bus_number" required>

            <label>Engine Number:</label>
            <input type="text" name="engine_number" required>

            <label>Owner ID:</label>
            <select name="owner_id" required>
                <option value="">-- Select Owner ID --</option>
                <?php
                $query = "SELECT id, name FROM bus_owners"; 
                $result = $conn->query($query);
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['id']} - {$row['name']}</option>";
                }
                ?>
            </select>

            <label>Driver ID:</label>
            <select name="driver_id" required>
                <option value="">-- Select Driver ID --</option>
                <?php
                $query = "SELECT id, name FROM drivers"; 
                $result = $conn->query($query);
                
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['id']} - {$row['name']}</option>";
                }
                ?>
            </select>

            <label>Route:</label>
            <input type="text" name="route">

            <label>Capacity:</label>
            <p style="color:red">Max : 54</p>
            <input type="number" name="capacity" min="1" max="54" required>

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
        $engine_number = $_POST['engine_number'];
        $owner_id = $_POST['owner_id'];
        $driver_id = $_POST['driver_id'];
        $route = $_POST['route'];
        $capacity = $_POST['capacity'];

        try {
            $stmt = $conn->prepare("INSERT INTO buses (bus_number, engine_number, owner_id, driver_id, route, capacity) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssisi", $bus_number, $engine_number, $owner_id, $driver_id, $route, $capacity);
            $stmt->execute();

            $bus_id = $stmt->insert_id;
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Bus registered successfully!\\nBus ID: $bus_id',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'view_records.php'; 
                });
            </script>";

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $errorMessage = "Bus Number or Engine Number already exists!";
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
                    window.location.href = 'register_bus.php'; 
                });
            </script>";
        }
    }
    ?>
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