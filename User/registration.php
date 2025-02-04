<?php
require "../component/db_conn.php";

$name = $email = $password =  $msg ="";
$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        if (empty($_POST['name'])) {
            $nameErr = "Name field cannot be empty";
        } else {
            $name = $_POST['name'];
        }

        if (empty($_POST['email'])) {
            $emailErr = "Email field cannot be empty";
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['pass'])) {
            $passwordErr = "Password field cannot be empty";
            
        } else {
            $password = password_hash($_POST['pass'], PASSWORD_DEFAULT); 
        }

        if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
            $sql  = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt ->bind_param("sss", $name, $email, $password);
            
            if ($stmt->execute()) {
                $msg = "Registration Successful.";
            } else {
                $msg = "Error: " . $stmt->error;
            }
            
            $stmt->close();
        }
    }
}
?>



<html lang="en" data-theme="light">
  <?php require "../component/all_link.php" ?>
  <head>
    <title>TechEdHub Registration</title>
  </head>

  <body class="bg-[#5D5A6F]">
    <?php require "../component/head.php" ?>
    <main
      class="font-nunito md:h-[90vh] flex items-center justify-center mt-4 md:mt-0 p-6">
      <div
        class="md:w-[1060px] bg-white shadow-2xl rounded-2xl  md:px-[88px]  p-4 md:py-[105px]"
      >
        <div class="flex flex-col md:flex-row items-center justify-evenly">
          <div class=" flex flex-col items-start gap-2 ">
            <h1 class="text-xl font-bold ">TechEdHub</h1>
            <h1 class=" text-3xl md:text-4xl font-bold">
              Welcome  to <br />
              Tech<span class="text-[#9C4DF4]">Ed</span>Hub Online <br />
              Learning Platform
            </h1>
            <img src="../assets/log-bg.png" alt="" class="w-[80%]  " />
          </div>
          <div class="h-[50vh] w-[2px] bg-gray-400 hidden md:block"></div>

          <div class="max-w-[370px]">
            <form
              method="post"
              class=" w-[370px] flex flex-col items-center justify-center   gap-4"
            >

            <div class=""> 
              <p class="w-full  text-xl font-bold"><?php echo $msg;  ?></p>
             
            </div>

            <div class="w-full">
                <label for="" class="my-2">Full Name</label>

                <div
                  class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4"
                >
                  <i class="fa-solid fa-user"></i>
                  <input
                    type="text"
                    name="name"
                    id=""
                    require
                    placeholder="Sazid Ahamed Sifat"
                    class="border-none focus:outline-0 "
                  />
                </div>
              </div>
              <div class="w-full">
                <label for="" class="my-2">Email</label>

                <div
                  class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4"
                >
                  <i class="fa-solid fa-envelope"></i>
                  <input
                    type="email"
                    name="email"
                    id=""
                    require
                    placeholder="users@example.com"
                    class="border-none focus:outline-0 w-full"
                  />
                </div>
              </div>

              <div class="w-full">
                <label for="" class="my-2">Password</label>
                <div
                  class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4"
                >
                  <i class="fa-solid fa-lock"></i>
                  <input
                    type="password"
                    name="pass"
                    id=""
                    require
                    placeholder="*************"
                    class="border-none focus:outline-0 w-full"
                  />
                </div>
              </div>

              <div class="w-full flex flex-col gap-2">
                <input
                name="submit"
                  type="submit"
                  value="Sign Up"
                  id="btn"
                  class="bg-[#9C4DF4] p-3 rounded-xl w-full text-white font-medium cursor-pointer"
                />
              </div>
            </form>
            <p class="text-center text-lg font-medium py-2">
              Already have account?
              <a href="../User/login.php" class="text-[#9C4DF4] font-bold">Sign In</a>
            </p>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
