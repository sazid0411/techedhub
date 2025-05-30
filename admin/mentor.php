<?php
require '../component/db_conn.php';

$mentors = $conn->query("SELECT * FROM mentors");

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM mentors WHERE id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mentor List</title>
    <?php require "../component/all_link.php"; ?>
</head>

<body class="bg-[#EFEBF5]">

    <?php require './adminNav.php'; ?>

    <main class="max-w-[1280px] mx-auto p-10">
        <h1 class="text-4xl font-bold text-center text-indigo-900 mb-10">All Mentors</h1>

        <?php if ($mentors->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-xl shadow-md border border-indigo-200">
                    <thead class="bg-indigo-100 text-indigo-800 font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left">Image</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Designation</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($mentor = $mentors->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-indigo-50">
                                <td class="px-6 py-4">
                                    <img src="<?= htmlspecialchars($mentor['image_url']) ?>" alt="Image" class="w-12 h-12 rounded-full object-cover border border-indigo-300">
                                </td>
                                <td class="px-6 py-4 font-medium text-indigo-900"><?= htmlspecialchars($mentor['name']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($mentor['designation']) ?></td>
                                <td class="px-6 py-4 text-sm text-indigo-700"><?= htmlspecialchars($mentor['email']) ?></td>
                                <td class="px-6 py-4 text-center space-x-2">

                                    <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this mentor?');">
                                        <input type="hidden" name="delete_id" value="<?= $mentor['id'] ?>">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-indigo-700 text-lg mt-10">No mentors found.</p>
        <?php endif; ?>
    </main>

</body>

</html>