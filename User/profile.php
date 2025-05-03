<?php
session_start();
require "../component/db_conn.php"; // Ensure you include your DB connection here



$first_name_db = $last_name_db = $phone_db = $dob_db = $gender_db = $image_db = "";

$email_db = $_SESSION['email'];

$sql = "SELECT * FROM profile WHERE email = ?";
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $session_email = $_SESSION['email'];
    $first_name = $_POST['first-name'] ?? '';
    $last_name  = $_POST['last-name'] ?? '';
    $phone      = $_POST['phone'] ?? '';
    $dob        = $_POST['dob'] ?? '';
    $gender     = $_POST['gender'] ?? '';
    $profile_image = $image_db;


    $check = $conn->prepare("SELECT id FROM profile WHERE email = ?");
    $check->bind_param("s", $session_email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        $insert = $conn->prepare("INSERT INTO profile (email) VALUES (?)");
        $insert->bind_param("s", $session_email);
        $insert->execute();
        $insert->close();
    }
    $check->close();

    if (isset($_FILES["profile-image"]) && $_FILES["profile-image"]["error"] === 0) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["profile-image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid("IMG_", true) . "." . $imageFileType;
        $target_file = $target_dir . $new_filename;

        $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if ($check !== false && in_array($imageFileType, $allowedTypes)) {
            if ($_FILES["profile-image"]["size"] <= 2000000) {
                if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file)) {
                    $profile_image = $target_file;
                } else {
                    echo "Image upload failed.";
                }
            } else {
                echo "Image too large.";
            }
        } else {
            echo "Invalid image file.";
        }
    }

    $sql = "UPDATE profile SET first_name=?, last_name=?, phone=?, dob=?, gender=?, profile_image=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $phone, $dob, $gender, $profile_image, $session_email);

    if ($stmt->execute()) {
        echo '<script>alert("Profile Updated Successfully");</script>';
    } else {
        echo '<script>alert("Update Failed: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<?php require  "../component/all_link.php" ?>

<head>
    <title>TechEdHub</title>
</head>

<body class="font-nunito">
    <?php require "../component/head.php" ?>


    <section class="max-w-[1280px] mx-auto relative">

        <div class="flex  justify-between items-center">
            <div class="py-8 px-6">
                <h1 class="font-nunito text-4xl font-medium">Welcome, <?php if (empty($first_name_db)) {
                                                                            echo "";
                                                                        } else {
                                                                            echo $first_name_db . " " . $last_name_db;
                                                                        } ?></h1>
                <p class="text-[#ADA7A7]"><?php
                                            echo date("D, d F Y");
                                            ?>
                </p>
            </div>
            <a href="../User/logout.php"
                class="bg-red-400 font-medium text-white px-8 py-2 rounded-lg cursor-pointer hidden md:block">
                Logout <i class="fa-solid fa-right-from-bracket"></i>
            </a>

        </div>

        <!--  -->
        <div
            class="h-[60px] rounded-2xl bg-[linear-gradient(0deg,_rgba(227,145,230,0.88)_0%,_rgba(148,187,233,1)_100%)] opacity-50">
        </div>
        <!--  -->
        <div class="mt-10 flex items-center justify-between ">
            <div class="p-2 flex items-center gap-6 ">
                <img src="<?php echo "uploads/".$image_db; ?>" alt="" class="w-[90px] h-[90px] rounded-[50%]">
                <div class="">
                    <h1 class="font-bold text-2xl"><?php if (empty($first_name_db)) {
                                                        echo "Update Your Name";
                                                    } else {
                                                        echo $first_name_db . " " . $last_name_db;
                                                    } ?></h1>
                    <p class="text-[#000000]"><?php echo $email_db ?></p>
                </div>
            </div>
            <div>
                <button onclick="openEdit()" href="../User/registration.php"
                    class="bg-[#9C4DF4] font-medium text-white px-8 py-2 rounded-lg cursor-pointer hidden md:block">
                    Update <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
        </div>
        <!--  -->
        <div class="container  mx-auto p-6 ">
            <div class="relative">
                <form action="" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2  mt-3">
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                First Name
                            </label>
                            <input disabled type="text" value="<?php echo $first_name_db; ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Last Name
                            </label>
                            <input disabled type="text" value="<?php echo $last_name_db; ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Email
                            </label>
                            <input disabled type="text" value="<?php echo $email_db; ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Phone
                            </label>
                            <input disabled type="text" value="<?php echo $phone_db; ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Date Of Birth
                            </label>
                            <input disabled type="text" value="<?php echo $dob_db; ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Gender
                            </label>
                            <input disabled type="text" value="<?php echo $gender_db; ?>" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>



                </form>


            </div>
        </div>
        <!--  -->
        <div id="editModal"
            class="max-w-[900px] hidden   h-[70vh] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-6 rounded-2xl  border bg-[#EFEBF5]">
            <div class="space-y-3">
                <h1 class="text-2xl font-bold text-center">
                    Update User Details.
                </h1>
                <p class="text-xl  text-center text-gray-400">Please Fill the form to update details</p>
            </div>
            <div class="relative">
                <form method="post" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2  mt-3">
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                First Name
                            </label>
                            <input type="text" placeholder="Enter first name" name="first-name"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Last Name
                            </label>
                            <input type="text" placeholder="Enter first name" name="last-name"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Email
                            </label>
                            <input disabled type="email" placeholder="Enter first name" name="email"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Phone
                            </label>
                            <input type="number" placeholder="Enter first name" name="phone"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Date Of Birth
                            </label>
                            <input type="date" placeholder="Enter first name" name="dob"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Gender
                            </label>
                            <select name="gender" id="" class="w-full p-3 border-2 border-gray-300 rounded-lg">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3 col-span-2">
                            <label for="first-name" class="text-lg px-2">
                                Profile Image
                            </label>
                            <input type="file" placeholder="Enter first name" name="profile-image"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <div class="flex items-center justify-center px-3">
                        <input type="submit" value="Update Profile" name="submit"
                            class="col-span-2 bg-[#9C4DF4] p-3 rounded-xl  text-white font-medium cursor-pointer w-full   ">
                    </div>


                </form>


            </div>
            <div onclick="closeEdit()" class="absolute top-10 right-10 cursor-pointer ">
                <i onclick="closeEdit()" class="fab fa-x text-2xl cursor-pointer"></i>
            </div>
        </div>

    </section>

    <?php include "../component/footer.php" ?>

    <script src="../JS/edit.js"></script>

</body>