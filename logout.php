<?php
//start session to access it
session_start();
//When user logs out, unset the session variables that are used to log the user in

unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["email"]);

//get the page the user came from using "HTTP_REFERER"
$origin = $_SERVER["HTTP_REFERER"];
//send the user to the page they came from after logout
header("location: $origin");
?>