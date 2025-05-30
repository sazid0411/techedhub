<?php
require '../component/db_conn.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid course ID.";
    exit;
}

$id = (int) $_GET['id'];

// Fetch course
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    echo "Course not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST['title'];
        $class = $_POST['class'];
        $instructor = $_POST['instructor_name'];
        $language = $_POST['language'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $thumbnail = $_POST['thumbnail'];

        $update = $conn->prepare("UPDATE courses SET title=?, class=?, instructor_name=?, language=?, price=?, status=?, thumbnail=? WHERE id=?");
        $update->bind_param("ssssdssi", $title, $class, $instructor, $language, $price, $status, $thumbnail, $id);

        if ($update->execute()) {
            header("Location: allCourse.php");
            exit;
        } else {
            echo "Error updating course: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require "../component/all_link.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
</head>

<body class=" mx-auto bg-[#F9F9FC]">
    <?php require './adminNav.php'; ?>

    <div class="max-w-[1280px] mx-auto">
        <div class="max-w-9/12 mx-auto bg-[#EFEBF5] border border-[#9C4DF4] rounded-xl p-8 mt-8 shadow-md">
            <h2 class="text-2xl font-bold text-[#4B0082] mb-6 text-center">Update Course</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Title</label>
                    <input type="text" name="title" value="<?php echo  ($course['title']); ?>" required
                        class="w-full bg-white border border-[#9C4DF4] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#9C4DF4]">
                </div>

                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Class</label>
                    <input type="text" name="class" value="<?php echo  ($course['class']); ?>" required
                        class="w-full bg-white border border-[#9C4DF4] rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Instructor</label>
                    <input type="text" name="instructor_name" value="<?php echo $course['instructor_name']; ?>" required
                        class="w-full bg-white border border-[#9C4DF4] rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Language</label>
                    <input type="text" name="language" value="<?php echo $course['language']; ?>" required
                        class="w-full bg-white border border-[#9C4DF4] rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Price</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $course['price']; ?>" required
                        class="w-full bg-white border border-[#9C4DF4] rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Status</label>
                    <select name="status" required class="w-full border border-[#9C4DF4] rounded-lg p-2 bg-white">
                        <option value="active" <?php if ($course['status'] === 'active') echo 'selected'; ?>>Active</option>
                        <option value="inactive" <?php if ($course['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[#4B0082] font-semibold mb-1">Thumbnail URL</label>
                    <input type="text" name="thumbnail" value="<?php echo $course['thumbnail']; ?>" required
                        class="w-full bg-white border border-[#9C4DF4] rounded-lg p-2">
                </div>

                <div class="text-center">
                    <button type="submit"
                        name="submit"
                        class="bg-[#9C4DF4] hover:bg-[#7a30db] text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>