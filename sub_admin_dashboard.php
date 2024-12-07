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
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4d9d0; /* Light shade from palette */
            padding: 20px;
            color: #7d0a0a; /* Maroon text */
        }

        /* Container Styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Header Styling */
        .header {
            text-align: center;
            padding: 20px;
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px;
        }

        /* Heading Styling */
        h1, h2, h3 {
            color: #7d0a0a; /* Maroon text */
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"], input[type="datetime-local"], textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #5a0707; /* Darker maroon */
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
        }

        td a {
            color: #7d0a0a; /* Maroon text */
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        /* Additional Classes */
        .login-container, .signup-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .login-options, .signup-options {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #5a0707; /* Darker maroon */
        }
    </style>
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
        ?><br><br>
    </table>
    <form action="index.php" method="post" style="text-align: center; margin-top: 20px;">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
