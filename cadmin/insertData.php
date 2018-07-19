<?php
require('../config.php');
require_once('../ImageManipulator.php');
session_start();
ob_start();
$time=time();

$adminid = intval($_SESSION['adminid']);

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;



if($_REQUEST['xAction']=='improveus'){
$improveID=$_REQUEST['improveID'];
$replyMessage=$_REQUEST['replyMessage'];
$improveMessage=$_REQUEST['improveMessage'];
$userID=$_REQUEST['userID'];
	$sql_add="UPDATE improve_us SET replyMessage='".$replyMessage."',replyTime='".$time."' WHERE improveID='".$improveID."'";
	$res = mysql_query($sql_add) or die(mysql_error());
	
	//if($res > 0){
//		header('location:improveus.php?addSuccess=1'); exit;
//	}else{
//		header('location:improveus.php?addFailed=1'); exit;
//	}
					$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$userID."'");
					($userInfo=mysqli_fetch_assoc($sql));
					$userName=$userInfo['userName'];
					$to=$userInfo['userEmail'];
	
$body= '<p>Thank you, <b>'.$userName.'</b> for writing to us. You wrote to us <br/>
		'.$improveMessage.' <br/>
		'.$replyMessage.'<br/>
		 Thank you</p>';
		//echo $body;exit;
		
		$from = "oyemate";
		$url = "http://www.oyemate.com/";
		
		$subject = "Reply to your improve us message";
		$headers1 = "From: $from\n";
		$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers1 .= "X-Priority: 1\r\n";
		$headers1 .= "X-MSMail-Priority: High\r\n";
		$headers1 .= "X-Mailer: Just My Server\r\n";
		
		$sentmail = mail( $to, $subject, $body, $headers1 );
	
		
	//If the message is sent successfully, display sucess message otherwise display an error message.
	if($sentmail==1)
	{
			header('LOCATION:improveus.php?emailSuccess=1');exit;
		//echo "<span style='color:#2EE834;'> Your Password Has Been Sent To Your Email Address.</span>";
	}
		else
		{
		if($_POST['userEmail']!="")
		header('LOCATION:improveus.php?emailFail=1');exit;
		//echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
	}
}



if($_REQUEST['xAction']=='addCollege'){
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
		}
		

	$sql_colg = "INSERT INTO colleges (adminID,instituteName,collegePhoto,collegeCode,collegeAddress,collegeWebsite,collegeContact,collegeDirector,collegeUpdateTime) 
	VALUES ('".$adminid."','".mysql_real_escape_string($instituteName)."','".mysql_real_escape_string($collegePhoto)."','".mysql_real_escape_string($collegeCode)."',
	'".mysql_real_escape_string($collegeAddress)."','".mysql_real_escape_string($collegeWebsite)."',
	'".$collegeContact."','".$collegeDirector."','".$time."')";
	}}
	
	else {
	$sql_colg = "INSERT INTO colleges (adminID,instituteName,collegeCode,collegeAddress,collegeWebsite,collegeContact,collegeDirector,collegeUpdateTime) 
	VALUES ('".$adminid."','".mysql_real_escape_string($instituteName)."','".mysql_real_escape_string($collegeCode)."',
	'".mysql_real_escape_string($collegeAddress)."','".mysql_real_escape_string($collegeWebsite)."',
	'".$collegeContact."','".$collegeDirector."','".$time."')";
		
		}
		$res1_colg = mysql_query($sql_colg) or die(mysql_error());
	if($res1_colg==true){
		header('location:addColleges.php'); exit;
		}else{
		echo "Sorry, Please try again";	
	

}
}

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
	VALUES ('".$userID."','".mysql_real_escape_string($instituteName)."','".mysql_real_escape_string($collegePhoto)."',
	'".mysql_real_escape_string($collegeCode)."','".mysql_real_escape_string($collegeAddress)."','".mysql_real_escape_string($collegeWebsite)."',
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