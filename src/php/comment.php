<?php
session_start();
if (!isset($_POST['id'])) {
    die();
}

$id = $_POST['id'];
$comment = $_POST['comment'];
$username = $_SESSION['username'];

require "config.php";


if (!$conn->query("INSERT INTO comments (blog_ID, username, comment) VALUES ($id, '$username', '$comment')")) {
    die('Query error');
}

$comment = $conn->query("SELECT * FROM comments WHERE blog_ID = $id ORDER BY date_posted DESC");



if ($comment->num_rows > 0) {
    while ($dataComment = $comment->fetch_assoc()) {
        $comments = "
                <div class='grid grid-cols-[auto_1fr] mb-4'>
                <svg class='h-8 w-8 rounded-full mt-2' xmlns='http://www.w3.org/2000/svg' height='1em'
                    viewBox='0 0 448 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d='M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z' />
                </svg>
                <div class='ml-4'>
                    <div class='px-4 py-2 bg-gray-200 rounded-md'>
                        <p class='mb-4 font-semibold'>" . $dataComment['username'] . "</p>
                        <p class=''>" . $dataComment['comment'] . "</p>
        
                    </div>
                    <p class='text-sm mt-2'>" . $dataComment['date_posted'] . "</p>
                </div>
        
            </div>
                
                ";
        echo $comments;
    }
}


?>