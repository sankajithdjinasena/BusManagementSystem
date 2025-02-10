<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$alert = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $password, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $alert = "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Credentials updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        $alert = "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error updating credentials.',
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Credentials</title>
    <link rel="stylesheet" href="style/change_credential.css">
    <link rel="icon" href="Images/LogoN.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<body>
    <h2>Change Credentials</h2>
    
    <form method="POST" action="">
        <label for="username">New Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" required>
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Update</button>
    </form>
    <a href="dashboard.php" class="btn-home">Go to Dashboard</a>

    <?php if (!empty($alert)) echo $alert; ?> 

</body>
</html>
