<?php
session_start();
if (!isset($_POST['blog_title']) || !isset($_POST['blog_content']) || !isset($_POST['category']) || !isset($_FILES['image'])) {
    die();
}

function fileExtension($s)
{
    $n = strrpos($s, ".");

    if ($n === false)
        return "";
    else
        return substr($s, $n);
}

$title = $_POST['blog_title'];
$content = $_POST['blog_content'];
$category = $_POST['category'];
$filepath = $_FILES["image"]["tmp_name"];
$username = $_SESSION['username'];
$filesize = filesize($filepath);
// $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
// $filetype = finfo_file($fileinfo, $filepath);
$origName = $_FILES["image"]["name"];


if ($filesize === 0) {
    die("The file is empty");
}

$filename = basename($filepath);
$targetDirectory = "uploads";

$newFilePath = $targetDirectory . "/" . $origName;

if (!copy($filepath, $newFilePath)) {
    die("Cannot move file!");
}

unlink($filepath);

echo "File uploaded successfully!";

require "config.php";

$stmt = $conn->prepare('INSERT INTO blog_post (blog_title, blog_content, blog_category, blog_pic_path) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $title, $content, $category, $newFilePath);

if (!$stmt->execute()) {
    die('Query Error');
}

echo 'Success';

?>