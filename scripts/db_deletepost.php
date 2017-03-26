<?php
    //echo("hejhej");
    session_start();
    if(!isset($_SESSION["userid"])){
        header('location:logout.php');
        exit;
    }
	include("db_con.php");
	//skapa en åtkomst kontroll
	if($_POST['userid'] != $_SESSION['userid']){
 		header('location:logout.php');
   	}
	if(isset($_POST["id"])) {
		$postid = intval($_POST["id"]);
	}
	else {
		header('location:../blog/index.php');
	}
	if ($stmt = mysqli_prepare($link, "DELETE FROM posts WHERE id = ? ")){
	
		mysqli_stmt_bind_param($stmt, 'i', $postid);
		mysqli_stmt_execute($stmt); 
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	}
	header('location:../pages/index.php');