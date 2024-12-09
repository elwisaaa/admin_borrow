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
<body class="bg-red-700 text-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl mb-6">Borrowing History</h1>
        <table class="w-full bg-gray-100 text-red-700 border border-red-700 rounded-lg mb-6">
            <thead>
                <tr>
                    <th class="p-2 border border-red-700">Resource Name</th>
                    <th class="p-2 border border-red-700">Borrow Start Time</th>
                    <th class="p-2 border border-red-700">Borrow End Time</th>
                    <th class="p-2 border border-red-700">Action</th>
                </tr>
            </thead>
            <tbody>
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
                    echo "<td class='p-2 border border-red-700'>" . $row['ResourceName'] . "</td>";
                    echo "<td class='p-2 border border-red-700'>" . $row['BorrowStartTime'] . "</td>";
                    echo "<td class='p-2 border border-red-700'>" . $row['BorrowEndTime'] . "</td>";
                    echo "<td class='p-2 border border-red-700'><form action='return_resource.php' method='post' style='display:inline;'>
                              <input type='hidden' name='borrowing_id' value='" . $row['BorrowingID'] . "'>
                              <button type='submit' class='bg-red-600 text-gray-100 py-1 px-3 rounded-lg hover:bg-red-700'>Return</button>
                          </form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='p-2 text-center'>No borrowing history found</td></tr>";
            }
            ?>
            </tbody>
        </table>

        <!-- Back to Dashboard Button -->
        <div class="text-center">
            <form action="student_dashboard.php" method="post">
                <button type="submit" class="bg-gray-200 text-red-700 py-2 px-4 rounded-lg hover:bg-gray-300">Back to Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>