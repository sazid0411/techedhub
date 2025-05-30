<?php
require "../component/db_conn.php";
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}


$sql = "SELECT * FROM courses ORDER BY id DESC";
$result = $conn->query($sql);

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
      

        <div class="space-y-10 mt-20">
            <h1 class="text-3xl text-center font-bold">All Courses</h1>



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


    </section>








    <?php include "../component/footer.php" ?>



</body>

</html>