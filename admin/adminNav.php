<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/1b37f18062.js" crossorigin="anonymous"></script>
</head>

<!-- Header -->
<header class=" bg-white font-nunito font-black">
    <nav class=" max-w-[1280px] mx-auto flex justify-between items-center px-4 py-5   ">
        <h1 class="text-3xl font-[700]">
            <a href="./addCourse.php">Tech<span class="text-[#9C4DF4]">Ed</span>Hub. <span class="text-red-400">Admin</span></a>
        </h1>
        <div class="hidden md:block">
            <ul class="flex items-center justify-between gap-6 font-medium ">
                <li><a href="./addCourse.php" class="hover:text-[#9C4DF4] text-lg navBtn">Add Course</a></li>
                <li><a href="./addvideo.php" class="hover:text-[#9C4DF4] text-lg navBtn">Add Video</a></li>
                <li><a href="./addmentor.php" class="hover:text-[#9C4DF4] text-lg navBtn">Add Mentors</a></li>
                <li><a href="./allCourse.php" class="hover:text-[#9C4DF4] text-lg  navBtn">All Course</a></li>
                <li><a href="./allStudent.php" class="hover:text-[#9C4DF4] text-lg navBtn"> Students</a></li>
                <li><a href="./mentor.php" class="hover:text-[#9C4DF4] text-lg navBtn"> Mentors</a></li>
            </ul>
        </div>


        <div class="md:hidden p-2 cursor-pointer">
            <i id="menuBtn" class="  fa-solid fa-bars text-2xl cursor-pointer"></i>
        </div>

        <!-- Mobile Menu  -->
        <div id="menu"
            class="absolute bg-gray-100 right-0 top-10 rounded-lg w-[250px] p-6 space-y-3 hidden md:hidden">
            <ul class="text-right pr-2">
                <li><a href="./addCourse.php" class="hover:text-[#9C4DF4]  navBtn">Add Course</a></li>
                <li><a href="./addvideo.php" class="hover:text-[#9C4DF4]  navBtn">Add Video</a></li>
                <li><a href="./allCourse.php" class="hover:text-[#9C4DF4]   navBtn">All Course</a></li>
                <li><a href="./addmentor.php" class="hover:text-[#9C4DF4] text-lg navBtn">Add Mentors</a></li>
                <li><a href="./allStudent.php" class="hover:text-[#9C4DF4]  navBtn">All Student</a></li>
                <li><a href="./mentor.php" class="hover:text-[#9C4DF4]  navBtn">All Mentors</a></li>
            </ul>
            <div class="flex justify-end gap-4">

            </div>
        </div>



        </div>
        </div>
    </nav>
    <script src="../JS/script.js"></script>
</header>