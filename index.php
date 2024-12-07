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
            margin-top: 20px;
        }

        /* Forms */
        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }

        form {
            padding-left: 100px;
            padding-right: 100px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 0;
        }

        form input, 
        form textarea, 
        form select, 
        form button {
            width: 100%;
            padding: 12px;
            border: 1px solid #7d0a0a; /* Maroon border */
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            background-color: #f4d9d0;
            box-sizing: border-box;
        }

        form#login-form {
            background-color: #ffffff; /* White background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .login-container h2 {
            color: #7d0a0a; /* Maroon text */
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            color: #7d0a0a; /* Maroon text */
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            background-color: #ffffff; /* White background */
            border: 1px solid #7d0a0a; /* Maroon border */
            border-radius: 5px;
            color: #7d0a0a; /* Maroon text */
            font-size: 16px;
            box-sizing: border-box;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            border: 1px solid #ffffff; /* White border */
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-align: center;
            display: block;
            margin-bottom: 10px;
        }

        .login-btn:hover {
            background-color: #d9abab; /* Lighter shade of maroon */
            transform: scale(1.05);
        }

        .login-options a {
            display: inline-block;
            padding: 12px;
            background-color: #db4437; /* Google red */
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            margin-bottom: 10px;
        }

        .login-options a:hover {
            background-color: #f4d9d0; /* Light background on hover */
            color: #7d0a0a; /* Dark maroon text */
        }

        .login-options p {
            color: #7d0a0a; /* Maroon text */
            text-align: center;
        }

        .login-options a {
            color: #7d0a0a; /* Maroon text */
            text-decoration: underline;
        }

        .login-options a:hover {
            color: #ffffff; /* White on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff; /* White background */
            color: #7d0a0a; /* Maroon text */
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #d9abab;
            text-align: left;
        }

        table th {
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
        }

        table tr:nth-child(even) {
            background-color: #f4d9d0;
        }

        table a {
            color: #7d0a0a; /* Maroon text */
            text-decoration: none;
            font-weight: bold;
        }

        table a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
            font-weight: bold;
            text-align: center;
            border: 1px solid #ffffff; /* White border */
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #d9abab;
        }

        body {
            background-color: #7d0a0a; /* Maroon */
            color: #f3edc8; /* Cream */
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #f3edc8; /* Cream */
            margin-bottom: 20px;
        }

        .container-index {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 800px;
            width: 90%;
            padding: 20px;
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-selection {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .login-btn {
            background-color: #7d0a0a; /* Maroon background */
            color: #ffffff; /* White text */
            border: 1px solid #ffffff; /* White border */
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #d9abab; /* Subtle highlight */
        }
    </style>
</head>
<body>
    <div class="container-index">
        <h1>Login as</h1>
        <div class="login-selection">
            <a href="admin_login.php" class="login-btn">Admin</a>
            <a href="sub_admin_login.php" class="login-btn">Sub-Admin</a>
        </div>
    </div>
</body>
</html>
