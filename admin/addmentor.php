<?php
require '../component/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $expertise = $_POST['expertise'];
    $email = $_POST['email'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("INSERT INTO mentors (name, designation, expertise, email, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $designation, $expertise, $email, $image_url);

    if ($stmt->execute()) {
        $success_message = "Mentor added successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Mentor</title>
    <?php require "../component/all_link.php"; ?>
</head>

<body class=" bg-[#EFEBF5] min-h-screen">
    <?php require './adminNav.php'; ?>

    <div class="bg-white p-10 rounded-3xl shadow-xl max-w-[1280px] mx-auto mt-10">
        <h1 class="text-3xl font-semibold text-center  mb-6">Add New Mentor</h1>

        <?php if (!empty($success_message)): ?>
            <p class="text-green-600 text-center font-semibold mb-4"><?= $success_message ?></p>
        <?php elseif (!empty($error_message)): ?>
            <p class="text-red-600 text-center font-semibold mb-4"><?= $error_message ?></p>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Mentor Name</label>
                    <input type="text" name="name" required placeholder="Full Name"
                        class="w-full px-4 py-2 border border-[#9C4DF4]/30 bg-white rounded-lg" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Designation</label>
                    <input type="text" name="designation" required placeholder="e.g. Senior Lecturer"
                        class="w-full px-4 py-2 border border-[#9C4DF4]/30 bg-white rounded-lg" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Education & Expertise</label>
                    <input type="text" name="expertise" required placeholder="e.g. Machine Learning, Web Dev"
                        class="w-full px-4 py-2 border border-[#9C4DF4]/30 bg-white rounded-lg" />
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" required placeholder="example@email.com"
                        class="w-full px-4 py-2 border border-[#9C4DF4]/30 bg-white rounded-lg" />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Image URL</label>
                    <input type="url" name="image_url" required placeholder="https://example.com/image.jpg"
                        class="w-full px-4 py-2 border border-[#9C4DF4]/30 bg-white rounded-lg" />
                </div>
            </div>

            <div>
                <input type="submit" name="submit"
                    class="w-full py-3 bg-[#9C4DF4] text-white font-semibold rounded-lg hover:bg-[#7f3de6] transition duration-300 cursor-pointer"
                    value="Add Mentor" />
            </div>
        </form>
    </div>
</body>

</html>