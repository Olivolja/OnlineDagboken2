	<?php
	define("includecheck", TRUE);
	include("../scripts/db_con.php");
	
	session_start();
	if(!isset($_SESSION['userid'])){
		header('location:start.php');
	}
    else{
        $suserid = $_SESSION['userid'];
    }
	include("../templates/header.php"); 


	
	//visar vissa knappar beroende på uppfyllda kriterier
		echo("<a href='index.php' class='bigbtn marginleft'>Hem</a>");
		echo ("<a class='bigbtn marginleft' href='new_post.php'>Skapa inlägg</a>");
	/*if ($_SESSION['profile'] == 1){
		echo ("<a class='bigbtn' href='adminpage.php'>Bob only</a>");
	}*/
	
	echo '<br /><br/>';
	
	//echo $_SESSION['userid'];
	session_write_close();
?>

<div class="postbox">
    <div class="listbox">
        <?php
            $stmt = mysqli_prepare($link, "SELECT id, title, text, createdate, editdate  FROM posts WHERE userid=? ORDER BY  createdate DESC");
            mysqli_stmt_bind_param($stmt, 'i', $_SESSION['userid']);
            mysqli_stmt_execute($stmt);
            //printf("Error: %s.\n", mysqli_stmt_error($stmt));
            mysqli_stmt_bind_result($stmt, $id, $title, $text, $createdate, $editdate);
            while(mysqli_stmt_fetch($stmt)){
                /*while($i <= 5){
                    $shorttitle = "";
                    $i = 0;
                    $shorttitle += $title[$i];
                    $i += 1;
                }*/
            
            echo("<a href='index.php?titleid=".$id."'><p>".$editdate." ".$title."</p></a>");
                if (isset($_SESSION['userid'])){
                    
                    //echo("<a href='editpost.php?titleid=".$id."'><img src='../img/edit.png' class='edit'/></a>");
                    
                }
                
                
                
            }
            mysqli_stmt_free_result($stmt);
            mysqli_stmt_close($stmt);
        ?>
    </div>
	<?php

	if(isset($_GET["titleid"])){
		$titleid = intval($_GET['titleid']);
		//visa en blogg
		$stmt = mysqli_prepare($link, "SELECT id, userid, title, text, createdate, editdate  FROM posts WHERE id=?");
		mysqli_stmt_bind_param($stmt, 'i', $titleid);
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_bind_result($stmt, $id,$userid, $title, $text, $createdate, $editdate);
		
		while(mysqli_stmt_fetch($stmt)){
            
            if($suserid != $userid){
                header('location:index.php');
            }
                
                
            
            echo('<div class="post">');
            echo("<a class='nodec' href='index.php?titleid=".$id."'><h2 class='rubrik'>".$title."</h2></a>");
			if (isset($_SESSION['userid'])){
				
				//echo("<a href='editpost.php?titleid=".$id."'><img src='../img/edit.png' class='edit'/></a>");
				
			}
			echo("".nl2br($text)."<br/><p class='smalltext'> Skapad: ".$createdate."<br />Senast uppdaterad: ".$editdate."</p><a href='edit_post.php?titleid=".$id."'>redigera</a>");
			
			echo("</div>");
		}
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	}
	
	/*elseif(isset($_GET["cat"])) {
		$stmt = mysqli_prepare($link, "SELECT id, title, blog, userid, editdate FROM blogs WHERE catid=? ORDER BY editdate DESC");
		mysqli_stmt_bind_param($stmt, 'i', $_GET['cat']);
		mysqli_stmt_execute($stmt);
		//printf("Error: %s.\n", mysqli_stmt_error($stmt));
		mysqli_stmt_bind_result($stmt, $id, $title, $blogtext, $userid, $editdate);
		while(mysqli_stmt_fetch($stmt)){
			echo("<a href='index.php?titleid=".$id."'><h3>".$title."</h3></a>Senast uppdaterad: ".$editdate."<br />");
			if (isset($_SESSION['userid'])){
				if ($_SESSION['userid'] == $userid || $_SESSION['profile'] == 1){
					echo("<a href='editblog.php?titleid=".$id."'>Redigera inlägg</a>");
				}
			}
			echo("<br />".nl2br($blogtext));
		}
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	}*/
	else {
		//show all posts
		$stmt = mysqli_prepare($link, "SELECT id, title, text, createdate, editdate  FROM posts WHERE userid=? ORDER BY  createdate DESC");
		mysqli_stmt_bind_param($stmt, 'i', $_SESSION['userid']);
		mysqli_stmt_execute($stmt);
		//printf("Error: %s.\n", mysqli_stmt_error($stmt));
		mysqli_stmt_bind_result($stmt, $id, $title, $text, $createdate, $editdate);
		while(mysqli_stmt_fetch($stmt)){
		echo('<div id="overlay">');
        //title
		echo("<strong><a class='nodec' href='index.php?titleid=".$id."'><span class='rubrik'>".$title."</span></a></strong><br/>");
        //datum och edit
        echo("<span class='smalltext'><a href='edit_post.php?titleid=".$id."'>redigera</a><br/> Skapad: ".$createdate."<br />Senast uppdaterad: ".$editdate."<br/></span><br />");
			if (isset($_SESSION['userid'])){
				
				//echo("<a href='editpost.php?titleid=".$id."'><img src='../img/edit.png' class='edit'/></a>");
				
			}
			echo("".nl2br($text));
			
			echo("</div>");
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