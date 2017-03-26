<?php
	session_start();
	define("includecheck", TRUE);
	include("../scripts/db_con.php");
	
    include("../templates/header.php"); 
	
    echo("<a href='index.php' class='bigbtn marginleft'>Home</a><br/><br/>");
?>
<div class="blogbox">
    <div class="editbox" id="passbox">
        <form name="login" action="../scripts/db_newpass.php" method="post">     
            <span class="white"><br/>Nuvarande lösen:<br/><input type="password" name="oldpass"   /></span>
            <span class="whit"><br/>Lösenord:<br/><input type="password" name="pass1" /></span>
            <span class="white"><br/>upprepa lösenord:<br/><input type="password" name="pass2"/></span>
            <span class="white"><br/>
            <input type="submit" class="bigbtn" value="Save" /></td></tr>
        </form>
    </div>
	<?php
    
        mysqli_close($link);
    ?>
</div>
</body>
</html>