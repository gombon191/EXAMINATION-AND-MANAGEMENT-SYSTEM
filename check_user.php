<?php
session_start();
if(!isset($_SESSION['level'])) {
	header("Location: login.php");
	exit;
}
?>
