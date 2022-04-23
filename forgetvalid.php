<?php 
include 'dbconnect.php';
$errors=[];
session_start();
if(isset($_POST['update'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
	if ($pass == $cpass) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
  		if ($result->num_rows > 0) {
			$sql2 = "UPDATE users SET password = '$pass' WHERE email ='$email';";
			$result2 = mysqli_query($conn, $sql2);
           
			if ($result2) {
				$row=mysqli_fetch_assoc($result);
                $_SESSION['name']=$row['name'];
                $_SESSION['role']=$row['role'];
                $_SESSION['login']='login';
                if($_SESSION['role']==='admin'){
                    header("Location: welcomeAdmin.php");
                }
                else{
                    header("Location: welcome.php");
                }
                            }}
         
          else if($result->num_rows==0 and $_POST['email']!==" " and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['emailN']="your email dosn't exist";
			}
		
		
	} 
    else {
        $errors['cpasss']="password dos'nt match";
       
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
// else{

// }
if(empty($_POST['cpassword']) or $_POST['cpassword']==" "){
    $errors['cpassword']="password confirm is required";
}
// else{

// }
if(count($errors)>0){
    $err=json_encode($errors);
            header("Location:forget.php?errors={$err}");  
        }
    
?>