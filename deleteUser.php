<?php
 require_once("./Database.php");
$mydb = new DataBase();
try {
    $mydb ->connect();
    $mydb->delete("users",$_REQUEST['id']);
    header("location:AllUser.php");
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}