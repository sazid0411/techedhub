<?php
require '../component/db_conn.php';


$sql = "SELECT * FROM courses ORDER BY id DESC";
$result = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="en">
<?php require "../component/all_link.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Course</title>
</head>

<body class='max-w-[1280px] mx-auto'>
    <?php require './adminNav.php'; ?>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-[#EFEBF5] border border-[#9C4DF4] rounded-lg p-5 space-y-2 flex flex-col justify-between">
                    <img src="<?php echo ($row['thumbnail']); ?>" alt="Thumbnail" class="w-full h-40 object-cover rounded-lg border border-[#9C4DF4]">

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
                    <div class="w-full">
                        <a href="cd.php?id=<?php echo $row['id']; ?>"
                            class="mt-4 flex-1 inline-block text-center w-full bg-[#9C4DF4] text-white font-semibold py-2 px-4 rounded-lg  transition hover:bg-blue-700">
                            Details
                        </a>

                        <div class="flex gap-2 ">

                            <a href="update_course.php?id=<?php echo $row['id']; ?>"
                                class="mt-4 flex-1 inline-block text-center  bg-blue-400 text-white font-semibold py-2 px-4 rounded-lg  transition">
                                Update
                            </a>

                            <a onclick="openModal(<?php echo $row['id']; ?>)"

                                class="mt-4 flex-1 inline-block text-center bg-red-400 text-white font-semibold py-2 px-4 rounded-lg  transition">
                                Delete
                            </a>
                        </div>
                    </div>
                    <!-- Modal for delete confirmation -->
                    <div id="deleteModal" class="fixed inset-0 bg-gray-300 bg-opacity-10 flex items-center justify-center hidden z-50">
                        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-sm text-center space-y-4">
                            <h2 class="text-xl font-semibold text-red-400">Confirm Delete</h2>
                            <p class="text-gray-700">Are you sure you want to delete this course?</p>
                            <div class="flex justify-center gap-4">
                                <button onclick="closeModal()"
                                    class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">Cancel</button>
                                <a id="confirmDeleteBtn" href="#"
                                    class="px-4 py-2 rounded-lg bg-red-400 text-white hover:bg-red-500">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600">No courses found.</p>
    <?php endif; ?>

    <script>
        function openModal(courseId) {
            const modal = document.getElementById('deleteModal');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            confirmBtn.href = `delete_course.php?id=${courseId}`;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>

</html>