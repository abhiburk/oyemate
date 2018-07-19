<?php
require('../config.php');
require_once('../ImageManipulator.php');
session_start();
ob_start();
$time=time();

$adminid = intval($_SESSION['adminid']);

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


if($_REQUEST['xAction']=='updateCollege'){
$collegeID=$_REQUEST['collegeID'];
$instituteName=$_REQUEST['instituteName'];
$collegeAddress=$_REQUEST['collegeAddress'];
$collegeContact=$_REQUEST['collegeContact'];
$collegeWebsite=$_REQUEST['collegeWebsite'];
$collegeDirector=$_REQUEST['collegeDirector'];
$collegeCode=$_REQUEST['collegeCode'];

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
		
	$sql11 = "UPDATE colleges SET collegePhoto='".$collegePhoto."',instituteName='".mysql_escape_string($instituteName)."',
	collegeAddress='".mysql_escape_string($collegeAddress)."',collegeContact='".mysql_escape_string($collegeContact)."',collegeWebsite='".mysql_escape_string($collegeWebsite)."'
	,collegeDirector='".mysql_escape_string($collegeDirector)."',collegeCode='".$collegeCode."' WHERE collegeID = '".$collegeID."'";	

	}else {
	$sql11 = "UPDATE colleges SET instituteName='".mysql_escape_string($instituteName)."',collegeAddress='".mysql_escape_string($collegeAddress)."',
	collegeContact='".mysql_escape_string($collegeContact)."',collegeWebsite='".mysql_escape_string($collegeWebsite)."'
	,collegeDirector='".mysql_escape_string($collegeDirector)."',collegeCode='".mysql_escape_string($collegeCode)."' WHERE collegeID = '".$collegeID."'";	
	}
	$res11 = mysql_query($sql11) or die(mysql_error());
	if($res11){
		header('location:colleges.php?collegeID='.$_REQUEST['collegeID'].''); exit;
		}else{
		echo "Sorry, Please try again";	
	}
}
}
}


if($_REQUEST['xAction']=='saveReqInfo'){
$userID=$_REQUEST['userID'];
$instituteName=$_REQUEST['instituteName'];
$collegeAddress=$_REQUEST['collegeAddress'];
$collegeContact=$_REQUEST['collegeContact'];
$collegeWebsite=$_REQUEST['collegeWebsite'];
$collegeDirector=$_REQUEST['collegeDirector'];
$collegeCode=$_REQUEST['collegeCode'];

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
		
	$sql11 = "INSERT INTO colleges (userID,instituteName,collegePhoto,collegeCode,collegeAddress,collegeWebsite,collegeContact,collegeDirector,collegeUpdateTime) 
	VALUES ('".$userID."','".$instituteName."','".$collegePhoto."','".$collegeCode."','".$collegeAddress."','".$collegeWebsite."',
	'".$collegeContact."','".$collegeDirector."','".$time."')";
	$res11 = mysql_query($sql11) or die(mysql_error());
	}
	$sql11 = "UPDATE user SET instituteName='".$instituteName."' WHERE userID = '".$userID."'";	
	$res11 = mysql_query($sql11) or die(mysql_error());
	if($res11){
		header('location:reqList.php?colg_reqID='.$_REQUEST['colg_reqID'].''); exit;
		}else{
		echo "Sorry, Please try again";	
	}
}
}
}

if($_REQUEST['xAction']=='addCourseBranch'){
$courseName=$_REQUEST['courseName'];
$branchName=$_REQUEST['branchName'];
$courseID=$_REQUEST['courseID'];
	if($courseName!='') {
	$sql_add="INSERT INTO courses (courseName) VALUES 
	('".$courseName."')";
	}else{
	$sql_add="INSERT INTO branch (courseID,branchName) VALUES 
	('".$courseID."','".$branchName."')";
		}
	$res = mysql_query($sql_add) or die(mysql_error());
	
	if($res > 0){
		header('location:addCourseBranch.php?addSuccess=1'); exit;
	}else{
		header('location:addCourseBranch.php?addFailed=1'); exit;
	}
}
else
if($_REQUEST['xAction'] == 'branchUpdate'){
	
	$branchID = ($_REQUEST['branchID']);
	$branchName = ($_REQUEST['branchName']);
	$sqlbranchUpdate = "UPDATE branch SET branchName='".$branchName."' WHERE branchID = '".$branchID."'";	
	$res = mysql_query($sqlbranchUpdate) or die(mysql_error());
	if($res ==1){
		header('location:addCourseBranch.php?updateSuccess=1'); exit;
	}else{
		header('location:addCourseBranch.php?updateFailed=1'); exit;
	}
}
else
if($_REQUEST['xAction'] == 'courseUpdate'){
	
	$courseID = ($_REQUEST['courseID']);
	$courseName = ($_REQUEST['courseName']);
	$sqlcourseUpdate = "UPDATE courses SET courseName='".$courseName."' WHERE courseID = '".$courseID."'";	
	$res = mysql_query($sqlcourseUpdate) or die(mysql_error());
	if($res ==1){
		header('location:addCourseBranch.php?updateSuccess=1'); exit;
	}else{
		header('location:addCourseBranch.php?updateFailed=1'); exit;
	}
}	
else
if($_REQUEST['xAction'] == 'readStatus'){
	
	$colg_reqID = ($_REQUEST['colg_reqID']);
	$sql = "UPDATE college_request SET readStatus='read' WHERE colg_reqID = '".$colg_reqID."'";	
	$res = mysql_query($sql) or die(mysql_error());
}
if($_REQUEST['xAction'] == 'deleteunread'){
	
	$colg_reqID = ($_REQUEST['colg_reqID']);
	$sql = "UPDATE request SET deleteReq='yes(read)' WHERE colg_reqID = '".$colg_reqID."'";	
	$res = mysql_query($sql) or die(mysql_error());
}
else
if($_REQUEST['xAction'] == 'requestAccept'){
	
	$colg_reqID = ($_REQUEST['colg_reqID']);
	$userID = ($_REQUEST['userID']);
	$sql = "UPDATE college_request SET acceptStatus='accepted' WHERE colg_reqID = '".$colg_reqID."'";
	$res = mysql_query($sql) or die(mysql_error());
}else
if($_REQUEST['xAction'] == 'requestReject'){
	
	$colg_reqID = ($_REQUEST['colg_reqID']);
	$userID = intval($_REQUEST['userID']);
	$sql = "UPDATE college_request SET acceptStatus='rejected' WHERE colg_reqID = '".$colg_reqID."'";
	$res = mysql_query($sql) or die(mysql_error());
}
else
if($_REQUEST['xAction'] == 'faqStatus'){
	$faqID = ($_REQUEST['faqID']);
	$sql = "UPDATE faq SET readStatus='read' WHERE faqID = '".$faqID."'";
	$res = mysql_query($sql) or die(mysql_error());
}
else
if($_REQUEST['xAction'] == 'answerQ'){
	$faqID = ($_REQUEST['faqID']);
	$answer = ($_REQUEST['answer']);
	$sql = "UPDATE faq SET answer='".$answer."' WHERE faqID = '".$faqID."'";
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		header('location:faqList.php?faqID='.$faqID.''); exit;
		}
}

?>