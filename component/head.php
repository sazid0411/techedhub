
  <?php require "../component/all_link.php" ?>


    <!-- Header -->
    <header class=" bg-white font-nunito font-black">
      <nav class=" max-w-[1280px] mx-auto flex justify-between items-center px-4 py-5   ">
        <h1 class="text-3xl font-[700]">
          <a href="#">Tech<span class="text-[#9C4DF4]">Ed</span>Hub.</a>
        </h1>
      <div class="hidden md:block">
      <ul class="flex items-center justify-between gap-6 font-medium " >
          <li><a href="" class="hover:text-[#9C4DF4]">Home</a></li>
          <li><a href="" class="hover:text-[#9C4DF4]">Course</a></li>
          <li><a href="" class="hover:text-[#9C4DF4]">Mentors</a></li>
          <li><a href="" class="hover:text-[#9C4DF4]">Contact</a></li>
        </ul>
      </div>

        <div class="flex gap-3">
          <button
            class="border border-[#9C4DF4] font-medium text-black px-3.5 py-2 rounded-lg cursor-pointer hidden md:block"
          >
            <a href="../User/login.php">Sign In</a>
          </button>
          <button
            class="bg-[#9C4DF4] font-medium text-white px-3.5 py-2 rounded-lg cursor-pointer hidden md:block"
          >
            <a href="../User/registration.php">Sign Up</a>
          </button>
         <div class="md:hidden ">
         <i class="  fa-solid fa-bars text-2xl"></i>
         </div>
        </div>
      </nav>
    </header>