<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Admin') {
    header("location: admin_login.php");
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];

    $sql = "INSERT INTO Categories (CategoryName) VALUES ('$category_name')";
    if ($conn->query($sql) === TRUE) {
        header("location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
