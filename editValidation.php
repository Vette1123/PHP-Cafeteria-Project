
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "database.php";
$db = new Database();

$record_id = $_REQUEST["id"];

$errors = [];
$olddata= [];

if (empty($_POST["FName"])){
    $errors["FName"]="First Name is required";
}else{
    $olddata["FName"] = $_POST["FName"];
}
if (empty($_POST["LName"])){
    $errors["LName"]="Last Name is required";
}else{
    $olddata["LName"] = $_POST["LName"];
}
if (empty($_POST["email"])) {
    $errors["email"] = "Email is required";
    
  } 

  else{
    if (!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["wrongformat"]="invalid";
    }
    else{
    $olddata["email"] = ($_POST["email"]);}}
    

if (empty($_POST["password"])){
    $errors["password"]="password is required";
}else{
    $pass_pattern = "/^[a-z0-9_]{8,10}$/";
if (!empty($_POST['password'])&& !preg_match_all($pass_pattern, $_REQUEST["password"], $matches)) {
    $errors["password"]="password must than 8";
}
else{
    $olddata["password"] = $_POST["password"];
}}
if (empty($_POST["repeatpassword"])){
    $errors["repeatpassword"]="repeatpassword is required";
}else  {
    if (!empty($_POST['password']) && $_REQUEST["password"] != $_REQUEST["repeatpassword"]) {
        $errors['repeatpassword']="doesn'tmatch";}

else{

    $olddata["repeatpassword"] = $_POST["repeatpassword"];}
}


if (empty($_POST["roomNum"])){
    $errors["roomNum"]="roomNum is required";
}else{
    $olddata["roomNum"] = $_POST["roomNum"];
}

if (empty($_POST["ext"])){
    $errors["ext"]="ext is required";
}else{
    $olddata["ext"] = $_POST["ext"];
}

$file_name = $_FILES['img']['name'];
    $file_size = $_FILES['img']['size'];
    $file_tmp = $_FILES['img']['tmp_name'];
    $file_type = $_FILES['img']['type'];


    if(($file_name != "")){
        // get file extension
        $ext = explode('.', $_FILES['img']['name']);

        $ext = pathinfo($file_name)["extension"];


        $extensions = array("jpeg", "jpg", "png");


        if (in_array($ext, $extensions) === false) {
            $errors['img'] = "extension not allowed, please choose a JPEG or PNG file.";
        }
         if ($file_size > 2097152) {
            $errors['img'] = 'File size must be excately 2 MB';
        }
       
else { $_REQUEST['profile_Picture']=$file_name;
    move_uploaded_file($file_tmp, "./image/" .$file_name);
     }

    }



else{
    $row=$db->select_row($record_id);
    $image=$row->profile_Picture; 
    $_REQUEST['profile_Picture']=$image;  
    
    
} 
  

if (count($errors)> 0){
  $err=json_encode($errors);
  header("Location:editUser.php?errors={$err}&id={$record_id}");
}else {
  
 $db->updateUser($_REQUEST,$record_id);


  header("Location:AllUser.php");}



            
        