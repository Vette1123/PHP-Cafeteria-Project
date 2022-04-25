<?php
$allowUsers = ['admin'];
include('./authGuard.php');
$userID = $_GET['id'];
require 'dbclass.php';
try {
    $db = new Database();
    $rows=$db->Select("Select * from products where id=?",[$userID]);
    $row=$rows[0];
} catch (Exception $e) {
    echo $e->getMessage();
}
if (isset($_GET["errors2"])){
    $errors2 = json_decode($_GET["errors2"]);
}
$db = new DataBase();
$categoryRows=$db->Select("Select * from category");
error_reporting(E_ALL ^ E_WARNING); 
?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <!-- <link rel='stylesheet' href='style.css'/> -->
    <title>Document</title>
    <style>
        *{
         background-color:#EEE;
        }
        label{
            color:white;
        }
        form{
            margin:50px auto;
            width:50%;
        }
    </style>
    </head>
    <body>
        <div class="container">
        <form method="post" action="<?php echo "updateProduct.php?id=". $row->id; ?>" enctype="multipart/form-data">
        <div class="mb-6">
                <label for="productname" class="block mb-2 text-sm font-medium  text-gray-900 dark:text-gray-300">Product Name</label>
                <input type="text"  name="productname" value="<?php echo $row->name;?>" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5
                 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                  placeholder="Water">
                 <?php
                    if(isset($errors2)){
                       echo "<p style='color:red;font-size:12px'> $errors2->productname</p>";
                    }else{
                        echo null;
                    }
                ?>
            </div>
            
<!-- ------------------------------------------------------------------------------------------------------------- -->
            <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium  text-gray-900 dark:text-gray-300">Price</label>
                <input type="number" id="price" name="price" value="<?php echo $row->price;?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0$" >
                <?php
                    if(isset($errors2)){
                        echo "<p style='color:red;font-size:12px'> $errors2->price</p>";
                    }
                ?>
            </div>            
<!-- ------------------------------------------------------------------------------------------------------------- -->
                <div class="mb-6">
                        <label for="category" class="block mb-2 text-sm font-medium  text-gray-900 dark:text-gray-300">Category</label>
                <select  id="category" name="category" value="<?php if(isset($row->category)) {echo $row->category;}?>" 
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 ">
                        <option  value=""></option>
                        <?php
                        foreach ($categoryRows as $category) {
                        ?>
                            <option value="<?php echo $category->category?>" <?php if(isset($category->category) && $category->category ==  $row->category) {echo "selected";}?>>
                            <?php echo $category->category ?>
                            </option>
                        <?php
                        }
                        ?>
                 </select>
                        <?php
                            if(isset($errors2->category)){
                                echo "<p style='color:red;font-size:12px'> $errors2->category</p>";
                            }
                   ; ?>
            </div>
<!-- ------------------------------------------------------------------------------------------------------------- -->
            <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium  text-gray-900 dark:text-gray-300" for="image">Upload Picture</label>
                    <input id="image" type="file" name="image" src="<?php echo $row->picture;?>" value="<?php echo $row->picture;?>" 
                    class="block w-full text-sm text-gray-900 bg-gray-50
                    rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" >
                    <?php
                    if(isset($errors2)){
                        echo "<p style='color:red;font-size:12px'> $errors2->image</p>";
                    }
                ?>
                </div>
                <!-- -------------------------------------------------- -->
             <div class="mb-6">
                <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center 
                 dark:focus:ring-blue-800">
                Submit</button>
                <button type="reset" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center 
                 dark:focus:ring-blue-800">Reset</button>
            </div>
            </form>
        </div>

    </body>


</html>