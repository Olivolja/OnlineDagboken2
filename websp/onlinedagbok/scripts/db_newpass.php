<?php
	session_start();
	if (!isset($_SESSION['userid'])) {
		header("location:index.php");
		exit;
	}
	session_write_close();
	include("db_con.php");
	
	$stmt = mysqli_prepare($link, "SELECT id, username, password, salt, firstname, surname FROM users WHERE id = ? ");
		mysqli_stmt_bind_param($stmt,'i', $_SESSION['userid']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $id, $username, $password, $salt, $firstname, $surname);
		mysqli_stmt_store_result($stmt);
		echo($password);
	// --------- kolla om "user" finns ---------------
		if (mysqli_stmt_num_rows($stmt) != 1) {
			mysqli_close($link);
			header("Location: logout.php");
			exit;
		}

	// --------- kolla om lösen stämmer ---------------
		if(mysqli_stmt_fetch($stmt)){
			
			$postoldpassword = hash_hmac("sha512", htmlspecialchars($_POST['oldpass']), $salt);
			//echo ($postoldpassword."<br />");
			//echo($password);
			$postpass1 = htmlspecialchars($_POST['pass1']);
			$postpass2 = htmlspecialchars($_POST['pass2']);
			
			if ($postoldpassword === $password){ 
				if (trim($postpass1) === trim($postpass2)){
					$postpass1 = hash_hmac("sha512", $postpass1, $salt);

					$stmt2 = mysqli_prepare($link, "UPDATE users SET password = ? WHERE id = ?");
					mysqli_stmt_bind_param($stmt2,'si', $postpass1 , $_SESSION['userid']);	
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_free_result($stmt2);
					mysqli_stmt_close($stmt2);
					
					header('location: logout.php');
					exit;
				}
				else {
					
				}
			}
		}
	header("Location: ../pages/index.php");
	
	