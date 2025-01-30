<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];

    $sql = "SELECT route_id, seats_booked FROM bookings WHERE id = $booking_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['route_id'];
        $seats_booked = $row['seats_booked'];

        $update_sql = "UPDATE routes SET available_seats = available_seats + $seats_booked WHERE id = $id";
        if ($conn->query($update_sql) === TRUE) {

            $delete_sql = "DELETE FROM bookings WHERE id = $booking_id";
            if ($conn->query($delete_sql) === TRUE) {
                echo "<script>
                        alert('Booking deleted successfully and available seats updated.');
                        window.location.href = 'view_bookings.php'; // Redirect to the bookings page
                      </script>";
            } else {
                echo "<script>
                        alert('Error deleting booking: " . $conn->error . "');
                        window.location.href = 'view_bookings.php'; // Redirect to the bookings page
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error updating available seats: " . $conn->error . "');
                    window.location.href = 'view_bookings.php'; // Redirect to the bookings page
                  </script>";
        }
    } else {
        echo "<script>
                alert('Booking not found.');
                window.location.href = 'view_bookings.php'; // Redirect to the bookings page
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'view_bookings.php'; // Redirect to the bookings page
          </script>";
}
