<?php include 'db_config.php'; 
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Complains/Feedbacks</title>
    <link rel="stylesheet" href="style/contact_messages.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
</head>

<body>
    <h2>Contact Messages</h2>

    <form method="GET" action="">
        <label for="filter_phone">Telephone no:</label>
        <input type="text" name="filter_phone" id="filter_phone" placeholder="Enter Telephone no." value="<?php echo isset($_GET['filter_phone']) ? $_GET['filter_phone'] : ''; ?>">

        <label for="filter_email">Email:</label>
        <input type="text" name="filter_email" id="filter_email" placeholder="Enter Email Address" value="<?php echo isset($_GET['filter_email']) ? $_GET['filter_email'] : ''; ?>">
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th colspan="2">Replied</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_id'])) {
                $reply_id = intval($_POST['reply_id']);
                $update_sql = "UPDATE contacts SET replied='Replied' WHERE id=$reply_id" ;
                $conn->query($update_sql);
            }

            $filter_phone = isset($_GET['filter_phone']) ? $_GET['filter_phone'] : '';
            $filter_email = isset($_GET['filter_email']) ? $_GET['filter_email'] : '';

            $sql = "SELECT id, name, email, phone, message, replied FROM contacts";
            $conditions = [];

            if (!empty($filter_phone)) {
                $conditions[] = "phone LIKE '%" . $conn->real_escape_string($filter_phone) . "%'";
            }
            if (!empty($filter_email)) {
                $conditions[] = "email LIKE '%" . $conn->real_escape_string($filter_email) . "%'";
            }

            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }

            $sql .= " ORDER BY id DESC"; 

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                <td id='firstrow' data-title='Message ID'>{$row['id']}</td>
                                <td data-title='Name'>{$row['name']}</td>
                                <td data-title='Email'>{$row['email']}</td>
                                <td data-title='Phone'>{$row['phone']}</td>
                                <td data-title='Message'>{$row['message']}</td>
                                <td data-title='Replied'>{$row['replied']}</td>
                                <td data-title='Option'>";
                    if ($row['replied'] === 'Pending') {
                        echo "<form method='POST' action=''>
                                    <input type='hidden' name='reply_id' value='{$row['id']}'>
                                    <button type='submit'>Reply</button>
                                    <p><a id='mailto' href='mailto:{$row['email']}'>Send email</a></p>

                                  </form>";
                    } else {
                        echo "<button disabled style='background-color: green;'>Replied</button>";
                    }
                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='message'>No records found for the given filters.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
    <?php include 'whatsapp.php'; ?>

</body>
</html>