<?php
	include_once("db_con.php");
	$currentdate = date("Y-m-d H:i:s");
	$title = htmlspecialchars($_POST['title']);
	$text = htmlspecialchars($_POST['text']);
	session_start();
	$userinsert = $_SESSION['userid'];
	session_write_close();
	//mysqli_query($link, "INSERT INTO `posts`(`userid`, `title`, `text`, `createdate`, `editdate`)";
	$stmt = mysqli_prepare($link, "INSERT INTO `posts`(`userid`, `title`, `text`, `createdate`, `editdate`) VALUES (?, ?, ?, ?, ?)");

	mysqli_stmt_bind_param($stmt, 'issss', $userinsert, $title, $text, $currentdate, $currentdate);
	mysqli_stmt_execute($stmt);
  	
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close($stmt);
	
	header('location: ../pages/index.php');
?>