<?php include 'db_config.php'; 
include 'backbtn.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include 'goup.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Complains/Feedbacks</title>
    <link rel="stylesheet" href="style/contact_messages.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
</head>

<body>
    <?php include 'admin_nav.php'; ?>
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