<?php
session_start();
$errorCategory = !empty($_GET['errorCategory']) ? $_GET['errorCategory'] : "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Add Product</title>
    <style>
        
    </style>

<body>
<?php include('./layouts/navbar.php'); ?>

    <section class="container mx-auto">
        <form action="addCategoryValidation.php" method="post" enctype="multipart/form-data">
            <div style="margin: 10rem auto;width:50% ; border:1px solid gray; padding:20px;border-radius:10px;" >
                        <label class="block font-medium text-gray-900 dark:text-gray-300" style="margin-right: 2rem; margin-left:1rem; padding-bottom:10px;font-weight: bold;">Category</label>
                        <input type="text" name="category" style="width:90%;"  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Drink" required><br>
                        <a  href='addProductForm.php' class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 dark:hover:bg-blue-300" > Back To Add Product</a>
                        <p style="color:red">
                        <?php if (!empty($errorCategory)) echo "$errorCategory"; ?>
                       </p>
                    
                            <button type="submit" class="mt-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4
                            focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full 
                            sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add</button>
                       
            </div>
</form>
    </section>
    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>
</body>


</body>

</html>