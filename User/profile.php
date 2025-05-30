<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require "../component/db_conn.php";

$first_name_db = $last_name_db = $phone_db = $dob_db = $gender_db = $image_db = "";

$email_db = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email_db);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $first_name_db = $row['first_name'];
    $last_name_db  = $row['last_name'];
    $email_db      = $row['email'];
    $phone_db      = $row['phone'];
    $dob_db        = $row['dob'];
    $gender_db     = $row['gender'];
    $image_db      = $row['profile_image'];
}

// Show alert message after redirect (flash message)
if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}');</script>";
    unset($_SESSION['message']);
}

// Update profile on POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $session_email = $_SESSION['email'];
    $first_name = trim($_POST['first-name'] ?? '');
    $last_name  = trim($_POST['last-name'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $dob        = trim($_POST['dob'] ?? '');
    $gender     = trim($_POST['gender'] ?? '');
    $profile_image = trim($_POST['profile-image'] ?? '');

    $sql = "UPDATE users SET first_name=?, last_name=?, phone=?, dob=?, gender=?, profile_image=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $phone, $dob, $gender, $profile_image, $session_email);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile Updated Successfully";
    } else {
        $_SESSION['message'] = "Update Failed: " . $stmt->error;
    }

    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require "../component/all_link.php" ?>

<head>
    <title>TechEdHub</title>
</head>

<body class="font-nunito">
    <?php require "../component/head.php" ?>

    <section class="max-w-[1280px] mx-auto relative">

        <div class="flex justify-between items-center">
            <div class="py-8 px-6">
                <h1 class="font-nunito text-4xl font-medium">
                    Welcome, <?php
                    echo empty($first_name_db) ? "" :  ($first_name_db . " " . $last_name_db);
                    ?>
                </h1>
                <p class="text-[#ADA7A7]"><?php echo date("D, d F Y"); ?></p>
            </div>
            <a href="../User/logout.php"
                class="bg-red-400 font-medium text-white px-8 py-2 rounded-lg cursor-pointer hidden md:block">
                Logout <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>

        <div
            class="h-[60px] rounded-2xl bg-[linear-gradient(0deg,_rgba(227,145,230,0.88)_0%,_rgba(148,187,233,1)_100%)] opacity-50">
        </div>

        <div class="mt-10 flex items-center justify-between">
            <div class="p-2 flex items-center gap-6">
                <img src="<?=  ($image_db) ?  ($image_db) : '../assets/def.avif'; ?>"
                    alt="Profile Image" class="w-[90px] h-[90px] rounded-[50%]">
                <div>
                    <h1 class="font-bold text-2xl">
                        <?= empty($first_name_db) ? "Update Your Name" :  ($first_name_db . " " . $last_name_db) ?>
                    </h1>
                    <p class="text-[#000000]"><?=  ($email_db) ?></p>
                </div>
            </div>
            <div>
                <button onclick="openEdit()"
                    class="bg-[#9C4DF4] font-medium text-white px-8 py-2 rounded-lg cursor-pointer hidden md:block">
                    Update <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
        </div>

        <div class="container mx-auto p-6">
            <div class="relative">
                <form action="" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 mt-3">
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">First Name</label>
                            <input disabled type="text" value="<?=  ($first_name_db) ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="last-name" class="text-lg px-2">Last Name</label>
                            <input disabled type="text" value="<?=  ($last_name_db) ?>" name="last-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="email" class="text-lg px-2">Email</label>
                            <input disabled type="text" value="<?=  ($email_db) ?>" name="email"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="phone" class="text-lg px-2">Phone</label>
                            <input disabled type="text" value="<?=  ($phone_db) ?>" name="phone"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="dob" class="text-lg px-2">Date Of Birth</label>
                            <input disabled type="text" value="<?=  ($dob_db) ?>" name="dob"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="gender" class="text-lg px-2">Gender</label>
                            <input disabled type="text" value="<?=  ($gender_db) ?>" name="gender"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="editModal"
            class="max-w-[900px] hidden h-[70vh] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-6 rounded-2xl border bg-[#EFEBF5]">
            <div class="space-y-3">
                <h1 class="text-2xl font-bold text-center">Update User Details.</h1>
                <p class="text-xl text-center text-gray-400">Please fill the form to update details</p>
            </div>
            <div class="relative">
                <form method="post" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 mt-3">
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">First Name</label>
                            <input type="text" placeholder="Enter first name" name="first-name" required
                                value="<?=  ($first_name_db) ?>"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="last-name" class="text-lg px-2">Last Name</label>
                            <input type="text" placeholder="Enter last name" name="last-name" required
                                value="<?=  ($last_name_db) ?>"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="email" class="text-lg px-2">Email</label>
                            <input disabled type="email" name="email" value="<?=  ($email_db) ?>"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="phone" class="text-lg px-2">Phone</label>
                            <input type="tel" placeholder="Enter phone number" name="phone"
                                value="<?=  ($phone_db) ?>"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="dob" class="text-lg px-2">Date Of Birth</label>
                            <input type="date" name="dob" value="<?=  ($dob_db) ?>"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="gender" class="text-lg px-2">Gender</label>
                            <select name="gender" class="w-full p-3 border-2 border-gray-300 rounded-lg">
                                <option value="Male" <?= $gender_db === "Male" ? "selected" : "" ?>>Male</option>
                                <option value="Female" <?= $gender_db === "Female" ? "selected" : "" ?>>Female</option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3 col-span-2">
                            <label for="profile-image" class="text-lg px-2">Profile Image URL</label>
                            <input type="url" placeholder="Enter Profile Image URL" name="profile-image"
                                value="<?=  ($image_db) ?>"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <div class="flex items-center justify-center px-3">
                        <input type="submit" value="Update Profile" name="submit"
                            class="col-span-2 bg-[#9C4DF4] p-3 rounded-xl text-white font-medium cursor-pointer w-full">
                    </div>
                </form>
            </div>
            <div onclick="closeEdit()" class="absolute top-10 right-10 cursor-pointer">
                <i class="fa fa-times text-2xl cursor-pointer"></i>
            </div>
        </div>

    </section>

    <?php include "../component/footer.php" ?>

    <!-- <script>
        function openEdit() {
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEdit() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script> -->

    <script src="../JS/edit.js"></script>

</body>

</html>
