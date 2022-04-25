<?php
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
$file_tmp =$_FILES['img']['tmp_name'];
$ext= pathinfo($file_name,PATHINFO_EXTENSION);
$extensions= array("jpeg","jpg","png");
$image="";
if (!file_exists($file_tmp) || !is_uploaded_file($file_tmp)) {
    $errors["emptyimg"] = "Profile_is_empty";
}
else{
    if (in_array($ext, $extensions)){
        $image =addslashes($file_name);
        move_uploaded_file($file_tmp,"./image/".$file_name);
    }
    else{
        $errors['extimg']="imgerorr";
    }
}
    if (count($errors)> 0){

        $err=json_encode($errors);
        

        if(count($olddata) > 0) {
            $old = json_encode($olddata);
            

            header("Location:AddUser.php?olddata={$old}&&errors={$err}");
            
        }else {
            header("Location:AddUser.php?errors={$err}"); 
            
        }
    }
    else{
        $Fname=strtolower(trim(htmlspecialchars($_POST["FName"])));
        $Lname=strtolower(trim(htmlspecialchars($_POST["LName"])));
        $name=$Fname." ".$Lname;
        $email=strtolower(trim(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)));
        $password=trim(htmlspecialchars($_POST['password']));
        $roomNum=trim(htmlspecialchars($_POST['roomNum']));
        $ext =trim(htmlspecialchars($_POST['ext']));
        $image =strtolower(trim(htmlspecialchars($image)));
        $exist= false;
             require_once("./Database.php");
            $mydb = new DataBase();
            try {
                $mydb ->connect();
                $result= $mydb->select_All("users");
              for($i=0; $i<count($result) ;$i++){
                if($result[$i]['email']==$email){
                    $exist=true;
                    break;
                }
              }
              if(!$exist){
                $mydb->insert_into("users", $name, $email, $password,$roomNum,$ext, $image,'user');   
              }
              header("Location:AllUser.php");
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        
        


    

    
