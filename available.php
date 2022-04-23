
<?php
error_reporting(E_ALL ^ E_WARNING); 
$userID = $_GET['id'];
require 'dbclass.php';
try {
    $db = new Database();
    $d=$db->Update("Update products set `status`= ? where id = ?",[true,$userID]);
    header("Location: allProducts.php");
} catch (Exception $e) {
    echo $e->getMessage();
}?>