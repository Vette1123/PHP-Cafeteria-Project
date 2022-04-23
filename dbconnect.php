<?php
$server="localhost";
$username = 'root';
$database="cafeteria";
$password = '';
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "<script>alert('connection failed !')</script>";
}

?>