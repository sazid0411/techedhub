<?php session_start(); ?>
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
                <h1 class="font-nunito text-4xl font-medium">Welcome, Amanda</h1>
                <p class="text-[#ADA7A7]">Tue, 07 June 2022</p>
            </div>
            <a href="../User/logout.php"
                class="bg-red-400 font-medium text-white px-8 py-2 rounded-lg cursor-pointer hidden md:block">
                Logout
            </a>

        </div>
        <div
            class="h-[60px] rounded-2xl bg-[linear-gradient(0deg,_rgba(227,145,230,0.88)_0%,_rgba(148,187,233,1)_100%)] opacity-50">
        </div>

        <div class="mt-10 flex items-center justify-between ">
            <div class="p-2 flex items-center gap-6 ">
                <img src="../assets/boy-bg.png" alt="" class="w-[90px] h-[90px] rounded-[50%]">
                <div class="">
                    <h1 class="font-bold text-2xl">Alexa Rawles</h1>
                    <p class="text-[#000000]">alexarawles@gmail.com</p>
                </div>
            </div>
            <div>
                <button onclick="openEdit()" href="../User/registration.php"
                    class="bg-[#9C4DF4] font-medium text-white px-8 py-2 rounded-lg cursor-pointer hidden md:block">
                    Edit <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
        </div>
        <div class="container  mx-auto p-6 ">
            <div class="relative">
                <form action="" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2  mt-3">
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                First Name
                            </label>
                            <input disabled type="text" value="Sazid" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Last Name
                            </label>
                            <input disabled type="text" value="Ahamed" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Email
                            </label>
                            <input disabled type="text" value="sazidahamed04@gmail.com" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Phone
                            </label>
                            <input disabled type="text" value="0123456789" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Date Of Birth
                            </label>
                            <input disabled type="text" value="04-11-2002" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Gender
                            </label>
                            <input disabled type="text" value="Male" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>



                </form>


            </div>
        </div>








        <div id="editModal"
            class="max-w-[900px] hidden   h-[70vh] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-6 rounded-2xl  border bg-[#EFEBF5]">
            <div class="space-y-3">
                <h1 class="text-2xl font-bold text-center">
                    Update User Details.
                </h1>
                <p class="text-xl  text-center text-gray-400">Please Fill the form to update details</p>
            </div>
            <div class="relative">
                <form action="" class="space-y-4">
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
                            <input type="text" placeholder="Enter first name" name="first-name"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Email
                            </label>
                            <input type="text" placeholder="Enter first name" name="first-name"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Phone
                            </label>
                            <input type="text" placeholder="Enter first name" name="first-name"
                                class="max-w-[350px] p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Date Of Birth
                            </label>
                            <input type="date" placeholder="Enter first name" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3">
                            <label for="first-name" class="text-lg px-2">
                                Gender
                            </label>
                            <select name="gender" id="" class="w-full p-3 border-2 border-gray-300 rounded-lg">
                                <option value="Select Gender">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start justify-center gap-2 p-3 col-span-2">
                            <label for="first-name" class="text-lg px-2">
                                Profile Image
                            </label>
                            <input type="file" placeholder="Enter first name" name="first-name"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <div class="flex items-center justify-center px-3">
                        <input type="submit" value="Update Profile"
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