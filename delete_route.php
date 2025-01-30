<?php include 'db_config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM routes WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Route deleted successfully.');
        window.location.href = 'view_routes.php'; // Redirect to the routes page
      </script>";
    } else {
        echo "<script>
        alert('Error deleting route: " . $conn->error . "');
        window.location.href = 'view_routes.php'; // Redirect to the routes page
      </script>";
    }
} else {
    echo "<script>
            alert('Missing route ID.');
            window.location.href = 'view_routes.php'; // Redirect to the routes page
          </script>";
}
