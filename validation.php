<?php
error_reporting(E_ALL ^ E_WARNING); 

// include 'dbconnect.php';

require('./ConnectDB.php');

$db = new ConnectDB();

session_start();


$errors=[];

if (isset($_SESSION['name'])) {
    error_reporting(0);
}

if(isset($_POST['submit'])){
  $email=$_POST['email'];
  $pass=$_POST['password'];

  // $sql="SELECT * FROM users WHERE email='$email' AND password='$pass' ;";
  // $res=mysqli_query($conn,$sql);

  $row=$db->checkEmail($email,$pass);


  if($row){

    // $row=mysqli_fetch_assoc($res);

   $_SESSION['name']=$row['name'];
   $_SESSION['role']=$row['role'];
   $_SESSION['email']=$row['email'];
   $_SESSION['id']=$row['id'];
   $_SESSION['profile_Picture']=$row['profile_Picture'];
   $_SESSION['role']=$row['role'];
   $_SESSION['login']='login';
   
   if($_SESSION['role']==='admin'){
     header("Location: ./myOrder.php");
   }
   else{
    header("Location: products.php");
   }
   
}
//
else{
  $errors['page']="some thing is wrong email or password , please try again !";
}
}

if(empty($_POST['email']) or $_POST['email']==" "){
    $errors['email']="Email is required";
}
else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email']="Email is invalid ! try again";
}
// else{
// }
if(empty($_POST['password']) or $_POST['password']==" "){
    $errors['password']="password is required";
}
if(count($errors)>0){
    $err=json_encode($errors);
            header("Location:sign_in.php?errors={$err}");  # issue url --> get method
        }
