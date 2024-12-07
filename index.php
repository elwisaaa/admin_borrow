<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Selection</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body, h1, h2, h3, form, table, button {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #7d0a0a;
            box-sizing: border-box;
        }

        body {
            background-color: #f4d9d0; /* Light shade from palette */
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1, h2 {
            color: #7d0a0a; /* Maroon text */
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            color: #7d0a0a; /* Maroon text */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <h2>Please choose an option</h2>
        <h3>Log in as:</h3>
        <div class="button-container">
            <button onclick="location.href='admin_login.php'">Admin</button>
            <button onclick="location.href='sub_admin_login.php'">Sub-Admin</button>
        </div>
    </div>
</body>
</html>
