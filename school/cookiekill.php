<?php

//end cookies and logout user
			setcookie("name",$uname,time()-86400*31,"/","",0);
			setcookie("tsc",$mail,time()-86400*31,"/","",0);
			setcookie("type",$type,time()-86400*31,"/","",0);
			//direct user to index page.
			header("location:index.php");
?>