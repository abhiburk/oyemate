<?php 
require_once('../config.php');
require_once('../ImageManipulator.php');
session_start();
ob_start();
$time=time();
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;



if($_REQUEST['xAction']=='eventPost'){
 $eventID = $_REQUEST['eventID'];
  $eventTextPost = $_REQUEST['eventTextPost'];
    $eventPostPhoto = $_FILES['eventPostPhoto']['name'];
	if($eventPostPhoto != ''){

if ($_FILES['eventPostPhoto']['error'] > 0) {
	echo "Error: " . $_FILES['eventPostPhoto']['error'] . "<br />";
} else {
	// array of valid extensions
	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
	// get extension of the uploaded file
	$fileExtension = strrchr($_FILES['eventPostPhoto']['name'], ".");
	// check if file Extension is on the list of allowed ones
	if (in_array($fileExtension, $validExtensions)) {
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($_FILES['eventPostPhoto']['tmp_name']);
		// resizing to 200x200
		$newImage = $manipulator->resample(700, 700);
		// saving file to uploads folder
		$manipulator->save('../uploads/'. $_FILES['eventPostPhoto']['name']);
		}}
		$sql=$conn->prepare("INSERT INTO event_posts (userID,eventID,eventTextPost,eventPostPhoto,eventPostTime) VALUES (?,?,?,?,?)");
 		$sql->execute(array($_SESSION['userid'],$eventID,$eventTextPost,$eventPostPhoto,$time)); 
	} 
	else{
		$sql=$conn->prepare("INSERT INTO event_posts (userID,eventID,eventTextPost,eventPostTime) VALUES (?,?,?,?)");
 		$sql->execute(array($_SESSION['userid'],$eventID,$eventTextPost,$time));
		
	}
	
if($sql > 0) {
		header('location:myevent.php?eventID='.$eventID.'&eventSuccess=1'); exit;
	}else{
		header('location:myevent.php?eventID='.$eventID.'&eventFail=1'); exit;
	}
}


if($_REQUEST['xAction']=='eventInfo'){
$webName=$_REQUEST['webName'];
$eventID=$_REQUEST['eventID'];
$eventContact=$_REQUEST['eventContact'];
$textMessage=$_REQUEST['textMessage'];
	
	$sql =$conn->prepare( "UPDATE events SET eventContact = :eventContact,
	textMessage = :textMessage,webName = :webName,evenUpdateTime=:evenUpdateTime WHERE eventID = '".$_REQUEST['eventID']."' ");
	$sql->execute(array(':eventContact'=>$eventContact,':textMessage'=>$textMessage,':webName'=>$webName,':evenUpdateTime'=>$time));
	
	if($sql > 0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Changes Save Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Make Chnages </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='eventRegister'){
$compEID=$_REQUEST['compEID'];
$eventID=$_REQUEST['eventID'];
$participantContact=$_REQUEST['participantContact'];
$partner1=$_REQUEST['part1'];
$partner2=$_REQUEST['part2'];
$partner3=$_REQUEST['part3'];
$partner4=$_REQUEST['part4'];
$partner5=$_REQUEST['part5'];

	
	$sql=$conn->prepare("INSERT INTO event_register_user (userID,eventID,compEID,participantContact,partner1,partner2,partner3,partner4,partner5,eventRegisterTime) 
	VALUES (?,?,?,?,?,?,?,?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$eventID,$compEID,$participantContact,$partner1,$partner2,$partner3,$partner4,$partner5,$time)); 
		
	if($sql > 0){
		$sqlMsg=mysqli_query($dbconfig,"SELECT * FROM events WHERE eventID='".$eventID."'");
		$msgRow=mysqli_fetch_assoc($sqlMsg);
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">'.$msgRow['textMessage'].'</h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Could not Register please try again </h3>
      		</div>'; exit;
	}
}
if($_REQUEST['xAction']=='compInfo'){
$eventID=$_REQUEST['eventID'];
$compName=$_REQUEST['compName'];
$compFee=$_REQUEST['compFee'];
	
	$sql=$conn->prepare("INSERT INTO comp_fee (userID,eventID,compName,compFee,compAddTime) VALUES (?,?,?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$eventID,$compName,$compFee,$time));
	
	if($sql > 0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Changes Save Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Make Chnages </h3>
      		</div>'; exit;
	}
}
	
	
if($_REQUEST['xAction']=='updateEventFee'){
$compEID=$_REQUEST['compEID'];
$compName=$_REQUEST['compName'];
$compFee=$_REQUEST['compFee'];

	$sql=$conn->prepare( "UPDATE comp_fee SET compName = :compName,
	compFee = :compFee WHERE compEID = '".$compEID."'  ");
	$sql->execute(array(':compName'=>$compName,':compFee'=>$compFee));

		if($sql > 0){
		echo '<div style="background-color:#0C0;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Changes Save Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Failed to Make Chnages </h3>
      		</div>'; exit;
	}
	}



if($_REQUEST['xAction']=='createEvent'){
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
		
		} 
}
	$sql=$conn->prepare("INSERT INTO events (userID,eventName,eventPhoto,createTime) VALUES (?,?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$eventName,$eventPhoto,$time));
	
	} else {
	$sql=$conn->prepare("INSERT INTO events (userID,eventName,createTime) VALUES (?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$eventName,$time));
	
	}
if($sql > 0) {
		header('location:eventlist.php?eventSuccess=1'); exit;
	}else{
		header('location:eventlist.php?eventFail=1'); exit;
	}
}



if($_REQUEST['xAction']=='updateEventPhoto'){
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
		
		} 
}
		$sql=$conn->prepare( "UPDATE events SET eventName=:eventName,eventPhoto=:eventPhoto WHERE eventID='".$_REQUEST['eventID']."'  ");
		$sql->execute(array(':eventName'=>$eventName,':eventPhoto'=>$eventPhoto));
		}else {
		$sql=$conn->prepare( "UPDATE events SET eventName=:eventName WHERE eventID='".$_REQUEST['eventID']."'  ");
		$sql->execute(array(':eventName'=>$eventName));	
		} 
	
if($sql > 0) {
		header('location:myevent.php?eventID='.$_REQUEST['eventID'].'&eventUpdateSuccess=1'); exit;
	}else{
		header('location:myevent.php?eventID='.$_REQUEST['eventID'].'&eventUpdateFail=1'); exit;
	}
}

?>