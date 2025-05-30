<?php
require "../component/db_conn.php";
session_start();

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $youtube_url = $_POST['youtube_url'];


    $stmt = $conn->prepare("INSERT INTO course_videos (course_id, title, youtube_url) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $course_id, $title, $youtube_url);
    $result = $stmt->execute();

    if ($result) {
        $success = "Video Added ";
    }

    // header("Location: " . $_SERVER['PHP_SELF']);
    // exit();

}
?>
<!DOCTYPE html>
<html lang="en">
<?php require "../component/all_link.php"; ?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Course Video</title>
</head>

<body class="bg-[#EFEBF5] min-h-[100vh]">
    <?php require './adminNav.php'; ?>




    <section class="p-8">
        <form method="POST" class="max-w-[1280px] mx-auto mt-10 p-6 grid grid-cols-1 py-24 space-y-6 rounded-lg shadow bg-white ">
            <h1 class="text-3xl font-semibold text-center">Add Video to Course.</h1>
            <?php if (!empty($success)) : ?>
                <div class="max-w-md mx-auto mt-4 p-4 bg-green-200 text-green-800 rounded"><?= ($success) ?></div>
            <?php endif; ?>
            <label class="flex flex-col w-9/12 mx-auto">Course:
                <select name="course_id" required class="w-full p-2 border border-[#7a2fdc]/30 bg-white rounded-lg mt-1">
                    <?php
                    $courses = $conn->query("SELECT id, title FROM courses");
                    while ($c = $courses->fetch_assoc()) :
                    ?>
                        <option value="<?= $c['id'] ?>"><?= ($c['title']) ?></option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label class="flex flex-col w-9/12 mx-auto">Video Title:
                <input type="text" name="title" placeholder="Enter Video Title" required class="bg-white p-2 border rounded-lg mt-1 border-[#7a2fdc]/30" />
            </label>

            <label class="flex flex-col w-9/12 mx-auto">YouTube Embaded Code:
                <input type="text" name="youtube_url" required placeholder="Paste YouTube Video Code" class="w-full bg-white p-2 border border-[#7a2fdc]/30 rounded-lg mt-1" />

            </label>

            <button type="submit" name="submit" class="mt-4 bg-[#9C4DF4] w-9/12 mx-auto text-white px-4 py-2 rounded hover:bg-[#7a2fdc]">
                Add Video
            </button>
        </form>
    </section>
</body>

</html>