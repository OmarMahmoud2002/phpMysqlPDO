<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
include 'business_logic.php';

$id = $_GET['id'];
$deleted = delete_user($id);

if ($deleted) {
    header("Location: users.php");
    exit();
} else {
    echo "Error deleting user!";
}
?>
