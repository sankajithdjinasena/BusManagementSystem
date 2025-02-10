<?php include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];


    $sql = "DELETE FROM routes WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
      echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Success!',
              text: 'Route deleted successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'view_routes.php'; // Redirect to the routes page
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
                  window.location.href = 'view_routes.php'; // Redirect to the routes page
              });
          };
      </script>";
    }
} else {
  echo "<script>
  window.onload = function() {
      Swal.fire({
          title: 'Error!',
          text: 'Missing route ID.',
          icon: 'error',
          confirmButtonText: 'OK'
      }).then(() => {
          window.location.href = 'view_routes.php'; // Redirect to the routes page
      });
  };
</script>";
}
