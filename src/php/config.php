<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'blogging';

$conn = new mysqli($host, $user, $password, $db);

if (!$conn) {
    die('MySQL connection error');
}

?>