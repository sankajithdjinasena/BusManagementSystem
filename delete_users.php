<?php include 'db_config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
      echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Success!',
              text: 'User deleted successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'view_users.php'; // Redirect to the users page
          });
      };
  </script>";
    } else {
      echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Error!',
              text: 'Error deleting route: " . addslashes($conn->error) . "',
              icon: 'error',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'view_users.php'; // Redirect to the users page
          });
      };
  </script>";
    }
} else {
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
  echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Error!',
              text: 'Missing user ID.',
              icon: 'error',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'view_users.php'; // Redirect to the users page
          });
      };
  </script>";
}
