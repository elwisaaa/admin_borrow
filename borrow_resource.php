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
    $borrow_start_time = $_POST['borrow_start_time'];
    $borrow_end_time = $_POST['borrow_end_time'];

    $sql = "INSERT INTO Borrowings (UserID, ResourceID, BorrowStartTime, BorrowEndTime) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $user_id, $resource_id, $borrow_start_time, $borrow_end_time);
    if ($stmt->execute()) {
        header("location: student_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>