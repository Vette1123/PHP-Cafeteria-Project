<?php
$server="localhost";
$username = 'root';
$database="tslemlarvelfinal";
$password = 'Awad36148';
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "<script>alert('connection failed !')</script>";
}
