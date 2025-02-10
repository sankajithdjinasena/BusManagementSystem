<?php include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);


    $sql = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>
          window.onload = function() {
              Swal.fire({
                  title: 'Thank You!',
                  text: 'Your message has been received.',
                  icon: 'success',
                  confirmButtonText: 'OK'
              }).then(() => {
                  window.location.href = 'contact.php'; // Redirect to the contact page
              });
          };
      </script>";
    } else {
      echo "<script>
      window.onload = function() {
          Swal.fire({
              title: 'Error!',
              text: 'Invalid request.',
              icon: 'error',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'contact.php'; // Redirect to the contact page
          });
      };
  </script>";
    }
}

$conn->close();
