<?php
session_start();
ob_start();
require('../config.php');
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


if($_REQUEST['xAction'] == 'deleteFee'){
	$cf_ID = intval($_REQUEST['deleteItem']);
	$sql = "DELETE FROM coaching_fee WHERE cf_ID = '".$cf_ID."'";	
	$res = mysql_query($sql) or die(mysql_error());
	header('location:coaching.php?deleteSuccess=1'); exit; }
	
	else if($_REQUEST['xAction'] == 'deleteSheet'){
		$sheetID = intval($_REQUEST['sheetID']);
		$sql1 = "DELETE FROM attend_sheets WHERE sheetID = '".$sheetID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:createAttendance.php');  exit;
	}
	else if($_REQUEST['xAction'] == 'deleteSubject'){
		$subjectID = intval($_REQUEST['subjectID']);
		$sheetID = intval($_REQUEST['sheetID']);
		$sql1 = "DELETE FROM attend_subjects WHERE subjectID = '".$subjectID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:singleSheet.php?sheetID='.$sheetID.''); exit;
	}
	else if($_REQUEST['xAction'] == 'deleteEvent'){
		$eventID = intval($_REQUEST['eventID']);
		$sql1 = "DELETE FROM events WHERE eventID = '".$eventID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:event.php'); exit;
	}
	else if($_REQUEST['xAction'] == 'removeCo')
	{   $coID=$_REQUEST['coordinateID'];
		$webName=$_REQUEST['webName'];
		$sql1 = "DELETE FROM event_co WHERE coID = '".$coID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:../event/'.$webName.''); exit;
	}
	else if($_REQUEST['xAction'] == 'deleteupload')
	{   $uID=$_REQUEST['uID'];
		$sql1 = "DELETE FROM upload WHERE uploadID = '".$uID."'";	
		mysql_query($sql1) or die(mysql_error());
		header('location:home.php?uID='.$uID.''); exit;
	}
	else{
		echo "Sorry, Please try again";	
	}

?>