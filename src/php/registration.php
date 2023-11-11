<?php

if (!isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['username']) || empty($_POST['password'])) {
    die('incomplete');
}

require 'config.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$usernameCount = $conn->query("SELECT username FROM users WHERE username = '$username'");
if ($usernameCount->num_rows > 0) {
    die("Username '$username' already exists");
}

$stmt = $conn->prepare('INSERT INTO users VALUES (?, ?)');
$stmt->bind_param('ss', $username, $password);

if (!$stmt->execute()) {
    die('Query Error');
}

echo 'Successfully Registered';
?>