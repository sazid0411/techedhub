<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<?php require  "../component/all_link.php" ?>

<head>
    <title>TechEdHub</title>
</head>

<body class="font-nunito">
    <?php require "../component/head.php" ?>

    <section class="max-w-[1280px] mx-auto bg-[#EFEBF5] flex items-center justify-around p-6 mt-6 rounded-2xl">
        <div>
            <h1 class="text-4xl font-semibold ">TechEdHub Courses  <br>  For All  <span class="text-[#9C4DF4]">Standards</span>.</h1>
        </div>
        <div>
            <img src="../assets/coursebanner.png" alt="">
        </div>
    </section>


</body>

</html>