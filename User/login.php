<?php
session_start();
require "../component/db_conn.php";

$email = $password = $msg = "";
$emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

  if (empty($_POST['email'])) {
    $emailErr = "Email field cannot be empty";
  } else {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  }
  if (empty($_POST['pass'])) {
    $passwordErr = "Password field cannot be empty";
  } else {
    $password = trim($_POST['pass']);
  }

  if (empty($emailErr) && empty($passwordErr)) {
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($user_id, $db_email, $db_password);
      $stmt->fetch();

      if (password_verify($password, $db_password)) {
        header("Location: home.php");
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $db_email;
        $_SESSION['logged_in'] = true;

        // header("Location: home.php");
        exit();

        exit();
      } else {
        $msg = "Invalid Password!";
      }
    } else {
      $msg = "User not found!";
    }
    $stmt->close();
  }
}
?>


<html lang="en" data-theme="light">
<?php require "../component/all_link.php" ?>

<head>
  <title>TechEdHub Login</title>
</head>

<body class="bg-[#5D5A6F]">
  <?php include "../component/head.php" ?>
  <main class="font-nunito md:h-[90vh] flex items-center justify-center mt-4 md:mt-0 p-6">
    <div class="md:w-[1060px] bg-white shadow-2xl rounded-2xl  md:px-[88px]  p-4 md:py-[105px]">
      <div class="flex flex-col md:flex-row items-center justify-evenly">
        <div class=" flex flex-col items-start gap-2 ">
          <h1 class="text-xl font-bold ">TechEdHub.</h1>
          <h1 class=" text-3xl md:text-4xl font-bold">
            Welcome to <br />
            Tech<span class="text-[#9C4DF4]">Ed</span>Hub Online <br />
            Learning Platform
          </h1>
          <img src="../assets/log-bg.png" alt="" class="w-[80%]  " />
        </div>
        <div class="h-[50vh] w-[2px] bg-gray-400 hidden md:block"></div>

        <div class="max-w-[370px]">
          <form method="post" class=" w-[370px] flex flex-col items-center justify-center   gap-4">

            <div class="">
              <p class="w-full  text-xl font-bold"> <?php echo $msg; ?> </p>
            </div>

            <div class="w-full">
              <label for="" class="my-2">Email</label>

              <div class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" id="" require placeholder="users@example.com"
                  class="border-none focus:outline-0 w-full" />
              </div>
            </div>

            <div class="w-full">
              <label for="" class="my-2">Password</label>
              <div class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="pass" id="" require placeholder="*************"
                  class="border-none focus:outline-0 w-full" />
              </div>
            </div>

            <div class="w-full flex flex-col gap-2">
              <input name="submit" type="submit" value="Sign In"
                class="bg-[#9C4DF4] p-3 rounded-xl w-full text-white font-medium cursor-pointer" />
              <div class="w-full flex justify-between">
                <div class="flex items-center gap-1">
                  <input type="checkbox" name="keep" id="keep" />
                  <label for="keep" class="text-[#5D5A6F] font-medium">Keep me signed in.</label>
                </div>
                <a href="" class="text-[#5D5A6F] font-medium">Forgot password?</a>
              </div>
            </div>

          </form>
          <p class="text-center text-lg font-medium py-2">
            Already have account?
            <a href="../User/registration.php" class="text-[#9C4DF4] font-bold">Sign Up</a>
          </p>
        </div>
      </div>
    </div>
  </main>
  <?php include "../component/footer.php" ?>
</body>


</html>