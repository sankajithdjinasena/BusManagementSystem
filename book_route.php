<?php include 'db_config.php'; 
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book a Route</title>
</head>

<link rel="stylesheet" href="style/book_routes.css">
<link rel="icon" href="Images/LogoN.png" type="image/x-icon">

<body>
    <h2>Book a Route</h2>
    <form class="form1" action="book_route.php" method="POST">
    <label>Route ID:</label>
    <select name="route_id" required>
        <option value="">-- Select Route --</option>
        <?php
        $query = "SELECT id, route_name FROM routes"; 
        $result = $conn->query($query);
        
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['id']}";
        }
        ?>
</select>
        <label>Your Name:</label>
        <input type="text" name="customer_name" required autocomplete="off">
        <label>Your Phone:</label>
        <input type="text" name="customer_phone" required autocomplete="off">
        <label>Your Email:</label>
        <input type="text" name="email" required autocomplete="off">
        <label>Get in location</label>
        <input type="text" name="get_in_location" required autocomplete="off">
        <label>Number of Seats:</label>
        <input type="number" name="seats" required>
        <input type="submit" name="submit" value="Book Route">
    </form>

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';
    
    $mail = new PHPMailer(true);
    
    if (isset($_POST['submit'])) {
        $route_id = $_POST['route_id'];
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $seats = $_POST['seats'];
        $email = $_POST['email'];
        $get_in_location = $_POST['get_in_location'];
    
        $result = $conn->query("SELECT available_seats FROM routes WHERE id = $route_id AND date >= CURDATE()");
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['available_seats'] >= $seats) {
                $new_seats = $row['available_seats'] - $seats;
                $conn->query("INSERT INTO bookings (route_id, customer_name, customer_phone, email, seats_booked, get_in_location) 
                              VALUES ($route_id, '$customer_name', '$customer_phone', '$email', $seats, '$get_in_location')");
    
                $booking_id = $conn->insert_id;
                $conn->query("UPDATE routes SET available_seats = $new_seats WHERE id = $route_id");
                
                $routeQuery = $conn->query("SELECT departure_place,time,date, arrival_place FROM routes WHERE id = $route_id");
                $routeData = $routeQuery->fetch_assoc();
                $departure_place = $routeData['departure_place'];
                $arrival_place = $routeData['arrival_place'];
                $time = $routeData['time'];
                $date = $routeData['date'];


                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; 
                    $mail->SMTPAuth = true;
                    $mail->Username   = 'jobsanke26198@gmail.com'; 
                    $mail->Password = 'iscwzyvhbbanhoov'; 
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
    
                    $mail->setFrom('ridesync@outlook.com', 'RIDESYNC');
                    $mail->addAddress($email, $customer_name);
                    $mail->isHTML(true);
                    $mail->Subject = "Booking Confirmation - ID: $booking_id";
                    $mail->Body = "
                            <html>
                            <head>
                                <title>Booking Confirmation</title>
                            </head>
                            <body style='font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;'>
                                <div style='max-width: 600px; margin: auto; background-color: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px;'>
                                    <h2 style='color: #4CAF50; text-align: center;'>✅ Booking Confirmation</h2>
                                    <p>Dear <strong>$customer_name</strong>,</p>
                                    <p>Thank you for booking with us! Here are your booking details:</p>
                                    
                                    <table style='width: 100%; border-collapse: collapse;'>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Booking ID</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'><b>$booking_id</b></td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Route ID</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$route_id</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Bus Departure place</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$departure_place</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Bus Arrival place</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$arrival_place</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Date</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$date</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Time</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$time</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Seats Booked</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$seats</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Get-in Location</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$get_in_location</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Customer Phone</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$customer_phone</td>
                                        </tr>
                                        <tr>
                                            <td style='border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;'><strong>Your Email</strong></td>
                                            <td style='border: 1px solid #ddd; padding: 8px;'>$email</td>
                                        </tr>
                                    </table>

                                    <p style='margin-top: 20px;'>We look forward to serving you! </p>
                                    <p>Best regards,<br><strong>RIDESYNC</strong></p>
                                </div>
                            </body>
                            </html>";

    
                    $mail->send();
                    
                    echo "<script>
                    window.onload = function(){
                    Swal.fire({
                        title: 'Booking Successful!',
                        text: 'Your Booking ID is: " . $booking_id . ". Check your email for confirmation.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    };
                    </script>";
    
                } catch (Exception $e) {
                    echo "<script>
                    window.onload = function(){
                    Swal.fire({
                        title: 'Booking Confirmed!',
                        text: 'Email could not be sent. Error: " . addslashes($mail->ErrorInfo) . "',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    };
                    </script>";
                }
                
            } else {
                echo "<script>
                window.onload = function(){
                Swal.fire({
                    title: 'Error!',
                    text: 'Not enough seats available!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                };
                </script>";
            }
        } else {
            echo "<script>
            window.onload = function(){
            Swal.fire({
                title: 'Error!',
                text: 'Invalid Route ID!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            };
            </script>";
        }
    }
    ?>

    <br>
    <a href="dashboard.php" class="btn-home">Go to Dashboard</a>
    <?php include 'whatsapp.php'; ?>


    <div>
        <h2>Available Routes</h2>

        <form class="form2" method="GET" action="">
            <label for="filter_departure">Departure Place:</label>
            <input type="text" name="filter_departure" id="filter_departure" placeholder="Enter departure place" autocomplete="off">
            <label for="filter_arrival">Arrival Place:</label>
            <input type="text" name="filter_arrival" id="filter_arrival" placeholder="Enter arrival place" autocomplete="off">
            <label for="filter_date">Date:</label>
            <input type="date" name="filter_date" id="filter_date">
            <button type="submit">Filter</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Route ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Departure Place</th>
                    <th>Arrival Place</th>
                    <th>Duration</th>
                    <th>Bus Number</th>
                    <th>Available Seats</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filter_departure = isset($_GET['filter_departure']) ? $_GET['filter_departure'] : '';
                $filter_arrival = isset($_GET['filter_arrival']) ? $_GET['filter_arrival'] : '';
                $filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';

                $sql = "SELECT routes.id, date, time, departure_place, arrival_place, bus_id, total_seats, duration, available_seats, buses.bus_number 
                FROM routes
                JOIN buses ON routes.bus_id = buses.id";

                $conditions = [];
                if (!empty($filter_departure)) {
                    $conditions[] = "departure_place LIKE '%$filter_departure%'";
                }
                if (!empty($filter_arrival)) {
                    $conditions[] = "arrival_place LIKE '%$filter_arrival%'";
                }
                if (!empty($filter_date)) {
                    $conditions[] = "date = '$filter_date'";
                }
                if (count($conditions) > 0) {
                    $sql .= " WHERE " . implode(' AND ', $conditions);
                }
                $sql .= " WHERE date >= CURDATE()";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td id='firstrow'data-title='Route ID'>{$row['id']}</td>
                        <td data-title='Date'>{$row['date']}</td>
                        <td data-title='Time'>{$row['time']}</td>
                        <td data-title='Departure Place'>{$row['departure_place']}</td>
                        <td data-title='Arrival Place'>{$row['arrival_place']}</td>
                        <td data-title='Duration'>{$row['duration']}</td>
                        <td data-title='Bus Number'>{$row['bus_number']}</td>
                        <td data-title='Available Seats'>{$row['available_seats']}</td>
                      </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No routes available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
  document.getElementById("filter_date").min = new Date().toISOString().split("T")[0];
</script>
</html>