<?php
error_reporting(E_ALL ^ E_WARNING); 
require 'dbclass.php';
$db = new DataBase();
$categoryRows=$db->Select("Select * from category");

if (isset($_GET["errors"])){
    $errors = json_decode($_GET["errors"]);
}
if (isset($_GET["olddata"])){
    $olddata = json_decode($_GET["olddata"]);
}
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
    form{
        margin:50px auto;
        width:50%;
    }
</style>
</head>
<body>
    <div class="container">
    
        <form method="post" action="addProduct.php"  enctype="multipart/form-data">

             <div class="mb-6">
                <label for="productname" class="block mb-2 text-sm font-medium">Product Name</label>
                <input type="text" id="productname" name="productname"
                 value="<?php if(isset($olddata->productname)) {echo $olddata->productname;} ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
                rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                 dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Water">
                 <?php
                    if(isset($errors->productname)){
                        echo "<p style='color:red;font-size:12px'> $errors->productname</p>";
                    }
                ?>
            </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

            <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Price</label>
                <input type="number" id="price" name="price" value="<?php if(isset($olddata->price)) {echo $olddata->price;} ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0.0$" >
                <?php
                        if(isset($errors->price)){
                            echo "<p style='color:red;font-size:12px'> $errors->price</p>";
                        }
                    
                    ?>
            </div> 
            
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
        <div class="mb-6">
             <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Category</label>
                <select id="category" name="category" value="<?php if(isset($olddata->category)) {echo $olddata->category;}?>" 
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option  value=""></option>
                        <?php
                        foreach ($categoryRows as $category) {
                        ?>
                            <option value="<?php echo $category->category?>" <?php if(isset($category->category) && $category->category ==  $olddata->category) {echo "selected";}?>>
                            <?php echo $category->category ?></option>
                        <?php
                        }
                        ?>
                 </select>
                 <a href='addCategoryForm.php' style='float:right'> Add Category</a>
                <?php
                    if(isset($errors->category)){
                        echo "<p style='color:red;font-size:12px'> $errors->category</p>";
                    }
                 ?>
            </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="image">Upload Picture</label>
            <input id="image" type="file" name="image" class="block w-full text-sm text-gray-900 bg-gray-50
             rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent
              dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
               aria-describedby="user_avatar_help" value="<?php if(isset($olddata->image)) {echo $olddata->image;}?>" >
            <?php
                if (isset($errors->image)) {
                        echo "<p style='color:red;font-size:12px'>$errors->image</p>";
                   }
                 ?>
            </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

            <div class="mb-6">
            <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4
             focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm 
             sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
             Submit</button>
            <input type="reset" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none
             focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 
             dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            </div>
        </form>
    </div>

</body>


</html>



















































