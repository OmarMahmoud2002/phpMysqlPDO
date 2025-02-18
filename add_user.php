<?php
session_start();
include 'header.php';
include 'business_logic.php';

$rooms = get_all_rooms();
?>

<div class="container">
    <h2>Add New User</h2>
    <form action="save_user.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" required placeholder="Name">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="password" name="confirm_password" required placeholder="Confirm Password">
        <select name="room_id" required>
            <?php foreach ($rooms as $room) : ?>
                <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="ext" placeholder="Ext">
        <input type="file" name="profile_picture">
        <button type="submit">Save</button>
    </form>
</div>

<?php include 'footer.php'; ?>
