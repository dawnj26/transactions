<?php
session_start();
if (!isset($_SESSION['username'])) {
    session_destroy();
    header("Location: index.php");
}

if (!isset($_GET['id'])) {
    die();
}

$id = $_GET['id'];

require "php/config.php";




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Blogs</title>
</head>

<body>


    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>

                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <svg class="h-8 w-auto fill-gray-300" xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M404.2 309.5L383.1 344h42.3l-21.1-34.5zM371.4 256l-54-88H194.6l-54 88 54 88H317.4l54-88zm65.7 0l53.4 87c3.6 5.9 5.5 12.7 5.5 19.6c0 20.7-16.8 37.4-37.4 37.4H348.7l-56.2 91.5C284.8 504.3 270.9 512 256 512s-28.8-7.7-36.6-20.5L163.3 400H53.4C32.8 400 16 383.2 16 362.6c0-6.9 1.9-13.7 5.5-19.6l53.4-87L21.5 169c-3.6-5.9-5.5-12.7-5.5-19.6C16 128.8 32.8 112 53.4 112H163.3l56.2-91.5C227.2 7.7 241.1 0 256 0s28.8 7.7 36.6 20.5L348.7 112H458.6c20.7 0 37.4 16.8 37.4 37.4c0 6.9-1.9 13.7-5.5 19.6l-53.4 87zm-54-88l21.1 34.5L425.4 168H383.1zM283 112L256 68l-27 44h54zM128.9 168H86.6l21.1 34.5L128.9 168zM107.8 309.5L86.6 344h42.3l-21.1-34.5zM229 400l27 44 27-44H229z" />
                        </svg>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="blog_list.php"
                                class="bg-gray-800 text-white rounded-md px-3 py-2 text-sm font-medium"
                                aria-current="page">Home</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <a href="create_blog.php"
                        class="relative flex items-center gap-2 rounded bg-green-600 hover:bg-green-700 py-2 px-4 text-white text-sm mr-2">
                        <span>Create blog post</span>
                        <svg class="fill-white inline" xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                        </svg>
                    </a>
                    <a href="index.php?logout=1"
                        class="relative flex items-center gap-2 rounded bg-red-600 hover:bg-red-700 py-2 px-4 text-white text-sm">
                        <span>Log out</span>
                    </a>

                </div>
            </div>
        </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium"
                    aria-current="page">Dashboard</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Team</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
            </div>
        </div>
    </nav>



    <div class="w-4/6 mx-auto py-10">

        <?php
        $blog = $conn->query("SELECT *, DATE_FORMAT(date_posted, '%M %d, %Y %h:%i %p') AS formatted_datetime
        FROM blog_post WHERE blog_ID = $id");

        if ($blog->num_rows <= 0) {
            echo "<h2 class='text-4xl font-semibold text-center mb-2'>Something went wrong!</h2>";
            echo "<p class='text-center'><a href='blog_list.php' class='underline'>Go back</a></p>";
            die();
        }

        $blogData = $blog->fetch_assoc();
        $comment = $conn->query("SELECT * FROM comments WHERE blog_ID = $id ORDER BY date_posted DESC");

        $blog = "
    <h1 class='text-4xl font-semibold mb-6'>" . $blogData['blog_title'] . "</h1>

        <img class='object-cover w-full rounded-xl h-72 lg:h-96 mb-6'
            src='php/" . $blogData['blog_pic_path'] . "'
            alt=''>
        <p class='text-justify indent-10 mb-6'>" . $blogData['blog_content'] . "
        </p>

        <p><span class='font-semibold'>Filed under:</span> " . $blogData['blog_category'] . ", " . $blogData['formatted_datetime'] . "</p>
    
    ";
        echo $blog;
        ?>





        <div class="my-6">
            <h3 class="text-2xl font-semibold mb-6">Comments</h3>
            <form id="comment_form">
                <div class="mb-4">
                    <label for="comment" class="mb-3 block text-base font-medium text-[#07074D]">
                        Add comment
                    </label>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <textarea rows="4" required name="comment" id="comment" placeholder="Type your comment"
                        class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="hover:shadow-form rounded-md bg-blue-500 hover:bg-blue-600 py-2 px-4 font-medium text-white outline-none">
                        Post
                    </button>
                </div>
            </form>

        </div>

        <div class="comments">
            <?php

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
        </div>



    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/comments.js"></script>

</body>

</html>