<?php 
require_once('../config.php');
require_once('../ImageManipulator.php');
session_start();
ob_start();
$time=time();
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;



	

if($_REQUEST['xAction']=='updateEvent'){
 $eventName = $_REQUEST['eventName'];
    $eventPhoto = $_FILES['eventPhoto']['name'];
	if($eventPhoto != ''){

if ($_FILES['eventPhoto']['error'] > 0) {
	echo "Error: " . $_FILES['eventPhoto']['error'] . "<br />";
} else {
	// array of valid extensions
	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
	// get extension of the uploaded file
	$fileExtension = strrchr($_FILES['eventPhoto']['name'], ".");
	// check if file Extension is on the list of allowed ones
	if (in_array($fileExtension, $validExtensions)) {
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($_FILES['eventPhoto']['tmp_name']);
		// resizing to 200x200
		$newImage = $manipulator->resample(700, 700);
		// saving file to uploads folder
		$manipulator->save('../uploads/'. $_FILES['eventPhoto']['name']);
	if($eventPhoto != '')	{
		$create_event=("UPDATE events SET eventName='".$eventName."',eventPhoto='".$eventPhoto."' WHERE eventID='".$_REQUEST['eventID']."'");
		}else {
  	$create_event=("UPDATE events SET eventName='".$evenName."' WHERE eventID='".$_REQUEST['eventID']."'");
	} }
	$event=mysql_query($create_event);
if($event > 0) {
		header('location:event.php?eventUpdateSuccess=1'); exit;
	}else{
		header('location:event.php?eventUpdateFail=1'); exit;
	}
}}}

?>