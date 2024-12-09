<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Admin') {
    header("location: admin_login.php");
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $borrowing_id = $_POST['borrowing_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "UPDATE Borrowings SET BorrowStartTime = ?, BorrowEndTime = ?, Status = 'Available' WHERE BorrowingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $start_time, $end_time, $borrowing_id);
    if ($stmt->execute()) {
        header("location: admin_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>