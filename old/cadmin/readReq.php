<?php
session_start();
ob_start();
require('../config.php');
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


	$reqID = intval($_REQUEST['reqID']);
	$sql = "UPDATE request SET status='read' WHERE reqID = '".$reqID."'";	
	$res = mysql_query($sql) or die(mysql_error());
	//header('location:celebrityList.php?adminID='.$_SESSION['adminid'].''); 
	

?>