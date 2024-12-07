<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Admin') {
    header("location: admin_login.php");
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resource_id = $_POST['resource_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "INSERT INTO Schedules (ResourceID, StartTime, EndTime) VALUES ($resource_id, '$start_time', '$end_time')";
    if ($conn->query($sql) === TRUE) {
        header("location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
