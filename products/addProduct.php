<?php
require 'dbclass.php';
error_reporting(E_ALL ^ E_WARNING); 

///---set error msgs -----------------------------------------------------------------------------   
    $errors = [];
    $olddata= [];
    if (empty($_POST["productname"]) or $_POST["productname"]==""){
        $errors["productname"]="please add a product name";
    }else{
        $olddata["productname"] = $_POST["productname"];
    }
    if (empty($_POST["price"]) || $_POST["price"] < 0) {
        $errors["price"] = "please add a Valid Price";
    }else{
        $olddata["price"] = $_POST["price"];
    }    
    if (empty($_POST["category"])){
        $errors["category"]="Please select your category";
    }else{
        $olddata["category"] = $_POST["category"];
    }
    if (empty($_FILES['image']['name'])){
        $errors["image"]="please add a Image";
    }else{
        $olddata["image"] = $_FILES['image']['name'];
    }
//------------------------------------------------------------------------------
$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $olddata['image'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errors['image'] = "File is not an image.";
        $uploadOk = 0;
    }
}

if ($_FILES["image"]["size"] > 5000000) {
    $errors['image'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}

if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $errors['image'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $errors['image'] = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $olddata['image'] = "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        $errors['image'] = "Sorry, there was an error uploading your file.";
    }
}
$filename=$_FILES['image']['name'];
$image_path='files/'.$filename;
//-------------------------------------------------------------------------------
    if (count($errors)> 0){
        $err=json_encode($errors);
        if(count($olddata) > 0) {
            var_dump($olddata);
            $old = json_encode($olddata);
            header("Location:addProductForm.php?errors={$err}&olddata={$old}");
        }else {
            header("Location:addProductForm.php?errors={$err}"); 
        }
    } else {
        $productname = $_POST['productname'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image = $image_path;
        $db = new Database();
        $rows=$db->Select("Select * from products");
//-------------------------------------------------------------------
$flagName=0;
$flagImage=0;
    for ($i = 0; $i < count($rows); $i++) {
        if ($rows[$i]->name === $productname) {
            $flagName++;
        }
        if (strtolower($rows[$i]->picture) == strtolower($image)) {
            
            $flagImage++;
        }
    }
    //-------------------------------------------------------------------
    if($flagName === 0 && $flagImage === 0){
        // if($flagName === 0){
        $id = $db->Insert("Insert into `products`(`name`,`price`,`category`,`picture`,`status`) values (:c1,:c2,:c3 ,:c4,:c5)", [
                'c1' => $productname,
                'c2' => $price,
                'c3' => $category,
                'c4' => $image,
                'c5' => true
            ]);
            header("Location:allProducts.php");
        }else{
            echo"<h1 style='color:red'>Error!!!! <br> Data already exists pick another one</h1>";
        }
}