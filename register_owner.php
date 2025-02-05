<?php include 'db_config.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <title>Bus Owner Registration</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

    </head>
<body>
    <h2>Bus Owner Registration</h2>
    <div class="form">
    <form action="register_owner.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required autocomplete="off">

        <label>NIC:</label>
        <input type="text" name="nic" required autocomplete="off">

        <label>Email:</label>
        <input type="email" name="email" required autocomplete="off">
        
        <label>Phone:</label>
        <input type="text" name="phone" autocomplete="off">
        
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


    <?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nic = $_POST['nic'];

    $sql = "INSERT INTO bus_owners (name, email, phone,nic) VALUES ('$name', '$email', '$phone','$nic')";
    if ($conn->query($sql) === TRUE) {
        // Retrieve the last inserted ID
        $owner_id = $conn->insert_id;

        echo "<script>
            alert('Bus owner registered successfully!\\nOwner ID: $owner_id');
            window.location.href = 'register_owner.php'; // Redirect to bus owners page
          </script>";
    } else {
        echo "<script>
            alert('Error: " . addslashes($conn->error) . "');
            window.location.href = 'register_owner.php'; // Redirect back to registration page
          </script>";
    }
}
?>

</body>
</html>
