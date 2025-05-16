<?php
require '../component/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $title = $_POST['title'];
    $class = $_POST['class'];
    $instructor = $_POST['instructor_name'];
    $total_lectures = (int)$_POST['total_lectures'];
    $duration = $_POST['duration'];
    $level = $_POST['level'];
    $language = $_POST['language'];
    $price = (float)$_POST['price'];
    $thumbnail = $_POST['thumbnail'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO courses 
        (title, class, instructor_name, total_lectures, duration, level, language, price, thumbnail, description, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "sssisssdsss",
        $title,
        $class,
        $instructor,
        $total_lectures,
        $duration,
        $level,
        $language,
        $price,
        $thumbnail,
        $description,
        $status
    );

    if ($stmt->execute()) {
        $success_message = "Course added successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require "../component/all_link.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require "./all.php"; ?>
    <title>Add Course</title>
</head>

<body class="max-w-[1280px] mx-auto">
    <?php require './adminNav.php'; ?>

    <div class="space-y-10">
        <h1 class="text-3xl text-center font-semibold">Add New Course</h1>

        <?php if (!empty($success_message)): ?>
            <p class="text-green-600 text-center font-semibold"><?php echo $success_message; ?></p>
        <?php elseif (!empty($error_message)): ?>
            <p class="text-red-600 text-center font-semibold"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" class="p-10 bg-[#EFEBF5] rounded-lg space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="title" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Course Title">
                <input type="text" name="class" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Class">
                <input type="text" name="instructor_name" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Instructor Name">
                <input type="number" name="total_lectures" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Total Lectures">
                <input type="text" name="duration" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Duration">
                <select name="level" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg">
                    <option value="" disabled selected hidden>Select Level</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
                <input type="text" name="language" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Language">
                <input type="number" step="0.01" name="price" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Price">
                <input type="text" name="thumbnail" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg" placeholder="Thumbnail URL">
                <select name="status" required class="py-2 px-4 border bg-white border-[#9C4DF4] rounded-lg">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <textarea name="description" required class="py-2 w-full px-4 h-32 bg-white border border-[#9C4DF4] rounded-lg" placeholder="Enter Description"></textarea>

            <input type="submit" name="submit" class="bg-[#9C4DF4] rounded-lg text-white font-semibold py-3 w-full" value="Add Course">
        </form>
    </div>
</body>

</html>