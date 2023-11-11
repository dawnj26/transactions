<?php
if (!isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['username']) || empty($_POST['password'])) {
    die('incomplete');
}

require 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE username = '$username'");
if ($result->num_rows > 0) {
    $accountDetails = $result->fetch_assoc();
    if (password_verify($password, $accountDetails['password'])) {
        echo 'match';
        session_start();
        $_SESSION['username'] = $username;
    } else {
        echo 'Incorrect password';
    }
} else {
    echo "Username does not exists";
}
?>