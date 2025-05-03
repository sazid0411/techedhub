<?php
  include "../component/classList.php";
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
    <title>TechEdHub || Courses</title>
</head>

<body class="font-nunito bg-[#F7F5FA]">
    <?php require "../component/head.php" ?>

    <section class="max-w-[1280px] mx-auto bg-[#EFEBF5] flex items-center justify-around p-6 mt-6 rounded-2xl">
        <div>
            <h1 class="text-4xl font-semibold ">TechEdHub Courses <br> For All <span
                    class="text-[#9C4DF4]">Standards</span>.</h1>
        </div>
        <div>
            <img src="../assets/coursebanner.png" alt="">
        </div>
    </section>


    <section class="max-w-[1280px] mx-auto py-6 ">
        <h1 class="text-3xl font-[700]">
            Standard Classes
        </h1>


        <div class=" grid grid-cols-4 gap-10 text-center mt-8">

        

            <?php
          
            
            foreach ($classes as $class): ?>
            <div class="p-8 flex items-center justify-center flex-col gap-4 bg-[#FFFFFF] rounded-2xl">
                <div class="bg-[#FF6529] flex items-center w-[40px] h-[40px] rounded-full justify-center">
                    <i class="fa-solid fa-graduation-cap text-xl text-white"></i>
                </div>
                <h1 class="text-2xl font-bold">
                    <?= $class['name'] ?>
                </h1>
                <p>
                    <?= $class['description'] ?> 
                </p>
                <a href="./<?= $class['link'] ?>"
                    class="border border-[#9C4DF4] font-medium text-black px-3.5 py-2 rounded-lg cursor-pointer hover:bg-[#9C4DF4] hover:text-white">
                    Class Details
                </a>
            </div>
            <?php endforeach; ?>





        </div>


    </section>








    <?php include "../component/footer.php" ?>



</body>

</html>