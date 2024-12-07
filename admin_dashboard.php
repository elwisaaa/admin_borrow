<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Admin') {
    header("location: admin_login.php");
    exit();
}
include('config.php');

// Fetch category, resource, or schedule details for editing
$categoryToEdit = null;
$resourceToEdit = null;
$scheduleToEdit = null;

// Handle category update (fetch data for editing)
if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $sql = "SELECT * FROM Categories WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $categoryToEdit = $stmt->get_result()->fetch_assoc();
}

// Handle resource update (fetch data for editing)
if (isset($_GET['edit_resource'])) {
    $resource_id = $_GET['edit_resource'];
    $sql = "SELECT * FROM Resources WHERE ResourceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resource_id);
    $stmt->execute();
    $resourceToEdit = $stmt->get_result()->fetch_assoc();
}

// Handle schedule update (fetch data for editing)
if (isset($_GET['edit_schedule'])) {
    $schedule_id = $_GET['edit_schedule'];
    $sql = "SELECT * FROM Schedules WHERE ScheduleID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();
}

// Handle category add, update, or delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO Categories (CategoryName) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category_name);
    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $sql = "UPDATE Categories SET CategoryName = ? WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $category_name, $category_id);
    $stmt->execute();
}

// Handle resource add, update, or delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_resource'])) {
    $resource_name = $_POST['resource_name'];
    $resource_description = $_POST['resource_description'];
    $category_id = $_POST['category_id'];
    $sql = "INSERT INTO Resources (ResourceName, ResourceDescription, CategoryID) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $resource_name, $resource_description, $category_id);
    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_resource'])) {
    $resource_id = $_POST['resource_id'];
    $resource_name = $_POST['resource_name'];
    $resource_description = $_POST['resource_description'];
    $category_id = $_POST['category_id'];
    $sql = "UPDATE Resources SET ResourceName = ?, ResourceDescription = ?, CategoryID = ? WHERE ResourceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $resource_name, $resource_description, $category_id, $resource_id);
    $stmt->execute();
}

// Handle schedule add, update, or delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_schedule'])) {
    $resource_id = $_POST['resource_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $sql = "INSERT INTO Schedules (ResourceID, StartTime, EndTime) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $resource_id, $start_time, $end_time);
    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_schedule'])) {
    $schedule_id = $_POST['schedule_id'];
    $resource_id = $_POST['resource_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $sql = "UPDATE Schedules SET ResourceID = ?, StartTime = ?, EndTime = ? WHERE ScheduleID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $resource_id, $start_time, $end_time, $schedule_id);
    $stmt->execute();
}

// Handle sub-admin registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_sub_admin'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO Users (Username, Password, UserType) VALUES (?, ?, 'SubAdmin')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>Borrow Resource</h1>
    </div>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h2>Admin Dashboard</h2>

        <!-- Add/Update Category Form -->
        <h3><?php echo isset($categoryToEdit) ? 'Update Category' : 'Add Category'; ?></h3>
        <form action="admin_dashboard.php" method="post">
            <input type="text" name="category_name" value="<?php echo isset($categoryToEdit) ? $categoryToEdit['CategoryName'] : ''; ?>" placeholder="Category Name" required>
            <?php if (isset($categoryToEdit)): ?>
                <input type="hidden" name="category_id" value="<?php echo $categoryToEdit['CategoryID']; ?>">
                <button type="submit" name="update_category">Update Category</button>
            <?php else: ?>
                <button type="submit" name="add_category">Add Category</button>
            <?php endif; ?>
        </form>

        <!-- Add/Update Resource Form -->
        <h3><?php echo isset($resourceToEdit) ? 'Update Resource' : 'Add Resource'; ?></h3>
        <form action="admin_dashboard.php" method="post">
            <input type="text" name="resource_name" value="<?php echo isset($resourceToEdit) ? $resourceToEdit['ResourceName'] : ''; ?>" placeholder="Resource Name" required>
            <textarea name="resource_description" placeholder="Resource Description" required><?php echo isset($resourceToEdit) ? $resourceToEdit['ResourceDescription'] : ''; ?></textarea>
            <input type="text" name="category_id" value="<?php echo isset($resourceToEdit) ? $resourceToEdit['CategoryID'] : ''; ?>" placeholder="Category ID" required>
            <?php if (isset($resourceToEdit)): ?>
                <input type="hidden" name="resource_id" value="<?php echo $resourceToEdit['ResourceID']; ?>">
                <button type="submit" name="update_resource">Update Resource</button>
            <?php else: ?>
                <button type="submit" name="add_resource">Add Resource</button>
            <?php endif; ?>
        </form>

        <!-- Add/Update Schedule Form -->
        <h3><?php echo isset($scheduleToEdit) ? 'Update Schedule' : 'Add Schedule'; ?></h3>
        <form action="admin_dashboard.php" method="post">
            <input type="text" name="resource_id" value="<?php echo isset($scheduleToEdit) ? $scheduleToEdit['ResourceID'] : ''; ?>" placeholder="Resource ID" required>
            <input type="datetime-local" name="start_time" value="<?php echo isset($scheduleToEdit) ? $scheduleToEdit['StartTime'] : ''; ?>" placeholder="Start Time" required>
            <input type="datetime-local" name="end_time" value="<?php echo isset($scheduleToEdit) ? $scheduleToEdit['EndTime'] : ''; ?>" placeholder="End Time" required>
            <?php if (isset($scheduleToEdit)): ?>
                <input type="hidden" name="schedule_id" value="<?php echo $scheduleToEdit['ScheduleID']; ?>">
                <button type="submit" name="update_schedule">Update Schedule</button>
            <?php else: ?>
                <button type="submit" name="add_schedule">Add Schedule</button>
            <?php endif; ?>
        </form>

        <!-- Add Sub-Admin Form -->
        <h3>Add Sub-Admin</h3>
        <form action="admin_dashboard.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="add_sub_admin">Add Sub-Admin</button>
        </form>

        <!-- Logout Button -->
        <form action="logout.php" method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>