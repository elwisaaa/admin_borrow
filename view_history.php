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
    <title>Borrowing History</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Borrowing History</h1>
        <table>
            <tr>
                <th>Resource Name</th>
                <th>Borrow Start Time</th>
                <th>Borrow End Time</th>
                <th>Action</th>
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

        <!-- Back to Dashboard Button -->
        <form action="student_dashboard.php" method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="back-btn">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>