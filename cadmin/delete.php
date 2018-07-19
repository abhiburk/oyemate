<?php
session_start();
ob_start();
require('../config.php');
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


if($_REQUEST['xAction'] == 'deleteCollege'){
	$sql = "DELETE FROM colleges WHERE collegeID = '".$_REQUEST['collegeID']."'";	
	$res = mysql_query($sql) or die(mysql_error());
	header('location:colleges.php?adminID='.$_SESSION['adminid'].''); exit; }
	
	else if($_REQUEST['xAction'] == 'deleteBranch'){
		$branchID = intval($_REQUEST['branchID']);
		$sql1 = "DELETE FROM branch WHERE branchID = '".$branchID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:addCourseBranch.php?adminID='.$_SESSION['adminid'].''); exit;
	}
	else if($_REQUEST['xAction'] == 'deleteCover'){
		$coverID = intval($_REQUEST['coverID']);
		$sql1 = "DELETE FROM cover WHERE coverID = '".$coverID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:coverPage.php?adminID='.$_SESSION['adminid'].'');  exit;
	}
	
	else if($_REQUEST['xAction'] == 'deleteUser'){
		$userID = intval($_REQUEST['userID']);
		$sql1 = "DELETE FROM user WHERE userID = '".$userID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:userList.php?adminID='.$_SESSION['adminid'].''); exit;
	}
	else if($_REQUEST['xAction'] == 'deletetlCmnt')
	{   $timelineID=$_REQUEST['timelineID'];
		$cmntID = intval($_REQUEST['cmntID']);
		$sql1 = "DELETE FROM timelinecmnt WHERE cmntID = '".$cmntID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:tlCmnt.php?timeline&timelineID='.$timelineID.''); exit;
	}
	else if($_REQUEST['xAction'] == 'deletetimelinePost')
	{   $timelineID=$_REQUEST['timelineID'];
		$sql1 = "DELETE FROM timeline WHERE timelineID = '".$timelineID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:tlCmnt.php?timeline&timelineID='.$timelineID.''); exit;
	}
	else{
		echo "Sorry, Please try again";	
	}

?>