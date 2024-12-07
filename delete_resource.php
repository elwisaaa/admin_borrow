<?php
session_start();
include('config.php');

if (isset($_GET['id'])) {
    $resource_id = $_GET['id'];
    $sql = "DELETE FROM Resources WHERE ResourceID = $resource_id";
    if ($conn->query($sql) === TRUE) {
        echo "Resource deleted successfully";
    } else {
        echo "Error deleting resource: " . $conn->error;
    }
}

$conn->close();
header("location: " . ($_SESSION['usertype'] == 'Admin' ? "admin_dashboard.php" : "sub_admin_dashboard.php"));
exit();
?>
