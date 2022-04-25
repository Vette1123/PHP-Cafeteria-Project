<?php
 $allowUsers = ['admin'];
 include('./authGuard.php');
?>
 <!DOCTYpE html>
<html lang="en">

<head>
  <title>Cafeteria</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel='stylesheet' href='https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css'/> 

</head>

<body>

 <?php include('./layouts/navbar.php') ?>


  <!-- END nav -->
  <section class="container user-home mx-auto">
    <div class="d-flex justify-content-between align-items-center pt-3" >
    <h2 class="text-6xl"><a href=""> Users</a> </h2>
    <div class='text-center my-6'><a class='text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2'  href='AddUser.php'>Add User</a></div>
    </div>
    <hr />
   
      <div class="container">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
<tr>
<th scope="col" class="px-6 py-3">
Name
</th>
<th scope="col" class="px-6 py-3">
Room
 </th>
<th scope="col" class="px-6 py-3">
Ext
</th>
<th scope="col" class="px-6 py-3">
Image
</th>
<th scope="col" class="px-6 py-3">
Actions
</th>

</tr>
</thead>
<tbody>
<?php

require_once("./DatabaseUsers.php");
$db = new DataBase();
try {
 $db->connect();
 $users = $db->select_All("users");
 //var_dump($users);

 if ($users) {
   foreach ($users as $user) {
     
?>
<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
<th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
<?php echo $user["name"] ?>
</th>
<td class="px-6 py-4">
<?php echo $user["roomNum"] ?>
</td>
<td class="px-6 py-4">
<?php echo $user["ext"] ?>
</td>
<td class="px-6 py-4">
<img src="<?php echo "http://localhost/php_project/images/user_image/". $user['profile_Picture'] ?>" class="col-xs-3" width="150px" height="150px" class="img-rounded">
</td>
<td class="px-6 py-4">
<h5><a href='editUser.php?id=<?php echo $user['id'] ?>'>Edit </a> - <a href='deleteUser.php?id=<?php echo $user['id'] ?>'>Delete</a></h5>
</td>
</tr>
<?php
                      }
                    }
                  } catch (PDOException $e) {
                    echo 'Connection failed: ' . $e->getMessage();
                  }
                  ?>
</tbody>
</table>

</div>
      </div>
    
  </section>
  
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>

</body>

</html>


