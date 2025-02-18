<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
session_start();
$title = "Users Table";
include 'header.php'; 

$file = "users.txt";
$users = [];

if (file_exists($file)) {
    $file_data = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($file_data as $line) {
        $users[] = explode(", ", $line);
    }
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}

thead {
    background: #007BFF;
    color: white;
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f1f1f1;
}

.profile-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.no-img {
    color: #999;
    font-style: italic;
}

</style>
<div class="container">
    <h2 class="title">Users List</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Room No</th>
                    <th>Ext</th>
                    <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user[0]; ?></td>
                        <td><?php echo $user[1]; ?></td>
                        <td><?php echo $user[3]; ?></td>
                        <td><?php echo $user[4]; ?></td>
                        <td>
                            <?php
                            $email = trim($user[1]);
                            $image_extensions = ['jpg', 'jpeg', 'png'];
                            $image_found = false;

                            foreach ($image_extensions as $ext) {
                                $image_path = "imgs/" . $email . "." . $ext;
                                if (file_exists($image_path)) {
                                    echo "<img src='$image_path' class='profile-img' alt='Profile'>";
                                    $image_found = true;
                                    break;
                                }
                            }

                            if (!$image_found) {
                                echo "<span class='no-img'>No Image</span>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

echo "<button><a href='add_user.php'>Add New User</a></button>";


<?php include 'footer.php'; ?>
