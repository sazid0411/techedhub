<?php
require '../component/db_conn.php';

// Delete student if `delete_id` is sent via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: allStudent.php");
    exit();
}

// Fetch all students
$sql = "SELECT id, first_name, last_name, email, profile_image FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<?php require '../component/all_link.php'; ?>

<head>
    <title>All Students | TechEdHub</title>
</head>

<body class="bg-[#F4F4F4] font-nunito">
    <?php include './adminNav.php'; ?>

    <main class="min-h-screen p-8">
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl p-6">
            <h2 class="text-3xl font-bold mb-6 text-[#5D5A6F]">All Registered Students</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-xl">
                    <thead class="bg-[#9C4DF4] text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Profile</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b">
                                    <td class="py-2 px-4">
                                        <img src="<?= $row['profile_image'] ? $row['profile_image'] : '../assets/def.avif'; ?>"
                                            alt="Profile"
                                            class="w-10 h-10 rounded object-cover " />
                                    </td>
                                    <td class="py-2 px-4"><?=  ($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                    <td class="py-2 px-4"><?=  ($row['email']); ?></td>
                                    <td class="py-2 px-4">
                                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">No students found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../component/footer.php'; ?>
</body>

</html>