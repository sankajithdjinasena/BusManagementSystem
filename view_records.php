<?php include 'db_config.php'; 
include 'backbtn.php'?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style/view_record.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <style>
        input[type="text"],input[type="number"],button {
        padding: 8px;
        margin: 0 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        }
        .table-container{
            max-height: 300px;
            overflow-y: auto;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }        
    </style>
    <title>View Records</title>
</head>

<body>

    <h2>Bus Owners</h2>
    <form method="GET" action="">
        <label for="filter_bus_owner">Filter by NIC:</label>
        <input type="text" name="filter_bus_owner" id="filter_bus_owner" placeholder="Enter NIC">
        <button type="submit">Filter</button>
    </form>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIC</th>
                <th>Email</th>
                <th>Actions</th>
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
                        
                        <td data-title='Email'>
                            <button><a href='edit_bus_owner.php?table=bus_owners&id={$row['id']}'>Edit</a></button>
                            <button><a href='delete_record.php?table=bus_owners&id={$row['id']}'>Delete</a></button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    <h2>Drivers</h2>
    <form method="GET" action="">
        <label for="filter_driver">Filter by License:</label>
        <input type="text" name="filter_license" id="filter_driver" placeholder="Enter License No:">
        <button type="submit">Filter</button>
    </form>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIC</th>
                <th>License</th>
                <th>Actions</th>
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
                        <td data-title='Actions'>
                            <button><a href='edit_driver.php?table=drivers&id={$row['id']}'>Edit</a></button>
                            <button><a href='delete_record.php?table=drivers&id={$row['id']}'>Delete</a></button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    </div>

    <h2>Buses</h2>
    <form method="GET" action="">
        <label for="filter_bus">Filter by Bus Number:</label>
        <input type="text" name="filter_bus" id="filter_bus" placeholder="Enter bus number">
        <button type="submit">Filter</button>
    </form>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bus Number</th>
                <th>Engine Number</th>
                <th>Route</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter = isset($_GET['filter_bus']) ? $_GET['filter_bus'] : '';
            $sql = "SELECT * FROM buses";
            if (!empty($filter)) {
                $sql .= " WHERE bus_number LIKE '%$filter%'";
            }
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td id='firstrow' data-title='ID'>{$row['id']}</td>
                        <td data-title='Bus Number'>{$row['bus_number']}</td>
                        <td data-title='Bus Number'>{$row['engine_number']}</td>
                        <td data-title='Route'>{$row['route']}</td>
                        <td data-title='Actions'>
                            <button><a href='edit_bus.php?table=buses&id={$row['id']}'>Edit</a></button>
                            <button><a href='delete_record.php?table=buses&id={$row['id']}'>Delete</a></button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    <a href="admin_dashboard.php" class="btn-home" >Go to Dashboard</a>

</body>

</html>