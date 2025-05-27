<?php include 'db_config.php';
include 'backbtn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="style/view_user.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">

</head>
<body>
        <?php include 'admin_nav.php'; ?>


<h2>Users</h2>
<form method="GET" action="">
    <label for="filter_username">User Name: </label>
    <input type="text" name="filter_username" id="filter_username" placeholder="Enter User Name">
    <label for="filter_email">Email: </label>
    <input type="text" name="filter_email" id="filter_email" placeholder="Enter Email here">
    <button type="submit">Filter</button>
</form>

<table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Account Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter_username = isset($_GET['filter_username']) ? $_GET['filter_username'] : '';
            $filter_email = isset($_GET['filter_email']) ? $_GET['filter_email'] : '';

            $sql = "SELECT users.id, username,email,created_at,is_admin 
                    FROM users";

            $conditions = [];
            if (!empty($filter_username)) {
                $conditions[] = "username LIKE '%$filter_username%'";
            }
            if (!empty($filter_email)) {
                $conditions[] = "email LIKE '%$filter_email%'";
            }
            if (true) {
                $conditions[] = "is_admin LIKE '0'";
            }
            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td data-title='ID'>{$row['id']}</td>
                            <td data-title='Username'>{$row['username']}</td>
                            <td data-title='Email'>{$row['email']}</td>
                            <td data-title='Created At'>{$row['created_at']}</td>
                            <td data-title='Actions'>
                                <button><a href='delete_users.php?id={$row['id']}'>Delete</a></button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>

</body>
</html>