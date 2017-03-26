<?php
    //echo("hej". $_POST['text'] ."". $_POST['title']) ."".$_POST['id'];
	include_once("db_con.php");
	$currentdate = date("Y-m-d H:i:s");
	$temptext = htmlspecialchars($_POST['text']);
	$temptitle = htmlspecialchars($_POST['title']);
	$tempid = intval($_POST['id']);
	$stmt = mysqli_prepare($link, "UPDATE posts SET title = ?, text = ?, editdate = ? WHERE id = ?");
	mysqli_stmt_bind_param($stmt, 'sssi', $temptitle, $temptext, $currentdate, $tempid);
		
	mysqli_stmt_execute($stmt);
  	
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close($stmt);
	
	header('location: ../index.php');