<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class DataBase
{
    private $serverName;
    private $userName;
    private $userPass;
    private $dbName;
    private $charSet;
    private $dsn;
    // private $db;

    public function __construct()
    {
        $this->serverName  = "localhost";
        $this->userName = "root";
        $this->userPass  = "ahmedchelsea1996";
        $this->dbName = "cafetriaschema";
        $this->charSet = "utf8mb4";

        $this->dsn = "mysql:host=" . $this->serverName . "; dbname=" . $this->dbName . "; charset=" . $this->charSet;
    }
    public function connect()
    {
        try {
            $db = new PDO($this->dsn, $this->userName, $this->userPass);
            return $db;
        } catch (PDOException $err) {
            die($err->getMessage());
        }
    }
    
    public function insert_into($table_name, ...$args)
    { $db=$this->connect();
        $query = "INSERT INTO `$table_name` ";
        switch ($table_name) {
            case 'users':
                $query .= ' ( `name`, `email`, `password`, `roomNum`, `ext`, `profile_Picture`, `role`)  VALUES(?,?,?,?,?,?,?)';
                break;
        
        }
        $stmt = $db->prepare($query);
        $stmt->execute($args);
    }


    public function delete($table_name, $id)
    {
        $db=$this->connect();
        $the_int_id = (int) $id;
        $query = "DELETE FROM $table_name WHERE id=$the_int_id";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }


    public function updateUser($data, $user_id ,$img){
// var_dump($data);
// // var_dump($i);
// exit;
        try{
            
          $db= $this->connect();
          if($db){
            $name =  $data['FName']." ".$data["LName"];
              $email =  $data['email'];
              $password=$data['password'];
            
              $roomNum=$data['roomNum'];
              $ext=$data['ext'];
              
              
             }
             
             if(isset($img)){
              $up_stmt = 'UPDATE `users` SET `name`=:fullname , `email`=:email,`password`=:mypassword,`roomNum`=:roomNum,`ext`=:ext,`profile_picture`="'.$img.'" WHERE id=:id';}
              
          else {
            $up_stmt = "UPDATE `users` SET `name`=:fullname , `email`=:email,`password`=:mypassword,`roomNum`=:roomNum,`ext`=:ext WHERE id=:id";
            
           
          }
        //   $mydata = [
        //     ':fullname' => $name,
        //     ':email' => $email,
        //     ':mypassword' => $password,
        //     ':course' => $repeatpassword,
        //     ':stud_id' => $roomNum,
        //     ':ext' =>$ext,
        //     var_dump(':ext')
        // ];
       
             $update_stmt = $db->prepare($up_stmt);
             $update_stmt->bindParam(":id",$user_id ,PDO::PARAM_INT );
             $update_stmt->bindParam(":fullname",$name ,PDO::PARAM_STR );
             $update_stmt->bindParam(":email",$email ,PDO::PARAM_STR );
             $update_stmt->bindParam(":mypassword",$password ,PDO::PARAM_STR );
             
             $update_stmt->bindParam(":roomNum",$roomNum ,PDO::PARAM_INT );
            $update_stmt->bindParam(":ext",$ext ,PDO::PARAM_INT );
            
            
         
            
           
            
             if($update_stmt->execute()) {
                echo 'Update Sucessed!';
            }else
                echo "Update Failure";
    
                var_dump($update_stmt->errorInfo());
             
      
          }
      catch (Exception $e){
          echo $e->getMessage();
      }
      
      }
    
    public function select_row(  $id)
    {
        $db=$this->connect();
        $the_int_id = (int)  $id;
        $query = "SELECT * FROM users WHERE id= $the_int_id ";
        //var_dump($query);
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function select_All($table_name)
    {
        $db=$this->connect();
        $query = "SELECT * FROM $table_name";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}