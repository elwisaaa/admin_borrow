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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-red-700 text-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl mb-6">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h2 class="text-2xl mb-4">Student Dashboard</h2>

        <!-- Resources Table -->
        <h3 class="text-xl mb-4">Available Resources</h3>
        <table class="w-full bg-gray-100 text-red-700 border border-red-700 rounded-lg mb-6">
            <thead>
                <tr>
                    <th class="p-2 border border-red-700">Resource Name</th>
                    <th class="p-2 border border-red-700">Description</th>
                    <th class="p-2 border border-red-700">Category</th>
                    <th class="p-2 border border-red-700">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT r.ResourceID, r.ResourceName, r.ResourceDescription, c.CategoryName FROM resources r JOIN categories c ON r.CategoryID = c.CategoryID";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='p-2 border border-red-700'>" . $row['ResourceName'] . "</td>";
                        echo "<td class='p-2 border border-red-700'>" . $row['ResourceDescription'] . "</td>";
                        echo "<td class='p-2 border border-red-700'>" . $row['CategoryName'] . "</td>";
                        echo "<td class='p-2 border border-red-700'>
                                <form action='borrow_resource.php' method='post' class='inline'>
                                    <input type='hidden' name='resource_id' value='" . $row['ResourceID'] . "'>
                                    <input type='datetime-local' name='borrow_start_time' class='mr-2 p-1 border border-red-700 rounded' required>
                                    <input type='datetime-local' name='borrow_end_time' class='mr-2 p-1 border border-red-700 rounded' required>
                                    <button type='submit' class='bg-red-600 text-gray-100 py-1 px-3 rounded-lg hover:bg-red-700'>Reserve</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='p-2 text-center'>No resources available</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Borrowing History Button -->
        <div class="text-center mb-4">
            <form action="view_history.php" method="post">
                <button type="submit" class="bg-gray-200 text-red-700 py-2 px-4 rounded-lg hover:bg-gray-300">View Borrowing History</button>
            </form>
        </div>

        <!-- Logout Button -->
        <div class="text-center">
            <form action="logout.php" method="post">
                <button type="submit" class="bg-gray-200 text-red-700 py-2 px-4 rounded-lg hover:bg-gray-300">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
