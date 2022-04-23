
<?php
require 'dbclass.php';
try {
    $userID = $_GET['id'];
    $db = new Database();
    $rows = $db->Remove("Delete from products where ID = :id",['id' => $userID]);
    header("Location:allProducts.php");
} catch (Exception $e) {
    echo $e->getMessage();
}

