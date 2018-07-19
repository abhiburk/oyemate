<?php
require("../config.php");
session_start();
$session=session_id();
$adminid = intval($_SESSION['adminid']);
$time=time();
$time_check=$time-3600; // 1 hour
 
$sql="DELETE FROM admin_visit WHERE adminID=$adminid AND time<$time_check"; 
$res=mysql_query($sql); 
$sql="DELETE FROM admin_visit WHERE adminID=$adminid"; 
$res=mysql_query($sql);


//This function will destroy your session
unset($_SESSION['login']);
unset($_SESSION['adminid']);
unset($_SESSION['adminUname']);
unset($_SESSION['session']);
unset($_SESSION['time']);

 
 
// "You are now logged out! <a href=checkregister.php>Register</a> or <a href=index.php>Login</a>";
if($_SESSION['login'] != 'success'){
	header('location:index.php'); exit;	
}

?> 