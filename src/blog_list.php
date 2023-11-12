<?php
session_start();
if (!isset($_SESSION['username'])) {
    session_destroy();
    header("Location: index.php");
}

require "php/config.php";

$result = $conn->query("SELECT * FROM blog_post");


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
                        <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
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
                            <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
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

    <section class='bg-white w-4/6 mx-auto'>
        <div class='container py-10 mx-auto'>
            <h1 class='text-3xl font-semibold text-gray-800 capitalize lg:text-4xl'>Blog posts</h1>

            <?php

            function truncateString($str)
            {
                $wordCount = 30;
                // Explode the string into an array of words
                $words = explode(' ', $str);

                // Check if the number of words exceeds the limit
                if (count($words) > $wordCount) {
                    // Truncate the array of words and join them back to form a string
                    $truncated = implode(' ', array_slice($words, 0, $wordCount)) . '...';
                    return $truncated;
                }

                return $str; // Return the original string if it's within the limit
            }

            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    $blog_component = "


        <div class='mt-8 lg:-mx-6 lg:flex lg:items-center'>
            <img class='object-cover w-full lg:mx-6 lg:w-1/2 rounded-xl h-72 lg:h-96'
                src='php/" . $data['blog_pic_path'] . "'
                alt=''>

            <div class='mt-6 lg:w-1/2 lg:mt-0 lg:mx-6 '>
                <p class='text-sm text-blue-500 uppercase'>" . $data['blog_category'] . "</p>

                <a href='blog.php?id=" . $data['blog_ID'] . "'
                    class='block mt-4 text-2xl font-semibold text-gray-800 hover:underline md:text-3xl'>
                    " . $data['blog_title'] . "
                </a>

                <p class='mt-3 text-sm text-gray-500 md:text-sm'>
                    " . truncateString($data['blog_content']) . "
                </p>

                <a href='blog.php?id=" . $data['blog_ID'] . "'
                    class='inline-block mt-2 py-2 px-4 bg-blue-500 rounded hover:bg-blue-600 text-white font-medium'>Read
                    more</a>

                <div class='flex items-center mt-6'>
                    <div class=''>
                        <h1 class='text-sm text-gray-700'>Date: " . $data['date_posted'] . "</h1>
                        <p class='text-sm text-gray-500'>Date posted</p>
                    </div>
                </div>
            </div>
        </div>

    ";
                    echo $blog_component;
                }
            }


            ?>
        </div>
    </section>


</body>

</html>