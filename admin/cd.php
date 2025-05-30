<?php
require '../component/db_conn.php';

$course_id = (int)($_GET['id'] ?? 0);

// Handle deletion if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM course_videos WHERE id = $delete_id");
    // Redirect to avoid resubmission on refresh
    header("Location: ?id=$course_id");
    exit;
}

$videos = $conn->query("SELECT * FROM course_videos WHERE course_id = $course_id");
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Course Videos</title>
    <?php require "../component/all_link.php"; ?>
</head>

<body class="bg-[#F7F5FA] min-h-screen"> 

    <?php require './adminNav.php'; ?>

    <main class="bg-white rounded shadow-xl p-8 max-w-[1280px] mx-auto mt-16">
        <h1 class="text-2xl font-bold  mb-6 text-center tracking-wide">
            Videos for Course: <br> <span class="text-indigo-900 text-3xl"><?= $course['title'] ?></span>
        </h1>

        <?php if ($videos->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-indigo-200 rounded-lg shadow-sm">
                    <thead class="bg-[#9C4DF4] text-white">
                        <tr>
                
                            <th class="text-left py-3 px-6 font-semibold">Video Title</th>
                            <th class="py-3 px-6 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($video = $videos->fetch_assoc()): ?>
                            <tr class="border-t border-indigo-200 hover:bg-indigo-100 transition-colors duration-300">
                        
                                <td class="py-4 px-6 font-semibold truncate max-w-xs" title="<?= $video['title'] ?>">
                                    <?= ($video['title']) ?>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this video?');" class="inline-block">
                                        <input type="hidden" name="delete_id" value="<?= $video['id'] ?>" />
                                        <button
                                            type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-400"
                                            aria-label="Delete video <?= $video['title'] ?>">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-400 font-medium mt-10 text-lg">
                No videos found for this course.
            </p>
        <?php endif; ?>

    </main>

</body>

</html>