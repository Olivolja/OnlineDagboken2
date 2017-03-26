<?php
	include("db_con.php");
	//hämtar data från POST
	
	$postusername = $_POST['username'];
	
	if(strlen($postusername) < 3) {
		header("Location:../pages/regform.php?i=shortusername");
		exit;
	}
	
	if(strlen($postusername) > 16) {
		header("Location:../pages/regform.php?i=longusername");
		exit;
	}
	$postfornamn = htmlspecialchars($_POST['fornamn']);
	$postefternamn = htmlspecialchars($_POST['efternamn']);
	$postpass1 = htmlspecialchars($_POST['pass1']);
	$postpass2 = htmlspecialchars($_POST['pass2']);
	$postusername = htmlspecialchars($postusername);
	$postusername = str_replace(' ', '', $postusername);
	$pass1 = trim($postpass1);
	$pass2 = trim($postpass2);
	$postfornamn = trim($postfornamn);
	$postefternamn = trim($postefternamn);
	
	if($pass1 != $pass2) {
		header("Location:../pages/regform.php?i=checkpass");
		exit;
	}
	
	function generateSalt(){ 
		$characters = '0123456789abcdef'; 
		$length = 64; 
		$string = ''; 
		for ($max = mb_strlen($characters) - 1, $i = 0; $i < $length; ++ $i) { 
			$string .= mb_substr($characters, mt_rand(0, $max), 1); 
		} 
		return $string;
	}
	$salt = generateSalt(); 
	$hash = hash_hmac("sha512", $pass1, $salt); 
	
	if ($stmt = mysqli_prepare($link, "INSERT INTO users (username, password, salt, firstname, surname) VALUES (?,?,?,?,?)")){
		mysqli_stmt_bind_param($stmt,'sssss', $postusername, $hash, $salt, $postfornamn, $postefternamn);
		mysqli_stmt_execute($stmt);	
		$insertedid = mysqli_stmt_insert_id($stmt);
		mysqli_stmt_free_result($stmt);
		
		if(isset($insertedid))	{
			mysqli_close($link);
			header("location:../pages/start.php");
			exit;
		}
	
	}
	
	
	
	
	mysqli_close($link);
	header("location:../pages/regform.php");
	exit;


?>