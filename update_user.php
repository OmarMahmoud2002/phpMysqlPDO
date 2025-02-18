<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
include 'business_logic.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$room_id = $_POST['room_id'];
$ext = $_POST['ext'];
$profile_picture = '';

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $profile_picture = 'Images/' . $_FILES['profile_picture']['name'];
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
}

$updated = update_user($id, $name, $email, $room_id, $ext, $profile_picture);

if ($updated) {
    header("Location: users.php");
    exit();
} else {
    echo "Error updating user!";
}
?>
