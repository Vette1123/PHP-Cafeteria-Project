<?php

require_once('../ConnectDB.php');

$db=new ConnectDB();

$id=$_REQUEST['id'];

if(isset($id)){
   
    // $db->deletedCanclefOrder($id);
    header("Location:./myOrder.php");
}



?>