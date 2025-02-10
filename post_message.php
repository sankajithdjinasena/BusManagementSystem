<?php include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_message'])) {
    $new_message = $conn->real_escape_string($_POST['new_message']);

    $sql = "INSERT INTO admin_messages (message) VALUES ('$new_message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Message posted successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Optional: redirect to another page after success
                window.location.href = 'somepage.php'; // Replace with your desired page
            });
        </script>";    } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error: " . addslashes($conn->error) . "',
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        </script>";    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM admin_messages WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Message deleted successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'post_message.php'; // Redirect to your desired page
            });
        </script>";    } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error deleting message: " . addslashes($conn->error) . "',
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        </script>";    }
}

$messages = $conn->query("SELECT * FROM admin_messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/post_message.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <title>Post Message</title>
</head>

<body>
    <h1>Post Messages</h1>

    <form method="POST" action="post_message.php">
        <textarea name="new_message" placeholder="Write your message here..." required></textarea><br>
        <button type="submit">Post Message</button>
    </form>

    <h2>Posted Messages</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Posted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $messages->fetch_assoc()) { ?>
                <tr>
                    <td id='firstrow' data-title='ID'><?php echo $row['id']; ?></td>
                    <td data-title='Message'><?php echo $row['message']; ?></td>
                    <td data-title='Posted At'><?php echo $row['created_at']; ?></td>
                    <td data-title='Action'>
                        <a href="post_message.php?delete_id=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>
</body>
</html>
<?php
$conn->close();
?>