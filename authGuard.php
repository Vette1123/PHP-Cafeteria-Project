<?php
session_start();
    if(isset($_SESSION['role'])){
        if(!in_array($_SESSION['role'], $allowUsers)){
            header('Location: products.php');
        }
    }else{
        if(basename($_SERVER['PHP_SELF']) !== 'sign_in.php' and basename($_SERVER['PHP_SELF']) !== 'forget.php'){
            header('Location: sign_in.php');
        }
    }

?>