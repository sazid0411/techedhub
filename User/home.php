<?php
session_start();
require "../component/db_conn.php";


$sql = "SELECT * FROM courses ORDER BY id ASC";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">

<?php require  "../component/all_link.php" ?>

<head>
    <title>TechEdHub</title>
</head>

<body class="bg-[#F7F5FA] font-nunito">
    <!-- header -->

    <?php require "../component/head.php" ?>

    <!-- Banner -->

    <div class="max-w-[1280px] mx-auto my-12 p-5">
        <div class="place-items-center flex flex-col-reverse lg:flex-row items-center font-nunito gap-6 md:gap-[80px]">
            <div class="flex flex-col items-start justify-center gap-[30px]">
                <span class="p-4 px-5 bg-white text-red-500 text-xl rounded-xl font-medium">
                    Never Stop Learning
                </span>
                <h1 class="text-3xl md:text-6xl font-bold md:leading-[70px]">
                    Grow up your skills <br />
                    by online courses <br />
                    with
                    <span class="font-borel">Tech<span class="text-[#9C4DF4]">Ed</span>Hub<span class="text-[#9C4DF4]">.</span></span>
                </h1>
                <p class="max-w-[607px] md:leading-relaxed text-[#5D5A6F] md:text-xl">
                    Eduvi is a Global training provider based across the UK that
                    specialises in accredited and bespoke training courses. We crush the
                    barriers togetting a degree.
                </p>
            </div>
            <div>
                <img src="../assets/boy-bg.png" alt="" />
            </div>
        </div>
    </div>


    <div class=" max-w-[1280px] mx-auto space-y-10 px-3 mt-20">
        <h1 class="text-4xl text-center font-bold">Popular Courses<span class="text-[#9C4DF4]">.</span></h1>



        <?php if ($result && $result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-[#EFEBF5] border border-[#9C4DF4] rounded-lg p-5 space-y-3 flex flex-col justify-between">
                        <img src="<?php echo  ($row['thumbnail']); ?>" alt="Thumbnail" class="w-full h-40 object-cover rounded-lg border border-[#9C4DF4]">

                        <div class="space-y-1">
                            <h2 class="text-xl font-semibold text-[#4B0082]"><?php echo ($row['title']); ?></h2>
                            <p><span class="font-semibold">Class:</span> <?php echo ($row['class']); ?></p>
                            <p><span class="font-semibold">Instructor:</span> <?php echo ($row['instructor_name']); ?></p>

                            <p><span class="font-semibold">Language:</span> <?php echo ($row['language']); ?></p>
                            <p><span class="font-semibold">Price:</span> ৳<?php echo $row['price']; ?></p>
                            <p class="font-semibold <?php echo $row['status'] === 'active' ? 'text-green-600' : 'text-red-600'; ?>">
                                Status: <?php echo $row['status']; ?>
                            </p>
                        </div>

                        <a href="course_details.php?id=<?php echo $row['id']; ?>"
                            class="mt-4 inline-block text-center bg-[#9C4DF4] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#7a2fdc] transition">
                            Details
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600">No courses found.</p>
        <?php endif; ?>
    </div>


    <!-- secondd -->
    <section class="max-w-[1136px] mx-auto md:mt-[150px] place-items-center p-5">
        <div class="place-items-center space-y-4">
            <h1 class="text-3xl text-start md:text-center md:text-[45px] font-bold">
                High quality video, audio & live classes
            </h1>
            <p class="max-w-[840px] text-start md:text-center leading-relaxed text-[#5D5A6F] md:text-lg">
                High-definition video is video of higher resolution and quality than
                standard-definition. While there is no standardized meaning for
                high-definition, generally any video image with considerably more than
                480 vertical scan lines or 576 vertical lines is considered
                high-definition.
            </p>
            <a href="../User/course.php"
                class="bg-[#9C4DF4] font-medium text-white px-8 py-3 rounded-lg cursor-pointer hidden md:block">
                Visit Courses
            </a>
        </div>

        <div class="mt-5 md:mt-[60px] bg-white p-5 rounded-xl">
            <img src="../assets/section-2.png" alt="" class="rounded-xl" />
        </div>
        <div class="hidden md:block">
            <div class="flex items-center justify-center w-full gap-7 mt-[40px]">
                <div class="bg-white p-4 w-[333px] flex items-center rounded-xl">
                    <div class="w-[70px] h-[70px] flex items-center justify-center bg-[#FFF4F2] rounded-xl">
                        <i class="fa-solid fa-volume-high text-[#FF6652] text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-semibold text-center pl-6">
                        Audio Classes
                    </h1>
                </div>
                <!--  -->
                <div class="bg-white p-4 w-[333px] flex items-center rounded-xl">
                    <div class="w-[70px] h-[70px] flex items-center justify-center bg-[#F8F2FF] rounded-xl">
                        <i class="fa-solid fa-tower-broadcast text-[#9C4DF4] text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-semibold text-center pl-6">
                        Live Classes
                    </h1>
                </div>
                <!--  -->
                <div class="bg-white p-4 w-[333px] flex items-center rounded-xl">
                    <div class="w-[70px] h-[70px] flex items-center justify-center bg-[#E5FFF3] rounded-xl">
                        <i class="fa-solid fa-circle-play text-[#00C968] text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-semibold text-center pl-6">
                        Recorded Class
                    </h1>
                </div>
                <!--  -->
            </div>
        </div>
    </section>
    <!-- Third Section -->

    <section class="p-5 bg-[#EDE9F2] max-w-[1280px] mx-auto rounded-2xl">
        <div class="flex flex-col-reverse md:flex-row items-center justify-center md:p-[90px] gap-7">
            <div class="md:ml-[70px] flex flex-col items-start justify-center gap-3">
                <span class="p-4 px-5 bg-white text-[#9C4DF4] text-xl rounded-xl font-medium">College Level</span>
                <h1 class="text-4xl font-bold">
                    Don’t waste time in Scrolling or anything. Develop your skills.
                </h1>
                <p class="max-w-[500px] text-[#5D5A6F]">
                    High-definition video is video of higher resolution and quality than
                    standard-definition. While there is no standardized meaning for
                    high-definition, generally any video.
                </p>
                <a href="./registration.php" class="px-5 rounded-xl py-3 text-white md:text-xl bg-[#9C4DF4] mt-5 md:mt-[40px]">
                    Registation Now
                </a>
            </div>
            <div class="relative">
                <img src="../assets/Image.png" alt="" class="w-full" />
            </div>
        </div>
    </section>
    <!-- Fourth Section -->

    <?php include "../component/subscribe.php" ?>


    <?php include "../component/footer.php" ?>


</body>

</html>