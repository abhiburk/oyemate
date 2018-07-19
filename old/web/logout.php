<?php
require("../config.php");
session_start();
$session=session_id();
$userID = intval($_SESSION['userid']);
$time=time();
$time_check=$time-3600; // 5 minutes
 
$sql="DELETE FROM user_online WHERE userID=$userID AND time<$time_check"; 
$res=mysql_query($sql); 
$sql="DELETE FROM user_online WHERE userID=$userID"; 
$res=mysql_query($sql);

//This function will destroy your session
unset($_SESSION['login']);
unset($_SESSION['userid']);
unset($_SESSION['userName']);
unset($_SESSION['session']);
unset($_SESSION['time']);

 
 
// "You are now logged out! <a href=checkregister.php>Register</a> or <a href=index.php>Login</a>";
if($_SESSION['login'] != 'success'){
	header('location:../index.php'); exit;	
}

?> 