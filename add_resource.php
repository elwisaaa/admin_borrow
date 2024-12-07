<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Admin') {
    header("location: admin_login.php");
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resource_name = $_POST['resource_name'];
    $resource_description = $_POST['resource_description'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO Resources (ResourceName, ResourceDescription, CategoryID) VALUES ('$resource_name', '$resource_description', $category_id)";
    if ($conn->query($sql) === TRUE) {
        header("location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
