<?php
require('../config.php');
require_once('../ImageManipulator.php');
ob_start();
$time=time();

$adminid = intval($_SESSION['adminid']);
$info1=$_REQUEST['info1'];
$info2=$_REQUEST['info2'];
$coverPhoto = $_FILES['coverPhoto']['name'];



//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
	
	if($coverPhoto != ''){
		move_uploaded_file($_FILES['coverPhoto']['tmp_name'], '../uploads/'.$_FILES['coverPhoto']['name']);
		
		$sql = "INSERT INTO cover (adminID,coverPhoto,info1,info2,time) values ('".$_SESSION['adminid']."','".($coverPhoto)."','".mysql_real_escape_string($info1)."','".mysql_real_escape_string($info2)."','".$time."')";		
	} else{
		$sql = "INSERT INTO cover (adminID,info1,info2,time) values ('".$_SESSION['adminid']."','".mysql_real_escape_string($info1)."','".mysql_real_escape_string($info2)."','".$time."')";		
	}
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		header('location:coverPage.php?adminID='.$_SESSION['adminid'].''); exit;
	}else{
		echo "Sorry, Please try again";	
	}

?>