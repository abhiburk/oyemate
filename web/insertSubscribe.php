<?php
require '../config.php';
session_start();
ob_start();
$time=time();

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


if($_REQUEST['xAction']=='subscribe'){

	$match=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN subscribes ON user.userID=subscribes.userID 
	WHERE user.userID='".$_SESSION['userid']."'");
	$matchCount=mysqli_num_rows($match);
	$rowMatch=mysqli_fetch_assoc($match);
	if($matchCount==true){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Email Already Subscribed with us</h3>
      		</div>'; exit;
	}else {
	
  	$addCo=("INSERT INTO subscribes (userID,subTime) VALUES 
	('".$_SESSION['userid']."','".$time."')");
 
	$coRow=mysql_query($addCo) or die (mysql_error());
	if($coRow){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">You have subscribed Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to subscribe,please try again. </h3>
      		</div>'; exit;
	}

} 
}

if($_REQUEST['xAction']=='unsubscribe'){

	$match=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN subscribes ON user.userID=subscribes.userID 
	WHERE user.userID='".$_SESSION['userid']."'");
	$matchCount=mysqli_num_rows($match);
	$rowMatch=mysqli_fetch_assoc($match);
	
  	$addCo=("DELETE FROM subscribes WHERE userID='".$_SESSION['userid']."'");
	$coRow=mysql_query($addCo) or die (mysql_error());
	if($coRow){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">You have unsubscribed Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to unsubscribe,please try again. </h3>
      		</div>'; exit;
	}

} 
