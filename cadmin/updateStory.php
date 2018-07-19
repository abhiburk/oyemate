<?php
require('../config.php');
require_once('../ImageManipulator.php');
ob_start();
$time=time();

$adminid = intval($_SESSION['adminid']);
$cID = ($_REQUEST['cID']);
$cName = ($_REQUEST['cName']);
$cEmail = ($_REQUEST['cEmail']);
$cInfo = ($_REQUEST['cInfo']);

$workInfo = ($_REQUEST['workInfo']);
$tag = ($_REQUEST['tag']);
$day = ($_REQUEST['day']);
$month = ($_REQUEST['month']);
$year = ($_REQUEST['year']);
$recommend = ($_REQUEST['recommend']);
$workPhoto = $_FILES['workPhoto']['name'];
$cPhoto = $_FILES['cPhoto']['name'];

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

if($workPhoto and $cPhoto != '') 
{
if ($_FILES['workPhoto']['error']> 0) 
		echo "Error: " . $_FILES['workPhoto']['error']. "<br />";
 		
		else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['workPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['workPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(1000, 1000);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['workPhoto']['name']);
				}
		 }
		
		if ($_FILES['cPhoto']['error']> 0) 
		echo "Error: " . $_FILES['cPhoto']['error']. "<br />";
 		else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['cPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['cPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(500, 500);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['cPhoto']['name']);
				}
		}  
		
		$sql = "UPDATE celebrity SET adminID ='".$_SESSION['adminid']."',workPhoto='".($workPhoto)."',cPhoto='".($cPhoto)."',cName='".mysql_real_escape_string($cName)."',cEmail='".mysql_real_escape_string($cEmail)."',
		cInfo='".mysql_real_escape_string($cInfo)."',workInfo='".mysql_real_escape_string($workInfo)."',tag='".mysql_real_escape_string($tag)."',
		day='".($day)."',month='".($month)."',year='".($year)."',
		recommend='".mysql_real_escape_string($recommend)."',time='".$time."' WHERE cID='".$cID."'  ";		
	
}

else if($workPhoto != '')
{
		if ($_FILES['workPhoto']['error'] > 0) 
		echo "Error: " . $_FILES['workPhoto']['error'] . "<br />";
 		else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['workPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['workPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(1000, 1000);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['workPhoto']['name']);
				}
		 }
		 
		$sql = "UPDATE celebrity SET adminID ='".$_SESSION['adminid']."', workPhoto='".($workPhoto)."',cName='".mysql_real_escape_string($cName)."',cEmail='".mysql_real_escape_string($cEmail)."',
		cInfo='".mysql_real_escape_string($cInfo)."',workInfo='".mysql_real_escape_string($workInfo)."',tag='".mysql_real_escape_string($tag)."',
		day='".($day)."',month='".($month)."',year='".($year)."',
		recommend='".mysql_real_escape_string($recommend)."',time='".$time."' WHERE cID='".$cID."'  ";		
		
}	
else  if($cPhoto != '')
	{
 	if ($_FILES['cPhoto']['error'] > 0) 
	echo "Error: " . $_FILES['cPhoto']['error'] . "<br />";
	 	else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['cPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
			{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['cPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(500, 500);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['cPhoto']['name']);
				
		$sql = "UPDATE celebrity SET adminID='".$_SESSION['adminid']."',cPhoto='".($cPhoto)."',cName='".mysql_real_escape_string($cName)."',cEmail='".mysql_real_escape_string($cEmail)."',
		cInfo='".mysql_real_escape_string($cInfo)."',workInfo='".mysql_real_escape_string($workInfo)."',tag='".mysql_real_escape_string($tag)."',
		day='".mysql_real_escape_string($day)."',month='".mysql_real_escape_string($month)."',year='".mysql_real_escape_string($year)."',
		recommend='".mysql_real_escape_string($recommend)."',time='".$time."' WHERE cID='".$cID."'  ";		
	 		}
	 	}
	}
	  else
	{
		$sql = "UPDATE celebrity SET adminID='".$_SESSION['adminid']."',cName='".mysql_real_escape_string($cName)."',cEmail='".mysql_real_escape_string($cEmail)."',
		cInfo='".mysql_real_escape_string($cInfo)."',workInfo='".mysql_real_escape_string($workInfo)."',tag='".mysql_real_escape_string($tag)."',
		day='".mysql_real_escape_string($day)."',month='".mysql_real_escape_string($month)."',year='".mysql_real_escape_string($year)."',
		recommend='".mysql_real_escape_string($recommend)."',time='".$time."' WHERE cID='".$cID."'  ";		
	}
	
	
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
				header('location:celebrityList.php'); exit;
			}else
			{
			echo "Sorry, Please try again";	
			}


?>