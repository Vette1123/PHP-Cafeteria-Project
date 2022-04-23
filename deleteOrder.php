<!-- <?php

        session_start();
        // If the user is not logged in redirect to the login page...
        // if (!isset($_SESSION['loggedin'])) {
        //     header('Location: ../login.php');
        // }
        // if ($_SESSION['is_admin']!=1){
        //     die ("Access Denied");
        // }
        ?> -->


<?php

include("./dataBase.php");
// var_dump($_GET['id']);
// die();

if (isset($_GET['id'])) {
    $db = new DataBase();
    try {
        $db->connect();
        $update = $db->changeStatus($_GET['id']);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    header('Location: myOrders.php');
}

?>