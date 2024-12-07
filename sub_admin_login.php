<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE Username = '$username' AND UserType = 'SubAdmin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = 'SubAdmin';
            header("location: sub_admin_dashboard.php");
        } else {
            echo "Invalid Password";
        }
    } else {
        echo "Invalid Username";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BORROW RESOURCES</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-xQWo3UpI4+kmT3OjKnVFq+ZGBu2KyJz9vuo4Dz2B/K0XC4z8+gWvoU2C69pJE0M9" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Login Sub-Admin</h2>
        <form id="login-form" action="sub_admin_login.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Please enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Please enter your password" required>
            </div>
            <div class="login-options">
                <button type="submit" class="login-btn">LOGIN</button>
                
            </div>
        </form>
    </div>
</body>
</html>
