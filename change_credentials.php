<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $password, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        $success = "Credentials updated successfully.";
    } else {
        $error = "Error updating credentials.";
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

</head>
<body>
    <h2>Change Credentials</h2>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label for="username">New Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" required>
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Update</button>
    </form>
    <a href="dashboard.php" class="btn-home">Go to Dashboard</a>
</body>
</html>
