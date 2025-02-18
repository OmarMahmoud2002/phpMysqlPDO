<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .navbar {
            background: #007bff;
            padding: 15px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
        }

        .navbar ul li a:hover {
            text-decoration: underline;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label,
        input {
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .buttons {
            margin-top: 15px;
            text-align: center;
        }

        button {
            padding: 8px 15px;
            border: none;
            background: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .reset {
            background: #dc3545;
        }
    </style>
</head>

<body>

<?php if (isset($_SESSION['user'])): ?>
    <nav class="navbar">
        <div class="logo">Cafeteria</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>
<?php endif; ?>