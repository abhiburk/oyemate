<?php 
require_once('../config.php');
require_once('../ImageManipulator.php');
session_start();
ob_start();
$time=time();
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

if($_REQUEST['xAction'] == 'collegePhoto'){
    $collegePhoto = $_FILES['collegePhoto']['name'];
	if($collegePhoto != ''){

if ($_FILES['collegePhoto']['error'] > 0) {
	echo "Error: " . $_FILES['collegePhoto']['error'] . "<br />";
} else {
	// array of valid extensions
	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
	// get extension of the uploaded file
	$fileExtension = strrchr($_FILES['collegePhoto']['name'], ".");
	// check if file Extension is on the list of allowed ones
	if (in_array($fileExtension, $validExtensions)) {
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($_FILES['collegePhoto']['tmp_name']);
		// resizing to 200x200
		$newImage = $manipulator->resample(700, 700);
		// saving file to uploads folder
		$manipulator->save('../uploads/'. $_FILES['collegePhoto']['name']);
		$sql = "UPDATE colleges SET userID = '".$_SESSION['userid']."', collegePhoto = '".$collegePhoto."',collegeUpdateTime='".$time."' WHERE collegeID = '".$_REQUEST['collegeID']."'";
	} 
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
		header('location:mycollege.php'); exit;
		}else{
		echo "Sorry, Please try again";	
	}
}}}

if($_REQUEST['xAction'] == 'ciPhoto'){
    $ci_Photo = $_FILES['ci_Photo']['name'];
	if($ci_Photo != ''){

if ($_FILES['ci_Photo']['error'] > 0) {
	echo "Error: " . $_FILES['ci_Photo']['error'] . "<br />";
} else {
	// array of valid extensions
	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
	// get extension of the uploaded file
	$fileExtension = strrchr($_FILES['ci_Photo']['name'], ".");
	// check if file Extension is on the list of allowed ones
	if (in_array($fileExtension, $validExtensions)) {
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($_FILES['ci_Photo']['tmp_name']);
		// resizing to 200x200
		$newImage = $manipulator->resample(700, 700);
		// saving file to uploads folder
		$manipulator->save('../uploads/'. $_FILES['ci_Photo']['name']);
		$sql = "UPDATE coaching_institute SET userID = '".$_SESSION['userid']."', ci_Photo = '".$ci_Photo."',ci_updateTime='".$time."' WHERE ci_ID = '".$_REQUEST['ci_ID']."'";
	} 
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
		header('location:mycoaching.php'); exit;
		}else{
		echo "Sorry, Please try again";	
	}
}}}
?>