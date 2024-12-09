<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Student') {
    header("location: student_login.php");
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['userid'];
    $resource_id = $_POST['resource_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "INSERT INTO Borrowings (UserID, ResourceID, BorrowStartTime, BorrowEndTime, Status) VALUES (?, ?, ?, ?, 'Reserved')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $resource_id, $start_time, $end_time);
    if ($stmt->execute()) {
        header("location: student_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>