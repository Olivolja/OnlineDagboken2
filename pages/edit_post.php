
<?php
	define("includecheck", TRUE);
	include("../scripts/db_con.php");
	/*if(isset($_GET["cat"])){
		$selectcat = $_GET["cat"];
	}*/
	
	
	
	// hämta blog-kategorier
	/*if ($stmt = mysqli_prepare($link, "SELECT id, category FROM blogcategories ORDER BY category ASC")){
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $catid, $cat);
		while(mysqli_stmt_fetch($stmt)){
			$categoryArray[$catid] = $cat;  //array of result
		}
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	}*/
	// slut hämta blog-kategorier, array skapad
	
	session_start();
	include("../templates/header.php"); 
	session_write_close();
?>
<div id="catbox">

	<?php
    
   /* foreach($categoryArray as $key => $value){
    	echo("<a href='index.php?cat=".$key."'>".$value."</a><br />"); 
    }*/
    
    ?>
</div>

<div class="postbox">

	<?php
    echo("<a href='index.php' class='bigbtn marginleft'>Hem</a><br/><br/>");
    if(isset($_GET["titleid"])){
		$getpostid = intval($_GET['titleid']);
		//hämta info för ett inlägg
		$stmt = mysqli_prepare($link, "SELECT id, userid, title, text, createdate, editdate  FROM posts WHERE id=?");
		mysqli_stmt_bind_param($stmt, 'i', $getpostid);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_bind_result($stmt, $id, $userid, $title, $text, $createdate, $editdate);
		if(mysqli_stmt_fetch($stmt)){
            
			echo("<div class='editbox'>Senast uppdaterad: ".$editdate."<br />");
			if (isset($_SESSION['userid']) && $_SESSION['userid'] == $userid){
				?>
                
                        <form action="../scripts/db_editpost.php" method="post">

                            <input type="hidden" name="id" value="<?php echo ($getpostid); ?>">
                            <input type="text" name="title" class="titlefield" value="<?php echo($title); ?>"> <br /><br/>
                            <textarea name="text" class="textfield" ><?php echo($text); ?></textarea> <br />
                            <!--<select name="catid">
                            <?php/*

                            foreach($categoryArray as $key => $value){
                                if($key == $catid){
                                    echo("<option value='".$key."' selected >".$value."</option>");
                                }
                                else{
                                    echo("<option value='".$key."' >".$value."</option>");
                                }
                            }*/
                            ?>
                            </select>-->
                            <input type="submit" name="submit" value="Uppdatera" class="bigbtn">
                        </form>
                        
                        <form action="../scripts/db_deletepost.php" class="" method="post">
                            <input type="hidden" name="id" value="<?php echo ($getpostid); ?>">
                            <input type="hidden" name="userid" value="<?php echo ($userid); ?>">
                            <input type="submit" name="submit" value="Ta Bort" class="bigbtn">
                        </form>
                    </div>
               
                <?php
			}
			/*
			elseif (isset($_SESSION['profile']) && $_SESSION['profile'] == 1) {
				echo $title;
				echo nl2br($blogtext);
				?>
				<form action="../scripts/deletepost.php" method="post">
					<input type="hidden" name="blogid" value="<?php echo ($getblogid); ?>">
					<input type="submit" name="submit" value="Delete" class="bigbtn">
				</form>
				<?php
			}
			*/
		//echo($blogtext."<br />");
		}
	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close($stmt);
	}

	?>
</div>
<?php


	mysqli_close($link);

?>

</body>
</html>