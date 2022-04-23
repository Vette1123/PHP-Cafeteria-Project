<?php
error_reporting(E_ALL ^ E_WARNING); 
$userID = $_GET['id'];
require 'dbclass.php';
//----------------------------------------------
    $errors2 = [];
    $olddata2= [];
    if (empty($_POST["productname"]) or $_POST["productname"]==""){
        $errors2["productname"]="please add a product name";
    }
    else{
        $olddata2["productname"] = $_POST["productname"];
    }
    if (empty($_POST["price"]) || $_POST["price"] < 0) {
        $errors2["price"] = "please add a Valid Price";
    }
    else{
        $olddata2["price"] = $_POST["price"];
    }    
    if (empty($_POST["category"])){
        $errors2["category"]="Please select your category";
    }
    else{
        $olddata2["category"] = $_POST["category"];
    }
    // if (empty($_FILES['image']['name'])){
    //     $errors2["image"]="please add a Image";
    // }
    // else{
    //     $olddata2["image"] = $_FILES['image']['name'];
    // }
//-----------------------------------------------------------------------------
$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $olddata2['image'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errors2['image'] = "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    $errors['image'] = "Sorry, file already exists.";
    $uploadOk = 0;
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
$productname = $_POST['productname'];
$price = $_POST['price'];
$category = $_POST['category'];
$image = $image_path;
var_dump($image);
//------------------------------------------------------------
$db = new Database();
$rows=$db->Select("Select * from products");
if (empty($_FILES['image']['name'])){
    $row=$db->Select("Select * from products where id=?",[$userID]);
    $image=$row[0]->picture;
}
else{
    $olddata2["image"] = $_FILES['image']['name'];
}

//-------------------------------------------------------------------
// $flagName=0;
// $flagImage=0;
//     for ($i = 0; $i < count($rows); $i++) {
//         if ($rows[$i]->name === $productname) {
//             $flagName++;
//         }
//         if (strtolower($rows[$i]->picture) == strtolower($image)) {
            
//             $flagImage++;
//         }
//     }
        if (count($errors2)> 0){
                $err=json_encode($errors2);
                header("Location:editProduct.php?errors2={$err}&id={$userID}");
        }else {
            // if($flagName === 0){
                    try {
                        $id = $db->Update("Update products set  `name`= ?,`price`=?,`category`=?,`picture`=?,`status`=? where id = ?"
                        ,[$productname,$price,$category,$image,true,$userID]);
                        header("Location:allProducts.php");
                    }catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }
                // else{
                //      echo"<h1 style='color:red'>Error!!!! <br> Data already exists pick another one[name]</h1>";
                // } 
    // }
//---------------------------------------------------
