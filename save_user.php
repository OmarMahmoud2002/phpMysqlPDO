<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
session_start();
include 'header.php';
include 'business_logic.php';

// التحقق من المدخلات
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // التحقق من المدخلات الأساسية
    if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['room_id'], $_POST['ext'])) {
        echo "جميع الحقول مطلوبة!";
        exit;
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $room_id = $_POST['room_id'];
    $ext = $_POST['ext'];
    $profile_picture = '';

    // التحقق من تطابق كلمة المرور
    if ($password !== $confirm_password) {
        echo "كلمة المرور غير متطابقة!";
        exit;
    }

    // التحقق من تنسيق البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "تنسيق البريد الإلكتروني غير صالح!";
        exit;
    }

    // التحقق من رفع الصورة
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        // التحقق من نوع الصورة
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profile_picture']['type'], $allowed_types)) {
            echo "الرجاء رفع صورة بتنسيق صالح (JPEG, PNG, GIF).";
            exit;
        }

        // التحقق من حجم الصورة (أقصى حجم 2MB)
        if ($_FILES['profile_picture']['size'] > 2 * 1024 * 1024) {
            echo "حجم الصورة يجب أن لا يتجاوز 2 ميغابايت.";
            exit;
        }

        // حفظ الصورة باسم البريد الإلكتروني
        $profile_picture = 'Images/' . md5($email) . '.jpg'; // استخدام md5 لتوليد اسم فريد بناءً على البريد الإلكتروني
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
            echo "فشل في تحميل الصورة.";
            exit;
        }
    }

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات في قاعدة البيانات مع مسار الصورة
    $inserted = insert_user($name, $email, $hashed_password, $room_id, $ext, $profile_picture);

    // التحقق من نجاح الإدخال
    if ($inserted) {
        header("Location: users.php");  // إعادة التوجيه إلى users.php بعد الحفظ
        exit();
    } else {
        echo "حدث خطأ أثناء إضافة المستخدم!";
    }
}
?>
