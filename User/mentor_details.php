<?php
require '../component/db_conn.php';

$mentor_id = (int)($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM mentors WHERE id = ?");
$stmt->bind_param("i", $mentor_id);
$stmt->execute();
$mentor = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mentor Details</title>
    <?php require "../component/all_link.php"; ?>
</head>

<body class="bg-[#EFEBF5] min-h-screen">
    <?php require '../component/head.php'; ?>


    <main class="max-w-[1280px] mx-auto mt-10 p-8 bg-white rounded-3xl shadow-xl">
        <?php if ($mentor): ?>

            <div class="grid grid-cols-4 gap-10 items-center  py-8">
                <div class="flex items-center justify-center">
                    <img src="<?=  ($mentor['image_url']) ?>" alt="Mentor Image"
                        class="  mx-auto rounded object-cover border-4 border-indigo-300 shadow-md mb-4">
                </div>
                <div class="">
                    <h1 class="text-3xl font-bold text-indigo-900"><?=  ($mentor['name']) ?></h1>
                    <p class="text-lg text-gray-600 mt-1"><?=  ($mentor['designation']) ?></p>
                    <p class="text-md italic text-gray-700"><?=  ($mentor['expertise']) ?></p>
                    <p class="mt-4 text-indigo-700 font-medium"> @<?=  ($mentor['email']) ?></p>
                </div>
            </div>



        <?php else: ?>
            <p class="text-center text-red-600 text-lg">Mentor not found.</p>
        <?php endif; ?>
    </main>
</body>

</html>