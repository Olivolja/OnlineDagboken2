<?php
	session_start();
	
	session_regenerate_id();
	
	unset($_SESSION['userid']);
	unset($_SESSION['firstname']);
	unset($_SESSION['surname']);
	
	session_destroy();
	
	session_write_close();
	
	
	header("Location: ../pages/start.php");
	exit;
?>