<?php

    session_start();
    session_destroy();

    #   remove session file  from the server
    setcookie("PHPSESSID", "", time()-3600, "/","localhost",0,0);
    
    header('Location: sign_in.php');

?>