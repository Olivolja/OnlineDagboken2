<?php
	/** för hindra direkt åtkommst
	if(!defined("includecheck")) {
	   die('ej tillåten åtkomst');
	}
	
	session_start();
	//här kan man ha innehåll som visas på alla sidor för att inte upprepa till ex visa inloggad eller meny
	if (isset($_SESSION['profile']) && $_SESSION['profile'] < 3) {
		$loggedin  = "Logga ut";
	}
	else {
		$loggedin  = "Logga in";
	}
	session_write_close();**/
?>
<!DOCTYPE HTML>
<html lang="sv">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="../style/stylesheet.css">
        <script src="../js/jquery-2.1.1.min.js"></script>
        <script src="../js/scripts.js"></script>
        <title>Onlinedagbok</title>
    </head>
    
    <body>
    	<div class="wrapper">
            <div class="header">	
            	<a href="index.php">
                	<img src="../img/logo.png" class="logo"/>
                </a>
                <h1 class="welcome 3em">Onlinedagboken</h1>
                
                <div class="burgermeny bigbtn"><?php echo("&#10094 ".$_SESSION['firstname']." ".$_SESSION['surname']); ?></div>
                <ul class="burgerlist">
                    <li class="burgerstyle"><a class="nodec" href="new_pass.php">Byt Lösenord</a></li>
                    <li class="burgerstyle"><a class="nodec red" href="../scripts/logout.php">Logga ut</a></li>
                </ul>
                
            </div>