<?php
    if (isset($_GET["errors"])){
        $errors = json_decode($_GET["errors"]);
        
        
    }
    if (isset($_GET["olddata"])){
        $olddata = json_decode($_GET["olddata"]);
    }
 
?>
<html>
<?php   require_once("navbar.php");
  ?>
<head>
  <meta charset="utf-8" />
  <title></title>
  <link rel='stylesheet' href='https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css'/> />
</head>
<body>
  <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9">
    <div class="formbg-outer">
      <div class="formbg">
        <div class="formbg-inner padding-horizontal--48">
          <span class="padding-bottom--15">Cafateria</span>
  </html>
<html>

<head>
  <meta charset="utf-8" />
  <title>php: cafateria</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

  <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9">
    <div class="formbg-outer">
      <div class="formbg">
        <div class="formbg-inner padding-horizontal--48">
          <span class="padding-bottom--15">AddUser</span>
          <form id="stripe-login" method="post" action="validation.php"  enctype="multipart/form-data">
  
  <div class="grid xl:grid-cols-2 xl:gap-6">
    <div class="relative z-0 mb-6 w-full group">
        <input type="text" name="FName" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php if(isset($olddata->FName)) {echo $olddata->FName;} ?>" />
        <label for="fname" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
        <?php
                        if(isset($errors->FName)){
                            echo "<p style='color: red'> $errors->FName</p>";
                        }
                    ?>
    
      </div>
    <div class="relative z-0 mb-6 w-full group">
        <input type="text" name="LName" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php if(isset($olddata->LName)) {echo $olddata->LName;} ?>"  />
        <label for="floating_last_name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
        <?php
                        if(isset($errors->LName)){
                            echo "<p style='color: red'> $errors->LName</p>";
                        }
                        else{echo null;}
                    ?>
            </div>
      </div>
  </div>
  <div class="relative z-0 mb-6 w-full group">
      <input type="email" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"  value="<?php if(isset($olddata->email)) {echo $olddata->email;} ?>" />
      <label for="floating_email" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
      <?php
                        if(isset($errors->email)){
                            echo "<p style='color: red'> $errors->email</p>";
                        }
                    ?>
    </div>
  <div class="relative z-0 mb-6 w-full group">
      <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php if(isset($olddata->password)) {echo $olddata->password;} ?>"  />
      <label for="floating_password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
      <?php
                        if(isset($errors->password)){
                            echo "<p style='color: red'> $errors->password</p>";
                        }
                    ?>
    </div>
  <div class="relative z-0 mb-6 w-full group">
      <input type="password" name="repeatpassword" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php if(isset($olddata->repeatpassword)) {echo $olddata->repeatpassword;} ?>"  />
      <label for="floating_repeat_password" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
      <?php
                        if(isset($errors->repeatpassword)){
                            echo "<p style='color: red'> $errors->repeatpassword</p>";
                        }
                    ?>
  </div>
  <div class="grid xl:grid-cols-2 xl:gap-6">
    <div class="relative z-0 mb-6 w-full group">
        <input type="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="roomNum" id="roomNum" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php if(isset($olddata->roomNum)) {echo $olddata->roomNum;} ?>"   />
        <label for="roomNum" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"> Room No</label>
        <?php
                        if(isset($errors->roomNum)){
                            echo "<p style='color: red'> $errors->roomNum</p>";
                        }
                    ?>
      </div>
    <div class="relative z-0 mb-6 w-full group">
        <input type="text" name="ext" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="<?php if(isset($olddata->ext)) {echo $olddata->ext;} ?>" />
        <label for="ext" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">EXT</label>
        <?php
                        if(isset($errors->ext)){
                            echo "<p style='color: red'> $errors->ext</p>";
                        }
                    ?>
      </div>
  </div>
  <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Image</label>
                        <input type="file" name="img" class=" form-label  " id="validationCustom03">
                       
                            <label style="color: red">
                                <?php if (isset($_GET["emptyimg"])) {
                                    echo "<br>Image Require<br>";}
                                    if (isset($_GET["extimg"])) {
                                        echo "extension doesnt match <br>";
                                } ?></label>

                    </div>
<div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>
            

            <input type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="submit" name="submit">

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>