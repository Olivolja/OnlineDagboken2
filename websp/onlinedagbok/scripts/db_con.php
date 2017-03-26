<?php
	//connect to database
	$user = "Student";
	$pass = "qwerty";
	$db = "onlinedagbok";
	
	$link = mysqli_connect('localhost', $user, $pass, $db);
	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}
?>