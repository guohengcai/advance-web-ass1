<?php
$user = "user";
$password = "password";
$host = "localhost";
$database = "test";
$connection = mysqli_connect($host,$user,$password,$database);

if(!$connection){
  echo "connection error";
}
?>