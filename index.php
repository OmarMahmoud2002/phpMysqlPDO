<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php

session_start();
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "plz fill all data";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password'] ) {

            $_SESSION['user'] = $user['email'];
            header("Location: add_user.php"); 
            exit();
        } else {
            $error = "invalid email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; padding-top: 50px; }
        .login-container { width: 300px; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin: auto; }
        input { width: 100%; padding: 10px; margin-top: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; margin-top: 10px; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Cafe</h2>
    <form method="POST">
        <input type="email" name="email" required placeholder="email">
        <input type="password" name="password" required placeholder="password">
        <button type="submit">Login</button>
    </form>
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
</div>

</body>
</html>
