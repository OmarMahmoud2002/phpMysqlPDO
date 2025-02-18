<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
include 'business_logic.php';
$user_id = $_GET['id'];
$user = get_user_by_id($user_id);
$rooms = get_all_rooms();
?>

<form action="update_user.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="text" name="name" value="<?= $user['name'] ?>" required placeholder="Name">
    <input type="email" name="email" value="<?= $user['email'] ?>" required placeholder="Email">
    <select name="room_id" required>
        <?php foreach ($rooms as $room) : ?>
            <option value="<?= $room['id'] ?>" <?= $user['room_id'] == $room['id'] ? 'selected' : '' ?>><?= $room['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="ext" value="<?= $user['ext'] ?>" placeholder="Ext">
    <input type="file" name="profile_picture">
    <button type="submit">Save</button>
</form>

<?php include 'footer.php'; ?>
