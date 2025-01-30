<?php include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Thank you! Your message has been received.');
                window.location.href = 'contact.php'; // Redirect to the bookings page
              </script>";
    } else {
        echo "<script>
        alert('Invalid request.');
        window.location.href = 'contact.php'; // Redirect to the bookings page
      </script>";
    }
}

$conn->close();
