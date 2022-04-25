
<?php
error_reporting(E_ALL ^ E_WARNING); 
$allowUsers = ['admin'];
include('./authGuard.php');
require 'dbclass.php';
$db = new Database();
$rows=$db->Select("Select * from products");
?>
<!DOCTYPE html>
    <html>
        <head>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
<script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>All Products</title>
        </head>
    <body>
    <?php include('./layouts/navbar.php'); ?>
    
    <div class='text-center my-6'><a class='text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2'  href='addProductForm.php'>Add Product</a></div>
    <table  class='w-full text-sm text-left text-gray-500 dark:text-gray-400 container mx-auto'>
    <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
            <tr>
            <th class='px-6 py-3'>Product</th> 
            <th class='px-6 py-3'>Price</th> 
            <th class='px-6 py-3'>Picture</th>
            <th class='px-6 py-3'>Current Status</th>
            <th colspan='3' class='px-6 py-3' style='text-align:center'>
            Actions
            </th> 
            </tr>
            </thead>
            <?php foreach ($rows as $r){
            echo "<tbody><tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'> 
            <td class='px-6 py-3'>$r->name</td>
             <td class='px-6 py-3'>$r->price$</td>
             <td class='px-6 py-3'>
             <div style='height:140px; width: 150px; overflow: hidden;'>
             <img src='http://localhost/php_project/images/product_image/{$r->picture}'  style='height:100% !important;width:100%;object-fit: cover;'>
             </div>
             </td> ";
            echo "<td class='px-6 py-3'>";
           echo empty(!$r->status) ? "Available":"Unavailable";
           echo" </td> 
           <td class='px-6 py-3'>
           <a href='available.php?id={$r->id}' style='display:block'>
           <button>available</button></a>
           <a href='unavailable.php?id={$r->id}'>
            <button>unavailable</button></a>
           </td>
           <td class='px-6 py-3'> <a href='editProduct.php?id={$r->id}'>
            Edit</a> - <a href='deleteProduct.php?id={$r->id}'> Delete</a> </td>";
            echo "</tr>";
        }
        ?>
        </table>

    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>

    </body>
    </html>
      


