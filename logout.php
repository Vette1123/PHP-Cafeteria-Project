<?php
    $allowUsers = ['user', 'admin'];
    include('./authGuard.php');
    unset($_SESSION['role']);
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    session_destroy();

    #   remove session file  from the server
    setcookie("PHPSESSID", "", time()-3600, "/","localhost",0,0);
    echo $_SESSION['role'];
    header('Location: sign_in.php');

?>