<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php require  "../component/all_link.php" ?>

<head>
    <title>TechEdHub</title>
</head>

<body class="">
    <?php require "../component/head.php" ?>


    <section class="max-w-[1280px] mx-auto h-[60vh]">

        <a href="../User/logout.php"
            class="bg-[#9C4DF4] font-medium text-white px-3.5 py-2 rounded-lg cursor-pointer hidden md:block w-[200px]">
            Log Out
        </a>
    </section>











    <?php include "../component/subscribe.php" ?>


    <?php include "../component/footer.php" ?>
</body>