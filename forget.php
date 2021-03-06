<?php
if(isset($_GET['errors'])){
  $errors=json_decode($_GET['errors']);
}

$allowUsers=[];
include('./authGuard.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css'/>
</head>
<body>
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <!-- <img class="mx-auto h-12 w-auto" src="coffee-cup-svgrepo-com.svg" alt="Workflow"> -->
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Password Recovery </h2>
    </div>
    <form class="mt-8 space-y-6" action="forgetvalid.php" method="POST">
      <input type="hidden" name="remember" value="true">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="text" autocomplete="email"  class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
          <label class="font-normal font-sans italic ">
            <?php
              if(isset($errors->email)){
                  echo "<p style='color:red'>$errors->email</p>";
              }
            ?>
        </label>
        <label class="font-normal font-sans italic ">
            <?php
              if(isset($errors->emailN)){
                  echo "<p style='color:red'>$errors->emailN</p>";
              }
            ?>
        </label>
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password"  class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
          <label class="font-normal font-sans italic ">
            <?php
              if(isset($errors->password)){
                  echo "<p style='color:red'>$errors->password</p>";
              }
            ?>
        </label>
        </div>
        <div>
          <label for="password" class="sr-only">Confirm Password</label>
          <input id="password" name="cpassword" type="password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
          <label class="font-normal font-sans italic ">
            <?php
              if(isset($errors->cpassword)){
                  echo "<p style='color:red'>$errors->cpassword</p>";
              }
            ?>
        </label>
        <label class="font-normal font-sans italic ">
            <?php
              if(isset($errors->cpasss)){
                  echo "<p style='color:red'>$errors->cpasss</p>";
              }
            ?>
        </label>
        </div>
      </div>

      <div class="flex items-center justify-between">


        <div class="text-sm">
            <p class="font-light text-indigo-600 hover:text-indigo-500">Remember your password ?</p>
          <a href="sign_in.php"class="font-medium text-indigo-600 no-underline  hover: underline text-indigo-500 ">sign in</a>
        </div>
      </div>

      <div>
        <button type="submit" name="update" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <!-- Heroicon name: solid/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </span>
          Update 
        </button>
      </div>
    </form>
  </div>
</div>
<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
</body>
</html>