<html lang="en" data-theme="light">
  <?php require "../component/all_link.php" ?>
  <head>
    <title>TechEdHub Login</title>
  </head>

  <body class="bg-[#5D5A6F]">
    <?php require "../component/head.php" ?>
    <main
      class="font-nunito h-[90vh] flex items-center justify-center "
    >
      <div
        class="w-[1060px] bg-white shadow-2xl rounded-2xl px-[88px] py-[105px]"
      >
        <div class="flex items-center justify-between">
          <div class="flex flex-col items-start gap-2">
            <h1 class="text-xl font-medium">TechEdHub</h1>
            <h1 class="text-4xl font-bold">
              Welcome back to <br />
              TechEdHub Online <br />
              Learning Platform
            </h1>
            <img src="../assets/log-bg.png" alt="" />
          </div>
          <div class="h-[50vh] w-[2px] bg-gray-400"></div>
          <div>
            <form
              method="post"
              class="flex flex-col items-center justify-centerw-[370px] p-6 gap-4"
            >
              <div class="w-[370px]">
                <label for="">Email</label>

                <div
                  class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4"
                >
                  <i class="fa-solid fa-envelope"></i>
                  <input
                    type="email"
                    name=""
                    id=""
                    placeholder="users@example.com"
                    class="border-none focus:outline-0"
                  />
                </div>
              </div>

              <div class="w-[370px]">
                <label for="" class="my-2">Password</label>
                <div
                  class="flex items-center border border-[#DEDDE4] rounded-2xl p-3 gap-4"
                >
                  <i class="fa-solid fa-lock"></i>
                  <input
                    type="password"
                    name=""
                    id=""
                    placeholder="*************"
                    class="border-none focus:outline-0"
                  />
                </div>
              </div>

              <div class="w-full flex flex-col gap-2">
                <input
                  type="submit"
                  value="Sign In"
                  class="bg-[#9C4DF4] p-3 rounded-xl w-full text-white font-medium cursor-pointer"
                />
                <div class="flex justify-between">
                  <div class="flex items-center gap-1">
                    <input type="checkbox" name="keep" id="keep" />
                    <label for="keep" class="text-[#5D5A6F] font-medium"
                      >keep me signed in</label
                    >
                  </div>
                  <a href="" class="text-[#5D5A6F] font-medium"
                    >Forgot password?</a
                  >
                </div>
              </div>
            </form>
            <p class="text-center text-lg font-medium">
              Don't have account?
              <a href="../User/registration.php" class="text-[#9C4DF4] font-bold">Sign Up</a>
            </p>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
