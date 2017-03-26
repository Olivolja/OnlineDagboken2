
    <?php
        if(isset($_GET["i"])){
            $i = $_GET["i"];
            switch ($i) {
			case "checkpass":
				$logininfo = "Lösenorden matchar ej!";
				break; 
            case "shortusername":
				$logininfo = "För kort användarnamn, minst 4 tecken!";
				break; 
            case "longusername":
				$logininfo = "För långt användarnamn, max 15 tecken!";
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
            
                <form class="logform" name="login" action="../scripts/reguser_db.php" method="post">
                    <?php
                    if(isset($logininfo)){
                        echo ("<span class='white'>".$logininfo. "</span>");
                    }
                    ?>
                    <span class='white'><br/>Förnamn: <br/><input type="text" name="fornamn" /><br />
                    <span class='white'>Efternamn: <br/><input  type="text" name="efternamn" /><br />
                    <span class='white'>Användarnamn: <br/><input  type="text" name="username" maxlength="16" /><br />
                        <span class='white'>Lösenord: </span><br/><input type="password" name="pass1" min="6" />
                    <br />
                        <span class='white'>Lösenord : </span><br/><input type="password" name="pass2" min="6" />
                    <br /><br />
                    <input class="bigbtn" type="submit"  value="Registrera" />
                    <input class="bigbtn" type="reset"  value="Rensa" onclick="rensa()" />
                </form>  
            </div>
	</div>
        
    </body>
</html>
