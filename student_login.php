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

        <!-- Borrow Resource Form -->
        <h3>Borrow Resource</h3>
        <form action="borrow_resource.php" method="post">
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
            <input type="datetime-local" name="borrow_start_time" required>
            <input type="datetime-local" name="borrow_end_time" required>
            <button type="submit">Borrow Resource</button>
        </form>

        <!-- Borrowing History -->
        <h3>Borrowing History</h3>
        <table>
            <tr>
                <th>Resource Name</th>
                <th>Borrow Start Time</th>
                <th>Borrow End Time</th>
                <th>Actions</th>
            </tr>
            <?php
            $userid = $_SESSION['userid'];
            $sql = "SELECT b.BorrowingID, r.ResourceName, b.BorrowStartTime, b.BorrowEndTime 
                    FROM Borrowings b 
                    JOIN Resources r ON b.ResourceID = r.ResourceID 
                    WHERE b.UserID = $userid";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ResourceName'] . "</td>";
                    echo "<td>" . $row['BorrowStartTime'] . "</td>";
                    echo "<td>" . $row['BorrowEndTime'] . "</td>";
                    echo "<td><form action='return_resource.php' method='post' style='display:inline;'>
                              <input type='hidden' name='borrowing_id' value='" . $row['BorrowingID'] . "'>
                              <button type='submit'>Return</button>
                          </form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No borrowing history found</td></tr>";
            }
            ?>
        </table>

        <!-- Logout Button -->
        <form action="logout.php" method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>