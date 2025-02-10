<?php
include 'db_config.php';
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


$route_id = $_GET['id'];

$sql = "SELECT * FROM routes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $route_id);
$stmt->execute();
$result = $stmt->get_result();
$route = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $departure_place = $_POST['departure_place'];
    $arrival_place = $_POST['arrival_place'];
    $duration = $_POST['duration'];
    $bus_id = $_POST['bus_id'];
    $available_seats = $_POST['available_seats'];

    $update_sql = "UPDATE routes SET date = ?, time = ?, departure_place = ?, arrival_place = ?, duration = ?, bus_id = ?, available_seats = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('sssssiii', $date, $time, $departure_place, $arrival_place, $duration, $bus_id, $available_seats, $route_id);
    $stmt->execute();

    header("Location: view_routes.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Route</title>
    <link rel="stylesheet" href="style/registers.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="style/view_record.css">


</head>

<body>
    <h2>Edit Route</h2>
    <form method="POST" action="">
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $route['date']; ?>" required><br>
        <label for="time">Time:</label>
        <input type="time" name="time" value="<?php echo $route['time']; ?>" required><br>
        <label for="departure_place">Departure Place:</label>
        <input type="text" name="departure_place" value="<?php echo $route['departure_place']; ?>" required><br>
        <label for="arrival_place">Arrival Place:</label>
        <input type="text" name="arrival_place" value="<?php echo $route['arrival_place']; ?>" required><br>
        <label for="duration">Duration:</label>
        <input type="text" name="duration" value="<?php echo $route['duration']; ?>" required><br>
        <label for="bus_id">Bus ID:</label>
        <input type="number" name="bus_id" value="<?php echo $route['bus_id']; ?>" required><br>
        <label for="available_seats">Available Seats:</label>
        <input type="number" name="available_seats" value="<?php echo $route['available_seats']; ?>" required><br>
        <button type="submit">Update Record</button>
    </form>
    <a href="admin_dashboard.php" class="btn-home">Go to Dashboard</a>

</body>

</html>