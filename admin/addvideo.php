<?php
require "../component/db_conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $course_id = $_POST['course_id'];
    $title = trim($_POST['title']);
    $youtube_url = trim($_POST['youtube_url']);

    if (filter_var($youtube_url)) {
        $stmt = $conn->prepare("INSERT INTO course_videos (course_id, title, youtube_url) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $course_id, $title, $youtube_url);
        $stmt->execute();

        // header("Location: " . $_SERVER['PHP_SELF']);
        // exit();
    } else {
        $error = "Invalid YouTube URL.";
    }
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

<body>
    <?php require './adminNav.php'; ?>

    <?php if (!empty($error)) : ?>
        <div class="max-w-md mx-auto mt-4 p-4 bg-red-200 text-red-800 rounded"><?= ($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="max-w-[1280px] mx-auto mt-10 p-6 grid grid-cols-1 py-24 space-y-6 rounded-lg shadow bg-[#EFEBF5]">
        <label class="flex flex-col w-9/12 mx-auto">Course:
            <select name="course_id" required class="w-full p-2 border border-[#7a2fdc] rounded-lg mt-1">
                <?php
                $courses = $conn->query("SELECT id, title FROM courses");
                while ($c = $courses->fetch_assoc()) :
                ?>
                    <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
                <?php endwhile; ?>
            </select>
        </label>

        <label class="flex flex-col w-9/12 mx-auto">Video Title:
            <input type="text" name="title" placeholder="Enter Video Title" required class="   p-2 border rounded-lg mt-1 border-[#7a2fdc]" />
        </label>

        <label class="flex flex-col w-9/12 mx-auto">YouTube Embaded Code:
            <input type="text" name="youtube_url" required placeholder="Embaded Code From Youtube" class="w-full p-2 border border-[#7a2fdc] rounded-lg mt-1" />
        </label>

        <button type="submit" name="submit" class="mt-4 bg-[#9C4DF4] w-9/12 mx-auto text-white px-4 py-2 rounded hover:bg-[#7a2fdc]">
            Add Video
        </button>
    </form>
</body>

</html>