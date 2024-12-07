<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO Users (Username, Password, UserType) VALUES ('$username', '$password', 'Admin')";
    if ($conn->query($sql) === TRUE) {
        echo "New admin registered successfully";
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = 'Admin';
        header("location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Register Admin</h2>
        <form id="signup-form" action="signup_admin.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Please enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Please enter your password" required>
            </div>
            <div class="signup-options">
                <button type="submit" class="signup-btn">REGISTER</button>
                <p>Already have an account? <a href="admin_login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>
