<?php //session_start() ?>
<head>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://kit.fontawesome.com/1b37f18062.js" crossorigin="anonymous"></script>
</head>

<!-- Header -->
<header class=" bg-white font-nunito font-black">
  <nav class=" max-w-[1280px] mx-auto flex justify-between items-center px-4 py-5   ">
    <h1 class="text-3xl font-[700]">
      <a href="../User/home.php">Tech<span class="text-[#9C4DF4]">Ed</span>Hub.</a>
    </h1>
    <div class="hidden md:block">
      <ul class="flex items-center justify-between gap-6 font-medium ">
        <li><a href="../User/home.php" class="hover:text-[#9C4DF4]">Home</a></li>
        <li><a href="../User/course.php" class="hover:text-[#9C4DF4]">Course</a></li>
        <li><a href="../User/mentors.php" class="hover:text-[#9C4DF4]">Mentors</a></li>
        <li><a href="../User/about.php" class="hover:text-[#9C4DF4]">About</a></li>
      </ul>
    </div>

    <div class="flex gap-3 relative">
      <div class="flex gap-3">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
          <a href="../User/profile.php"
            class="bg-[#9C4DF4] font-medium text-white px-3.5 py-2 rounded-lg cursor-pointer hidden md:block">
            Profile
          </a>
        <?php else: ?>
          <a href="../User/login.php"
            class="border border-[#9C4DF4] font-medium text-black px-3.5 py-2 rounded-lg cursor-pointer hidden md:block">
            Sign In
          </a>
          <a href="../User/registration.php"
            class="bg-[#9C4DF4] font-medium text-white px-3.5 py-2 rounded-lg cursor-pointer hidden md:block">
            Sign Up
          </a>
        <?php endif; ?>
      </div>
      <div class="md:hidden p-2 cursor-pointer">
        <i id="menuBtn" class="  fa-solid fa-bars text-2xl cursor-pointer"></i>
      </div>

      <!-- Mobile Menu  -->
      <div id="menu"
        class="absolute bg-gray-100 right-0 top-10 rounded-lg w-[250px] p-6 space-y-3 hidden md:hidden">
        <ul class="text-right pr-2">
          <li><a href="../User/home.php" class="hover:text-[#9C4DF4]">Home</a></li>
          <li><a href="../User/courses.php" class="hover:text-[#9C4DF4]">Course</a></li>
          <li><a href="../User/mentors.php" class="hover:text-[#9C4DF4]">Mentors</a></li>
          <li><a href="../User/about.php" class="hover:text-[#9C4DF4]">About</a></li>
        </ul>
        <div class="flex justify-end gap-4">
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="../User/profile.php"
              class="bg-[#9C4DF4] font-medium text-white px-3.5 py-2 rounded-lg cursor-pointer">
              Profile
            </a>
          <?php else: ?>
            <a href="../User/login.php"
              class="border border-[#9C4DF4] font-medium text-black px-3.5 py-2 rounded-lg cursor-pointer">
              Sign In
            </a>
            <a href="../User/registration.php"
              class="bg-[#9C4DF4] font-medium text-white px-3.5 py-2 rounded-lg cursor-pointer">
              Sign Up
            </a>
          <?php endif; ?>
        </div>
      </div>



    </div>
    </div>
  </nav>
  <script src="../JS/script.js"></script>
</header>