<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>

<?php
session_start();
include 'header.php';
include 'business_logic.php';



$users = get_all_users();
?>

<div class="container">
    <h2>Users List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Room</th>
            <th>Ext</th>
            <th>Profile Picture</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['room_name'] ?></td>
                <td><?= $user['ext'] ?></td>
                <td>
                    <?php
                    $image_path = 'Images/' . md5($user['email']) . '.jpg'; // استخدم md5 للتأكد من اسم فريد
                    if (file_exists($image_path)) {
                        echo "<img src='$image_path' class='profile-img' alt='Profile'>";
                    } else {
                        echo "<span class='no-img'>No Image</span>";
                    }
                    ?>
                </td>
                <td>
                    <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a> |
                    <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <button onclick="window.location.href='add_user.php'">Add New User</button>
</div>

<?php include 'footer.php'; ?>
