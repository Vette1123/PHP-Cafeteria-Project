<?php

require_once('../ConnectDB.php');

$db=new ConnectDB();

$id=$_REQUEST['id'];

// var_dump($id);

if(isset($id)){
    try {

      $is_done=$db->orderDeliverd($id);
        
       if($is_done)
        header("Location:./myOrder.php");

        else echo('error');

      }catch (Exception $ex){
          $ex->getMessage();
      }

}
