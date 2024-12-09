<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'Student') {
    header("location: student_login.php");
    exit();
}
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h2>Student Dashboard</h2>

        <!-- Resources Table -->
        <h3>Available Resources</h3>
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
                    echo "<td><form action='borrow_resource.php' method='post' style='display:inline;'>
                              <input type='hidden' name='resource_id' value='" . $row['ResourceID'] . "'>
                              <input type='datetime-local' name='borrow_start_time' required>
                              <input type='datetime-local' name='borrow_end_time' required>
                              <button type='submit'>Reserve</button>
                          </form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No resources available</td></tr>";
            }
            ?>
        </table>

        <!-- Borrowing History Button -->
        <form action="view_history.php" method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="history-btn">View Borrowing History</button>
        </form>

        <!-- Logout Button -->
        <form action="logout.php" method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>