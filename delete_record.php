<?php include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


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
              window.onload = function() {
                  Swal.fire({
                      title: 'Success!',
                      text: 'Record deleted successfully.',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then(() => {
                      window.location.href = 'view_records.php'; // Redirect to records page
                  });
              };
          </script>";
        } else {
          echo "<script>
          window.onload = function() {
              Swal.fire({
                  title: 'Error!',
                  text: 'Error deleting record: " . addslashes($conn->error) . "',
                  icon: 'error',
                  confirmButtonText: 'Try Again'
              }).then(() => {
                  window.location.href = 'view_records.php'; // Redirect to records page
              });
          };
      </script>";
        }
    } else {
      echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Error!',
              text: 'Invalid table specified.',
              icon: 'error',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'view_records.php'; // Redirect to records page
          });
      };
  </script>";
    }
} else {
  echo "<script>
  window.onload = function() {
      Swal.fire({
          title: 'Error!',
          text: 'Missing parameters.',
          icon: 'error',
          confirmButtonText: 'OK'
      }).then(() => {
          window.location.href = 'view_records.php'; // Redirect to records page
      });
  };
</script>";
}
