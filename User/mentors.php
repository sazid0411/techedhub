<?php
require '../component/db_conn.php';

$mentors = $conn->query("SELECT * FROM mentors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Mentors</title>
    <?php require "../component/all_link.php"; ?>
</head>
<body class="bg-[#EFEBF5]">

<?php require '../component/head.php'; ?>

<main class="max-w-[1280px] mx-auto p-10">
    <h1 class="text-4xl font-bold text-center text-indigo-900 mb-12">Our Mentors</h1>

    <?php if ($mentors->num_rows > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php while ($mentor = $mentors->fetch_assoc()): ?>
                <div class="bg-white border border-indigo-200 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 p-6 text-center">
                    <img src="<?=  ($mentor['image_url']) ?>" alt="Mentor Image"
                         class="w-24 h-24 mx-auto rounded-full object-cover border-4 border-indigo-300 mb-4">
                    <h2 class="text-xl font-semibold text-indigo-900"><?=  ($mentor['name']) ?></h2>
                    <p class="text-sm text-gray-600 mb-1"><?=  ($mentor['designation']) ?></p>
                    <p class="text-sm text-gray-700 italic"><?=  ($mentor['expertise']) ?></p>
                    <p class="text-xs text-indigo-600 mt-2 mb-4"><?=  ($mentor['email']) ?></p>
                    <a href="mentor_details.php?id=<?= $mentor['id'] ?>"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Details
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-indigo-700 text-lg mt-10">No mentors found.</p>
    <?php endif; ?>
</main>

</body>
</html>
