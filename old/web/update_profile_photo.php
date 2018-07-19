<?php 
require_once('../config.php');
require_once('../ImageManipulator.php');
session_start();
ob_start();
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

if($_REQUEST['xAction'] == 'userImg'){
    $userImg = $_FILES['userImg']['name'];
	
	if($userImg != ''){

if ($_FILES['userImg']['error'] > 0) {
	echo "Error: " . $_FILES['userImg']['error'] . "<br />";
} else {
	// array of valid extensions
	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
	// get extension of the uploaded file
	$fileExtension = strrchr($_FILES['userImg']['name'], ".");
	// check if file Extension is on the list of allowed ones
	if (in_array($fileExtension, $validExtensions)) {
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($_FILES['userImg']['tmp_name']);
		// resizing to 200x200
		$newImage = $manipulator->resample(500, 500);
		// saving file to uploads folder
		$manipulator->save('../uploads/'. $_FILES['userImg']['name']);
		$sql = "UPDATE user SET userID = '".$_SESSION['userid']."', userImg = '".$userImg."' WHERE userID = '".$_SESSION['userid']."'";
	} 
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
		header('location:myprofile.php'); exit;
		}else{
		echo "Sorry, Please try again";	
	}
}}}
?>