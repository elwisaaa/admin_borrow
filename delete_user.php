<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Admin') {
    header("location: admin_login.php");
    exit();
}
include('config.php');

if (isset($_GET['id'])) {
    $userid = $_GET['id'];
    $sql = "DELETE FROM Users WHERE UserID = $userid";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
header("location: admin_dashboard.php");
exit();
?>
