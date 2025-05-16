<?php
require "../component/db_conn.php";
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = (int)($_GET['id'] ?? 0);

if ($course_id <= 0) {
    header("Location: courses.php");
    exit();
}

// Fetch course details
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();

if (!$course) {
    echo "Course not found.";
    exit();
}

// Check purchase status
$stmt = $conn->prepare("SELECT * FROM purchases WHERE user_id = ? AND course_id = ?");
$stmt->bind_param("ii", $user_id, $course_id);
$stmt->execute();
$hasPurchased = $stmt->get_result()->num_rows > 0;

// Fetch course videos
$videos = $conn->query("SELECT * FROM course_videos WHERE course_id = $course_id");

$isActive = ($course['status'] === 'active');

?>

<!DOCTYPE html>
<html lang="en">

<?php require "../component/all_link.php"; ?>

<head>
    <title><?= htmlspecialchars($course['title']) ?> - TechEdHub</title>
</head>

<body class="font-nunito bg-[#F7F5FA]">
    <?php require "../component/head.php"; ?>

    <?php if ($hasPurchased): ?>
        <!-- Purchased: Show videos only -->
        <section class="max-w-[1280px] mx-auto py-10">
            <h2 class="text-2xl font-bold text-center text-[#4B0082] mb-10">Course Videos</h2>

            <?php if ($videos->num_rows > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php while ($video = $videos->fetch_assoc()):
                        $video_id = $video['youtube_url'] ?? '';    
                        $url = "https://www.youtube.com/embed/" . $video_id;   
                    ?>
                        <div class="bg-[#EFEBF5] border border-[#9C4DF4] rounded-lg p-4">
                            <iframe class="w-full h-56 rounded-lg border border-[#9C4DF4]"

                                src="<?php echo $url; ?>"
                                frameborder="0" allowfullscreen></iframe>
                            <p class="mt-2 text-lg font-semibold text-[#4B0082]"><?= htmlspecialchars($video['title']) ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-600">No videos found for this course.</p>
            <?php endif; ?>
        </section>

    <?php else: ?>

        <section class="max-w-[1280px] mx-auto bg-[#EFEBF5] p-6 mt-6 rounded-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold text-[#4B0082]"><?= ($course['title']) ?></h1>
                    <p><span class="font-semibold">Instructor:</span> <?= ($course['instructor_name']) ?></p>
                    <p><span class="font-semibold">Class:</span> <?= ($course['class']) ?></p>
                    <p><span class="font-semibold">Language:</span> <?= ($course['language']) ?></p>
                    <p><span class="font-semibold">Price:</span> $<?= $course['price'] ?></p>
                    <p class="font-semibold <?= $course['status'] === 'active' ? 'text-green-600' : 'text-red-600' ?>">
                        Status: <?= $course['status'] ?>
                    </p>

                    <a
                        <?= $isActive ? "href=\"buy_now.php?id=$course_id\"" : "aria-disabled=\"true\" style=\"cursor: not-allowed; opacity: 0.6;\"" ?>
                        class="inline-block mt-3 bg-[#9C4DF4] text-white px-5 py-2 rounded-lg hover:bg-[#7a2fdc] transition
    <?= $isActive ? '' : 'pointer-events-none' ?>">
                        Buy This Course
                    </a>
                </div>

                <div>
                    <img src="<?= htmlspecialchars($course['thumbnail']) ?>" alt="Course Thumbnail"
                        class="w-full rounded-xl border border-[#9C4DF4]">
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php include "../component/footer.php"; ?>
</body>

</html>