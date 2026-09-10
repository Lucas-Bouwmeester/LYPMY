<?php
	session_start();
	require './db/boot.php';

	// session_destroy();

	header('location: home.php');

	var_dump($_SESSION);
?>