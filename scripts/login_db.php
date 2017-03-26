<?php 

	include("db_con.php");

	if (isset($_SESSION['passhits']) && $_SESSION['passhits'] > 8) {
		header("location:../blog/loginform.php?i=passhits");
	}
	session_start();
	session_regenerate_id();
	
	$postusername = trim($_POST['username']);
	$postpassword = trim($_POST['password']);
	
	
	$stmt = mysqli_prepare($link, "SELECT id, username, password, salt, firstname, surname FROM users WHERE username = ? ");
	mysqli_stmt_bind_param($stmt,'s', $postusername);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $username, $password, $salt, $firstname, $surname);
	mysqli_stmt_store_result($stmt);

// --------- kolla om "user" finns ---------------
	if (mysqli_stmt_num_rows($stmt) != 1) {
		mysqli_close($link);
		header("Location: ../pages/loginform.php?i=nouser");
		exit;
	}

// --------- kolla om lösen stämmer ---------------
	if(mysqli_stmt_fetch($stmt)){
		$hash = hash_hmac("sha512", $postpassword, $salt);
	
		if ($hash === $password){ 
		
			// --------- lösen stämmer ---------------
			
			$_SESSION['userid']  = $id;
			$_SESSION['firstname']   = $firstname;
			$_SESSION['surname']   = $surname;
			//$_SESSION['profile'] = $profile;
			
			unset($_SESSION['passhits']);
			session_write_close();
			
			header("Location: ../pages/index.php");
			exit;
		
		}
		else {
			// --------- lösen stämmer inte---------------
			// --------- antal försök av passhits addera +1 ----- maxförsök = 8 --------------
			if (!isset($_SESSION['passhits'])){
				$_SESSION['passhits'] = 1;	
			
			}
			elseif (isset($_SESSION['passhits']) && $_SESSION['passhits'] >8){
				header('location:../pages/loginform.php?i=passhits'); 
				exit;
			}
			else {
				$_SESSION['passhits']++;
			}
				
			
			header("Location: ../pages/loginform.php?i=passw");
			exit;
			
			
		}
	}   
	mysqli_stmt_free_result($stmt);
    mysqli_close($link);
    	
?>