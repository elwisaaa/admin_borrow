<?php
include('config.php');
$id = $_GET['id'];
$sql = "DELETE FROM Categories WHERE CategoryID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: admin_dashboard.php?message=Category deleted successfully");
} else {
    echo "Error deleting category: " . $stmt->error;
}
?>
