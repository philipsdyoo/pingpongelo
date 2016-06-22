<?php
	session_start();
	unset($_SESSION['access_token']);
	unset($_SESSION['id_token']);
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	session_destroy();
	$_SESSION = array();
	header("Location: index.php");
?>