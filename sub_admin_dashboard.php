<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'SubAdmin') {
    header("location: sub_admin_login.php");
    exit();
}
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <h2>Sub-Admin Dashboard</h2>

    <!-- Add Resource Form -->
    <h3>Add Resource</h3>
    <form action="add_resource.php" method="post">
        <input type="text" name="resource_name" placeholder="Resource Name" required>
        <textarea name="resource_description" placeholder="Resource Description" required></textarea>
        <button type="submit">Add Resource</button>
    </form>

    <!-- Add Schedule Form -->
    <h3>Add Schedule</h3>
    <form action="add_schedule.php" method="post">
        <select name="resource_id" required>
            <option value="" disabled selected>Select Resource</option>
            <?php
            $sql = "SELECT * FROM Resources";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ResourceID'] . "'>" . $row['ResourceName'] . "</option>";
                }
            }
            ?>
        </select>
        <input type="datetime-local" name="start_time" required>
        <input type="datetime-local" name="end_time" required>
        <button type="submit">Add Schedule</button>
    </form>

    <!-- Resource List -->
    <h3>Resources</h3>
    <table>
        <tr>
            <th>Resource Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Resources";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ResourceName'] . "</td>";
                echo "<td>" . $row['ResourceDescription'] . "</td>";
                echo "<td><a href='delete_resource.php?id=" . $row['ResourceID'] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No resources found</td></tr>";
        }
        ?>
    </table>

    <a href="index.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
