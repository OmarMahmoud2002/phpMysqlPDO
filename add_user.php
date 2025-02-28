<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'header.php';
include 'business_logic.php';
include 'validation.php';
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}


$rooms = get_all_rooms();
?>

<div class="container">
    <h2>Add New User</h2>
    <form action="save_user.php" method="POST" enctype="multipart/form-data">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required placeholder="Enter full name">

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required placeholder="Enter email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter password">

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Re-enter password">

        <label for="room_id">Select Room</label>
        <select id="room_id" name="room_id" required>
            <option value="">Select a room</option>
            <?php foreach ($rooms as $room) : ?>
                <option value="<?= $room['id'] ?>"><?= htmlspecialchars($room['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="ext">Extension </label>
        <input type="text" id="ext" name="ext" placeholder="Enter extension number">

        <label for="profile_picture">Profile Picture</label>
        <input type="file" id="profile_picture" name="profile_picture">

        <button type="submit">Save</button>
    </form>
</div>

<?php include 'footer.php'; ?>
