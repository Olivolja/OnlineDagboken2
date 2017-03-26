<?php
	session_start();
	define("includecheck", TRUE);
	include("../scripts/db_con.php");
	
	
	
	
	// hämta blog-kategorier
	/*if ($stmt = mysqli_prepare($link, "SELECT id, category FROM blogcategories ORDER BY category ASC")){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $catid, $cat);
		while(mysqli_stmt_fetch($stmt)){
			$catArray[$catid] = $cat;  //array of result
		}
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	 }*/
	// slut hämta blog-kategorier, array skapad
	
	
		include("../templates/header.php"); 
	
		echo("<a href='index.php' class='bigbtn marginleft'>Hem</a><br/><br/>");
?>
<div class="blogbox">
        <div class='editbox'>
        
        <form action="../scripts/db_post.php" method="post">
            <input type="text" name="title" class="titlefield" placeholder="title"> <br /><br/>
            <textarea name="text" class="textfield" placeholder="type text here"></textarea> <br /> 
            <input type="submit" name="submit" value="Skapa" class="bigbtn">
        </form>
    
        </div>
    <?php
        mysqli_close($link);
    ?>
</div>
</body>
</html>