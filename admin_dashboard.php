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
    $scheduleToEdit = $stmt->get_result()->fetch_assoc();
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
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $sql = "UPDATE Schedules SET StartTime = ?, EndTime = ? WHERE ScheduleID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $start_time, $end_time, $schedule_id);
    $stmt->execute();
}

// Handle deletion of categories, resources, and schedules
if (isset($_GET['delete_category'])) {
    $category_id = $_GET['delete_category'];
    $sql = "DELETE FROM Categories WHERE CategoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
}

if (isset($_GET['delete_resource'])) {
    $resource_id = $_GET['delete_resource'];
    $sql = "DELETE FROM Resources WHERE ResourceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resource_id);
    $stmt->execute();
}

if (isset($_GET['delete_schedule'])) {
    $schedule_id = $_GET['delete_schedule'];
    $sql = "DELETE FROM Schedules WHERE ScheduleID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $schedule_id);
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
            <select name="category_id" required>
                <option value="" disabled>Select Category</option>
                <?php
                $sql = "SELECT * FROM Categories";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    $selected = (isset($resourceToEdit) && $resourceToEdit['CategoryID'] == $row['CategoryID']) ? 'selected' : '';
                    echo "<option value='" . $row['CategoryID'] . "' $selected>" . $row['CategoryName'] . "</option>";
                }
                ?>
            </select>
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
            <select name="resource_id" required>
                <option value="" disabled>Select Resource</option>
                <?php
                $sql = "SELECT * FROM Resources";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    $selected = (isset($scheduleToEdit) && $scheduleToEdit['ResourceID'] == $row['ResourceID']) ? 'selected' : '';
                    echo "<option value='" . $row['ResourceID'] . "' $selected>" . $row['ResourceName'] . "</option>";
                }
                ?>
            </select>
            <input type="datetime-local" name="start_time" value="<?php echo isset($scheduleToEdit) ? $scheduleToEdit['StartTime'] : ''; ?>" required>
            <input type="datetime-local" name="end_time" value="<?php echo isset($scheduleToEdit) ? $scheduleToEdit['EndTime'] : ''; ?>" required>
            <?php if (isset($scheduleToEdit)): ?>
                <input type="hidden" name="schedule_id" value="<?php echo $scheduleToEdit['ScheduleID']; ?>">
                <button type="submit" name="update_schedule">Update Schedule</button>
            <?php else: ?>
                <button type="submit" name="add_schedule">Add Schedule</button>
            <?php endif; ?>
        </form>

        <hr>

        <!-- Manage Categories -->
        <h3>Manage Categories</h3>
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Categories";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['CategoryName'] . "</td>
                            <td><a href='admin_dashboard.php?edit_category=" . $row['CategoryID'] . "'>Edit</a> | 
                                <a href='admin_dashboard.php?delete_category=" . $row['CategoryID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <hr>

        <!-- Manage Resources -->
        <h3>Manage Resources</h3>
        <table>
            <thead>
                <tr>
                    <th>Resource Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Resources";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $categorySql = "SELECT CategoryName FROM Categories WHERE CategoryID = " . $row['CategoryID'];
                    $categoryResult = $conn->query($categorySql);
                    $category = $categoryResult->fetch_assoc();
                    echo "<tr>
                            <td>" . $row['ResourceName'] . "</td>
                            <td>" . $category['CategoryName'] . "</td>
                            <td><a href='admin_dashboard.php?edit_resource=" . $row['ResourceID'] . "'>Edit</a> | 
                                <a href='admin_dashboard.php?delete_resource=" . $row['ResourceID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <hr>

        <!-- Manage Schedules -->
        <h3>Manage Schedules</h3>
        <table>
            <thead>
                <tr>
                    <th>Resource</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Schedules";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $resourceSql = "SELECT ResourceName FROM Resources WHERE ResourceID = " . $row['ResourceID'];
                    $resourceResult = $conn->query($resourceSql);
                    $resource = $resourceResult->fetch_assoc();
                    echo "<tr>
                            <td>" . $resource['ResourceName'] . "</td>
                            <td>" . $row['StartTime'] . "</td>
                            <td>" . $row['EndTime'] . "</td>
                            <td><a href='admin_dashboard.php?edit_schedule=" . $row['ScheduleID'] . "'>Edit</a> | 
                                <a href='admin_dashboard.php?delete_schedule=" . $row['ScheduleID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>
