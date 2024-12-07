<?php
include('config.php');
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $sql = "UPDATE Categories SET CategoryName = ? WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $category_name, $id);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=Category updated successfully");
    } else {
        echo "Error updating category: " . $stmt->error;
    }
}
?>
<form method="POST">
    <input type="text" name="category_name" placeholder="New Category Name">
    <button type="submit">Update Category</button>
</form>
