<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];

    $sql = "SELECT route_id, seats_booked,date FROM bookings WHERE id = $booking_id";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['route_id'];
        $seats_booked = $row['seats_booked'];

        $update_sql = "UPDATE routes SET available_seats = available_seats + $seats_booked WHERE id = $id";
        $update_sql .= " AND date >= CURDATE()";

        if ($conn->query($update_sql) === TRUE) {
            $delete_sql = "DELETE FROM bookings WHERE id = $booking_id";
            if ($conn->query($delete_sql) === TRUE) {
                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Booking deleted successfully and available seats updated.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'view_bookings_users.php';
                    });
                };
            </script>";
            } else {
                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error deleting booking: " . addslashes($conn->error) . "',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    }).then(() => {
                        window.location.href = 'view_bookings_users.php';
                    });
                };
            </script>";
            }
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating available seats: " . addslashes($conn->error) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                        window.location.href = 'view_bookings_users.php';
                    });
            };
        </script>";
        }
    } else {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: 'Booking not found.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                        window.location.href = 'view_bookings_users.php';
                    });
        };
    </script>";
    }
} else {
    echo "<script>
    window.onload = function() {
        Swal.fire({
            title: 'Invalid Request!',
            text: 'Please make a valid request.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'view_bookings_users.php';
        });
    };
</script>";
}
?>
