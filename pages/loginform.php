<?php

	session_start();

	if (isset($_SESSION['passhits']) && $_SESSION['passhits']) {
		echo($_SESSION['passhits']);
	}
	
	session_write_close();
	
	
		
	
	define("includecheck", TRUE);
	
	
	$stil = "style/style.css";
	
	if(isset($_GET["i"])){
		$i = $_GET["i"];
		switch ($i) {
			case "nouser":
				$logininfo = "Användare finns ej!";
				break;
			case "passw":
				$logininfo = "Fel lösenord!";
				break;
			case "login":
				$logininfo = "Logga in!";
				break;
			case "passhits":
				$logininfo = "Tries overpassed limit";
				break;
			case "newpass":
				$logininfo = "Logga in med nytt lösen!";
				break; 
			 case "inactive":
				$logininfo = "Användare ej aktiv!";
				break;       
		} 
	}
	
?>
	
	<!DOCTYPE HTML>
	<html lang="sv">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        	<link rel="stylesheet" type="text/css" href="../style/stylesheet.css">
        	<title>Onlinedagbok</title>
        </head>
        <body>
            
            <div class="loginwrapper">
				
                <a href="start.php"><img src="../img/logo.png" alt="logo" class="mainlogo"/> </a> 
                <h1 class="welcome">Välkommen till Onlinedagboken</h1>
                <div class="loginbox">
                
                    <form class="logform" name="login" action="../scripts/login_db.php" method="post">
                        <?php
                            if(isset($logininfo)){
                                echo ("<span class='white'>".$logininfo. "</span>");
                            }
                        ?>
                        <span class="white"><br/>Användarnamn: </span><br /><input id="user" type="text" name="username" /><br />
                        <span class="white">Lösenord: </span><br /><input type="password" name="password" />
                        <br /><br />
                        <input type="submit" class="bigbtn" value="Logga in" />
                        <input type="reset" class="bigbtn" value="Rensa" onclick="rensa()" />
                    </form>
                </div>
            </div>         
        </body>
	</html>