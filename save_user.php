<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
session_start();
include 'header.php';
include 'business_logic.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['room_id'], $_POST['ext'])) {
        echo "all filed requerd";
        exit;
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $room_id = $_POST['room_id'];
    $ext = $_POST['ext'];
    $profile_picture = '';

    if ($password !== $confirm_password) {
        echo "password not confirm";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "email not valid";
        exit;
    }

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profile_picture']['type'], $allowed_types)) {
            echo "the valid ext(JPEG, PNG, GIF).";
            exit;
        }

        if ($_FILES['profile_picture']['size'] > 2 * 1024 * 1024) {
            echo "the img not maxamm up 2G";
            exit;
        }

        $profile_picture = 'Images/' . md5($email) . '.jpg'; // استخدام md5 لتوليد اسم فريد بناءً على البريد الإلكتروني
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
            echo "error in upload photo";
            exit;
        }
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $inserted = insert_user($name, $email, $hashed_password, $room_id, $ext, $profile_picture);

    if ($inserted) {
        header("Location: users.php");  
        exit();
    } else {
        echo "error in add user";
    }
}
?>
