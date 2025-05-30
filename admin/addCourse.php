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
$mentors = $conn->query("SELECT * FROM mentors");
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

<body class=" bg-[#EFEBF5]   ">
    <?php require './adminNav.php'; ?>

    <section class="mt-3 p-6">
        <div class="space-y-10 px-24 py-12 max-w-[1280px] mx-auto bg-white rounded-lg ">
            <h1 class="text-3xl text-center font-semibold">Add New Course</h1>

            <?php if (!empty($success_message)): ?>
                <div class="max-w-md mx-auto mt-4 p-4 bg-green-200 text-green-800 rounded"><?php echo $success_message; ?></div>
            <?php elseif (!empty($error_message)): ?>
                <p class="text-red-600 text-center font-semibold"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="POST" class=" space-y-10 ">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block mb-1 text-sm font-medium">Course Title</label>
                        <input id="title" type="text" name="title" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Course Title">
                    </div>
                    <div>
                        <label for="class" class="block mb-1 text-sm font-medium">Class</label>
                        <input id="class" type="text" name="class" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Class">
                    </div>
                    <div>
                        <label for="instructor_name" class="block mb-1 text-sm font-medium">Instructor Name</label>
                        <select id="instructor_name" type="text" name="instructor_name" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Mentor Name">
                            <?php if ($mentors->num_rows > 0): ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                                    <?php while ($mentor = $mentors->fetch_assoc()): ?>
                                        <option  value="<?= $mentor['name'] ?>"><?=  ($mentor['name']) ?></option>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-indigo-700 text-lg mt-10">No mentors found.</p>
                            <?php endif; ?>

                        </select>
                    </div>
                    <div>
                        <label for="total_lectures" class="block mb-1 text-sm font-medium">Total Lectures</label>
                        <input id="total_lectures" type="number" name="total_lectures" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Total Lectures">
                    </div>
                    <div>
                        <label for="duration" class="block mb-1 text-sm font-medium">Duration</label>
                        <input id="duration" type="text" name="duration" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Duration">
                    </div>
                    <div>
                        <label for="level" class="block mb-1 text-sm font-medium">Level</label>
                        <select id="level" name="level" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full">
                            <option value="" disabled selected hidden>Select Level</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>
                    <div>
                        <label for="language" class="block mb-1 text-sm font-medium">Language</label>
                        <input id="language" type="text" name="language" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Language">
                    </div>
                    <div>
                        <label for="price" class="block mb-1 text-sm font-medium">Price</label>
                        <input id="price" type="number" step="0.01" name="price" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Price">
                    </div>
                    <div>
                        <label for="thumbnail" class="block mb-1 text-sm font-medium">Thumbnail URL</label>
                        <input id="thumbnail" type="url" name="thumbnail" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full" placeholder="Thumbnail URL">
                    </div>
                    <div>
                        <label for="status" class="block mb-1 text-sm font-medium">Status</label>
                        <select id="status" name="status" required class="py-2 px-4 border bg-white border-[#9C4DF4]/30 rounded w-full">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="description" class="block mb-1 text-sm font-medium">Description</label>
                    <textarea id="description" name="description" required class="py-2 w-full px-4 h-32 bg-white border border-[#9C4DF4]/30 rounded-lg" placeholder="Enter Description"></textarea>
                </div>

                <input type="submit" name="submit" class="bg-[#9C4DF4] rounded cursor-pointer text-white font-semibold py-3 w-full" value="Add Course">
            </form>

        </div>
    </section>
</body>

</html>