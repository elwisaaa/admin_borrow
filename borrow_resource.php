<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resource_id = $_POST['resource_id'];
    $borrow_start_time = $_POST['borrow_start_time'];
    $borrow_end_time = $_POST['borrow_end_time'];
    $user_id = $_SESSION['userid'];

    $sql = "INSERT INTO borrowings (UserID, ResourceID, BorrowStartTime, BorrowEndTime) VALUES ('$user_id', '$resource_id', '$borrow_start_time', '$borrow_end_time')";
    if ($conn->query($sql) === TRUE) {
        echo "Resource borrowed successfully";
        header("location: student_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit();
}
?>
