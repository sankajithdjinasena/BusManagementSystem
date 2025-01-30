<?php include 'db_config.php';

if (isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $id = $_GET['id'];

    $table = $conn->real_escape_string($table);
    $id = (int)$id;

    $allowed_tables = ['bus_owners', 'drivers', 'buses'];
    if (in_array($table, $allowed_tables)) {
        $sql = "DELETE FROM $table WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Record deleted successfully.');
                    window.location.href = 'view_records.php'; // Redirect to records page
                  </script>";
        } else {
            echo "<script>
                    alert('Error deleting record: " . $conn->error . "');
                    window.location.href = 'view_records.php'; // Redirect to records page
                  </script>";
        }
    } else {
        echo "<script>
                alert('Invalid table specified.');
                window.location.href = 'view_records.php'; // Redirect to records page
              </script>";
    }
} else {
    echo "<script>
            alert('Missing parameters.');
            window.location.href = 'view_records.php'; // Redirect to records page
          </script>";
}
