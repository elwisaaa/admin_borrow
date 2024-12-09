<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Student') {
    header("location: student_login.php");
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $borrowing_id = $_POST['borrowing_id'];

    $sql = "DELETE FROM Borrowings WHERE BorrowingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $borrowing_id);
    if ($stmt->execute()) {
        header("location: student_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>