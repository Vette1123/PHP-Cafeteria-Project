<?php

error_reporting(E_ALL ^ E_WARNING); 

$newCategory = $_POST['category'];
require 'dbclass.php';
$db = new DataBase();
$categoryRows=$db->Select("Select * from category");
$flagExist = 0;
foreach ($categoryRows as $cat) {
    if ($newCategory == $cat->category) {
        $flagExist = 1;
    }
}
if ($flagExist) {
    $duplicateCategory = "This Category is already exists";
    echo $duplicateCategory."<br>";
    header("Location:addCategoryForm.php?errorCategory=$duplicateCategory");
} else {
    $id = $db->Insert("Insert into `category`(`category`) values (:c1)", [
        'c1' => $newCategory,
    ]);
    header("Location:addProductForm.php");
}