<!DOCTYPE html>
<html>
<?php
error_reporting(E_ALL ^ E_WARNING); 
require 'dbclass.php';
try{
   $db = new Database();
   $rows=$db->Select("Select * from products");
    echo "
    <html>
        <head>
                <link rel='stylesheet' href='https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css'/>
                 <link rel='stylesheet' href='style.css'/>
        </head>
    <body>
    
    <div style='text-align: center;padding:20px'><a style='font-size:30px' href='addProductForm.php'> Add Product</a></div>
    <table border='2px solid white' class=' container text-left text-gray-500 text-gray-400'>
    <thead class='text-l text-gray-700 bg-gray-800 dark:text-gray-400'>
            <tr>
            <th class='px-6 py-3'>Product</th> 
            <th class='px-6 py-3'>Price</th> 
            <th class='px-6 py-3'>Picture</th>
            <th class='px-6 py-3'>Current Status</th>
            <th colspan='3' class='px-6 py-3' style='text-align:center'>
            Actions
            </th> 
            </tr>
            </thead>";
             foreach ($rows as $r){
            echo "<tbody><tr class='bg-white border-b bg-gray-800 dark:border-gray-700'> 
            <td class='px-6 py-3'>$r->name</td>
             <td class='px-6 py-3'>$r->price$</td>
             <td class='px-6 py-3'>
             <div style='height:140px; width: 150px; overflow: hidden;'>
             <img src='$r->picture'  style='height:100% !important;width:100%;object-fit: cover;'>
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
        echo "</table>";
      
}catch (Exception $e){
    echo $e->getMessage();
}
?>

