<?php
require "../component/db_conn.php";

$f_name = $l_name = $email = $password = $msg = "";
$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $f_name = trim($_POST['f-name'] ?? '');
  $l_name = trim($_POST['l-name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass_raw = $_POST['pass'] ?? '';

  if (empty($f_name)) {
    $nameErr = "First name is required.";
  }

  if (empty($email)) {
    $emailErr = "Email is required.";
  }

  if (empty($pass_raw)) {
    $passwordErr = "Password is required.";
  } else {
    $password = password_hash($pass_raw, PASSWORD_DEFAULT);
  }

  if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
    $sql  = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $f_name, $l_name, $email, $password);

    if ($stmt->execute()) {
      header("Location: login.php");
      exit();
    } else {
      $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
  }
}

$conn->close();
?>

<html lang="en" data-theme="light">
<?php require "../component/all_link.php" ?>

<head>
  <title>TechEdHub Registration</title>
</head>

<body class="bg-[#5D5A6F]">
  <?php require "../component/head.php" ?>
  <main class="font-nunito md:h-[90vh] flex items-center justify-center mt-4 md:mt-0 p-6">
    <div class="md:w-[1060px] bg-white shadow-2xl rounded-2xl md:px-[88px] p-4 md:py-[105px]">
      <div class="flex flex-col md:flex-row items-center justify-evenly">
        <div class="flex flex-col items-start gap-2">
          <h1 class="text-xl font-bold">TechEdHub</h1>
          <h1 class="text-3xl md:text-4xl font-bold">
            Welcome to <br />
            Tech<span class="text-[#9C4DF4]">Ed</span>Hub Online <br />
            Learning Platform
          </h1>
          <img src="../assets/log-bg.png" alt="" class="w-[80%]" />
        </div>
        <div class="h-[50vh] w-[2px] bg-gray-400 hidden md:block"></div>

        <div class="max-w-[370px]">
          <form method="post" class="w-[370px] flex flex-col items-center justify-center gap-4">
            <?php if (!empty($msg)): ?>
              <p class="text-red-500 text-center"><?= $msg ?></p>
            <?php endif; ?>

            <!-- First Name -->
            <div class="w-full">
              <label for="" class="my-2">First Name</label>
              <div class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="f-name" value="<?=  ($f_name) ?>" required placeholder="Sazid"
                  class="border-none focus:outline-0 w-full" />
              </div>
              <p class="text-red-500 text-sm"><?= $nameErr ?></p>
            </div>

            <!-- Last Name -->
            <div class="w-full">
              <label for="" class="my-2">Last Name</label>
              <div class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="l-name" value="<?=  ($l_name) ?>" required placeholder="Ahamed"
                  class="border-none focus:outline-0 w-full" />
              </div>
            </div>

            <!-- Email -->
            <div class="w-full">
              <label for="" class="my-2">Email</label>
              <div class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" value="<?=  ($email) ?>" required
                  placeholder="users@example.com" class="border-none focus:outline-0 w-full" />
              </div>
              <p class="text-red-500 text-sm"><?= $emailErr ?></p>
            </div>

            <!-- Password -->
            <div class="w-full">
              <label for="" class="my-2">Password</label>
              <div class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="pass" required placeholder="*************"
                  class="border-none focus:outline-0 w-full" />
              </div>
              <p class="text-red-500 text-sm"><?= $passwordErr ?></p>
            </div>

            <!-- Submit -->
            <div class="w-full flex flex-col gap-2">
              <input name="submit" type="submit" value="Sign Up"
                class="bg-[#9C4DF4] p-3 rounded-xl w-full text-white font-medium cursor-pointer" />
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
  <?php include "../component/footer.php" ?>
</body>

</html>