<?php include 'db_config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('User deleted successfully.');
        window.location.href = 'view_users.php'; // Redirect to the routes page
      </script>";
    } else {
        echo "<script>
        alert('Error deleting route: " . $conn->error . "');
        window.location.href = 'view_users.php'; // Redirect to the routes page
      </script>";
    }
} else {
    echo "<script>
            alert('Missing user ID.');
            window.location.href = 'view_users.php'; // Redirect to the routes page
          </script>";
}
