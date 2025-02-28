<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
include_once 'config.php';

// Insert User
function insert_user($name, $email, $password, $room_id, $ext, $profile_picture) {
    global $pdo;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO user (name, email, password, room_id, ext, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $hashed_password, $room_id, $ext, $profile_picture]);
}

// Get All Rooms
function get_all_rooms() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM room");
    return $stmt->fetchAll();
}

// Get All Users
function get_all_users() {
    global $pdo;
    $stmt = $pdo->query("SELECT user.*, room.name AS room_name FROM user LEFT JOIN room ON user.room_id = room.id");
    return $stmt->fetchAll();
}


// Get User by ID
function get_user_by_id($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Delete User
function delete_user($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
    return $stmt->execute([$id]);
}

// Update User
function update_user($id, $name, $email, $room_id, $ext, $profile_picture = null) {
    global $pdo;
 
        $stmt = $pdo->prepare("UPDATE user SET name=?, email=?, room_id=?, ext=? WHERE id=?");
        return $stmt->execute([$name, $email, $room_id, $ext, $id]);
    
}

// Validate 
function validate_user($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}
?>
