<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "webquiz";

$link = new mysqli($server,$user,$pass,$db);

if($link->connect_error){
  die("Connection_Failed : " .$link->connect_error);
}
$link->set_charset("utf8");
?>
