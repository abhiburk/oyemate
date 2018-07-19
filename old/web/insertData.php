<?php
require '../config.php';
session_start();
ob_start();
$time=time();

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
if(isset($_POST['get_option']))
{
 $courseName = $_POST['get_option'];
 $find=mysql_query("SELECT * FROM courses LEFT JOIN branch ON courses.courseID=branch.courseID where courses.courseName ='".$courseName."'");
 while($row=mysql_fetch_array($find))
 {
  echo "<option>".$row['branchName']."</option>";
 }echo '<option>Other</option>';
 exit;
}

if($_REQUEST['xAction']=='updateupload'){
$uploadID=$_REQUEST['uploadID'];
$detail=$_REQUEST['detail'];

	$sql_sheet_update = "UPDATE upload SET detail = '".mysql_real_escape_string($detail)."'
	WHERE uploadID = '".$uploadID."' ";
	$res_sheet = mysql_query($sql_sheet_update) or die(mysql_error());
if($res_sheet > 0) {
		echo '<div style="background-color:#0C0;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Data Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Failed to Update Data </h3>
      		</div>'; exit;
	}
}



if($_REQUEST['xAction']=='unhifi'){
	$hifiTo=$_REQUEST['hifiTo'];
	$hifiWith=$_REQUEST['hifiWith'];
	//if($hifiTo==$hifiWith)
	
  	$addCo=("DELETE FROM hifi_user WHERE hifiTo=$hifiTo AND hifiBy='".$_SESSION['userid']."'");
 	
	$update=mysqli_query($dbconfig,"UPDATE matchmate SET hifi=hifi-1 WHERE userID='".$hifiTo."'");
	
	$coRow=mysql_query($addCo) or die (mysql_error());
	if($coRow){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">UnHiFied Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to UnHiFi,please try again. </h3>
      		</div>'; exit;
	}

} 


if($_REQUEST['xAction']=='hifi'){
	$hifiTo=$_REQUEST['hifiTo'];
	$hifiWith=($_REQUEST['hifiWith']);
	//removing duplicate array values
	if(($key = array_search($hifiTo, $hifiWith)) !== false) {
    unset($hifiWith[$key]);
	}	


	$check_for_hifi=mysqli_query($dbconfig,"SELECT * FROM hifi_user WHERE hifiBy='".$_SESSION['userid']."' 
	AND hifiTo='".$hifiTo."'  ");
	$check_count_hifi=mysqli_num_rows($check_for_hifi) ;
	if (intval($check_count_hifi) > 0 ){
		echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Already Hified </h3>
      		</div>';
	} else {
	$match=mysqli_query($dbconfig,"SELECT * FROM hifi_user WHERE hifiBy='".$_SESSION['userid']."' 
	AND hifiTo='".implode($hifiWith)."' AND hifiWith='".($hifiTo)."' ") or die (mysqli_error());
	$matchCount=mysqli_num_rows($match);
	$rowMatch=mysqli_fetch_assoc($match);
		
		if($matchCount==true){
		$sql_del=mysqli_query($dbconfig,"DELETE FROM hifi_user WHERE hifiTo='".implode($hifiWith)."' AND hifiWith='".($hifiTo)."'");
		$update=mysqli_query($dbconfig,"UPDATE matchmate SET hifi=hifi-1 WHERE userID='".implode($hifiWith)."'");
			} 
			else {
  	$addCo=("INSERT INTO hifi_user (hifiBy,hifiTo,hifiWith,hifiTime) VALUES 
	('".$_SESSION['userid']."','".$hifiTo."','".mysql_escape_string(implode($hifiWith))."','".$time."')");
	$update=mysqli_query($dbconfig,"UPDATE matchmate SET hifi=hifi+1 WHERE userID='".$hifiTo."'");
	$coRow=mysql_query($addCo) or die (mysql_error());
		if($coRow==true){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Hifi Successfully </h3>
      		</div>'; exit;
		}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Hifi,please try again. </h3>
      		</div>'; exit;
		}
			}}
} 


if($_REQUEST['xAction']=='enterme'){

	$match=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN matchmate ON user.userID=matchmate.userID 
	WHERE user.userID='".$_SESSION['userid']."'");
	$matchCount=mysqli_num_rows($match);
	if($matchCount==true){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">You are already join to matchmate</h3>
      		</div>'; exit;
	}else {
	
  	$addCo=("INSERT INTO matchmate (userID,mmTime) VALUES 
	('".$_SESSION['userid']."','".$time."')");
 
	$coRow=mysql_query($addCo) or die (mysql_error());
	if($coRow){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">You have joined Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to join,please try again. </h3>
      		</div>'; exit;
	}
} 
}


if($_REQUEST['xAction']=='improveus'){
 $improveMessage = $_REQUEST['improveMessage'];
 
  	$create_event=("INSERT INTO improve_us (userID,improveMessage,improveTime) VALUES ('".$_SESSION['userid']."','".mysql_real_escape_string($improveMessage)."','".$time."')");
	$event=mysql_query($create_event);
if($event > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Thank you for writting to us </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to write to us, please try again some time </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='searchCo'){
	$userName = $_REQUEST['userName'];
	$eventID = $_REQUEST['eventID'];
	

	$match=mysqli_query($dbconfig,"SELECT * FROM user WHERE userName LIKE '%".$userName."%'");
	$matchCount=mysqli_num_rows($match);
	$rowMatch=mysqli_fetch_assoc($match);
	$userID=$rowMatch['userID'];
	$userID=$rowMatch['userID'];

  	$addCo=("INSERT INTO event_co (eventID,addBy,addedTo,coAddTime) VALUES 
	('".$eventID."','".$_SESSION['userid']."','".$userID."','".$time."')");
 
	$coRow=mysql_query($addCo) or die (mysql_error());
if($coRow){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Co-ordinator Added Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Add Co-ordinator </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='createEvent'){
 $eventName = $_REQUEST['eventName'];
 
  	$create_event=("INSERT INTO event (userID,eventName,eventPhoto,createTime) VALUES ('".$_SESSION['userid']."','".mysql_real_escape_string($eventName)."','".$eventPhoto."','".$time."')");
	$event=mysql_query($create_event);
if($event > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Event Created Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Create Event </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='savePrivacy'){
$attendPrivacy=$_REQUEST['attendPrivacy'];
$subjectID=$_REQUEST['subjectID'];

	$sql_sheet_update = "UPDATE attend_subjects SET attendPrivacy = '".mysql_real_escape_string($attendPrivacy)."'
	WHERE subjectID = '".$subjectID."' ";
	$res_sheet = mysql_query($sql_sheet_update) or die(mysql_error());
if($res_sheet > 0) {
		echo '<div style="background-color:#0C0;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Data Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Failed to Update Sheet </h3>
      		</div>'; exit;
	}
}



if($_REQUEST['xAction']=='sendSheet'){
	$userName = $_REQUEST['userName'];
	$sheetID = $_REQUEST['sheetID'];
 	$subjectID = $_REQUEST['subjectID'];
	$dateFrom = $_REQUEST['dateFrom'];
	$dateTo = $_REQUEST['dateTo'];
	if($dateFrom.''.$dateTo == '')
 			{echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Please Select Date Field </h3>
      		</div>';exit;}
if($userName == '')
 			{echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Please Select Username Field </h3>
      		</div>'; 
exit;}

	$match=mysqli_query($dbconfig,"SELECT * FROM user WHERE userName LIKE '%".$userName."%'");
	$matchCount=mysqli_num_rows($match);
	$rowMatch=mysqli_fetch_assoc($match);
	$userID=$rowMatch['userID'];
	$userID=$rowMatch['userID'];

  	$sendSheet=("INSERT INTO send_records (subjectID,sendBy,sendTo,dateFrom,dateTo,sendTime) VALUES 
	('".$subjectID."','".$_SESSION['userid']."','".$userID."','".$dateFrom."','".$dateTo."','".$time."')");
 
	$sendRow=mysql_query($sendSheet) or die (mysql_error());
if($sendRow){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Sheet Send Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Send Sheet </h3>
      		</div>'; exit;
	}
}


if($_REQUEST['xAction']=='searchStud'){
 $searchStud = $_POST['searchStud'];
 
  	$coaching=mysql_query("SELECT * FROM coaching_institute WHERE userID='".$_SESSION['userid']."' ");
 	$coachingRow=mysql_fetch_array($coaching);
 
 	$find=mysql_query("SELECT * FROM user WHERE userName LIKE '%".mysql_real_escape_string($searchStud)."%' ");
 	while($row=mysql_fetch_array($find)){
  ?>

<div class="text_area_home">
  <h3> <?php echo $row['userName']; 
	$coaching=mysql_query("SELECT * FROM coaching_institute_students WHERE userID='".$row['userID']."' AND ci_ID='".$coachingRow['ci_ID']."' ");
 	$check_student=mysql_num_rows($coaching);
	if($check_student !=0){
	echo '<p class="floatright" >Already Added</p>';	
	}else {
	?> <a class="floatright addStud" href="insertData.php?xAction=addStudent&userID=<?php echo $row['userID']; ?>&ci_ID=<?php echo $coachingRow['ci_ID']; ?>" >Add this</a>
    <?php } ?>
  </h3>
</div>
<?php
}exit;
}

if($_REQUEST['xAction']=='updateCheck'){
$attendDate=$_REQUEST['attendDate'];
$recordID=$_REQUEST['recordID'];
$subjectID=$_REQUEST['subjectID'];
$attendStatus = $_REQUEST['attendStatus'];

	$sql_sheet_update = "UPDATE attend_records SET attendStatus = '".mysql_real_escape_string($attendStatus)."'
	,attendDate='".$attendDate."' WHERE recordID = '".$recordID."' AND subjectID = '".$subjectID."' ";
	$res_sheet = mysql_query($sql_sheet_update) or die(mysql_error());
if($res_sheet > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Data Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Update Sheet </h3>
      		</div>'; exit;
	}
}


if($_REQUEST['xAction']=='addAttendRecord'){
	$subjectID1 = $_REQUEST['subjectID1'];
	$sheetID = $_REQUEST['sheetID'];
	$attendDate = $_REQUEST['attendDate'];
	$attendStatus = $_REQUEST['attendStatus'];
 $subjectID = $_REQUEST['subjectID'];
 $attend_StudID = $_REQUEST['attend_StudID'];
 
 for($i = 0; $i < count($attendStatus); $i++){
  	$insert_create=("INSERT INTO attend_records (userID,subjectID,attend_StudID,attendStatus,attendDate,attendTime) VALUES 
	('".$_SESSION['userid']."','".$subjectID[$i]."','".$attend_StudID[$i]."','".$attendStatus[$i]."','".($attendDate)."','".($time)."')");
 
	$res11=mysql_query($insert_create) or die (mysql_error());
	}
if($res11){
		header('location:singleSubject.php?sheetID='.$sheetID.'&subjectID='.$subjectID1.'&addSuccess=1'); exit;
	}else{
		header('location:singleSubject.php?sheetID='.$sheetID.'&subjectID='.$subjectID1.'&addFail=1'); exit;
	}
}



if($_REQUEST['xAction']=='createAttendance'){
 $sheetName = $_REQUEST['sheetName'];
 
  	$insert_create=("INSERT INTO attend_sheets (userID,sheetName,createTime) VALUES ('".$_SESSION['userid']."','".mysql_real_escape_string($sheetName)."','".$time."')");
	$res11=mysql_query($insert_create);
if($res11 > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Sheet Created Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Create Sheet </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='updateAttendance'){
$sheetID=$_REQUEST['sheetID'];
$sheetName = $_REQUEST['sheetName'];

	$sql_sheet_update = "UPDATE attend_sheets SET sheetName = '".mysql_real_escape_string($sheetName)."'
	WHERE sheetID = '".$sheetID."' ";
	$res_sheet = mysql_query($sql_sheet_update) or die(mysql_error());
if($res_sheet > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Sheet Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Update Sheet </h3>
      		</div>'; exit;
	}
}



if($_REQUEST['xAction']=='addSubject'){
 $subjectName = $_REQUEST['subjectName'];
 $sheetID = $_REQUEST['sheetID'];
 
  	$insert_add=("INSERT INTO attend_subjects (sheetID,subjectName,addTime) VALUES ('".$sheetID."','".mysql_real_escape_string($subjectName)."','".$time."')");
	$res11=mysql_query($insert_add);
if($res11 > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Subject Created Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Create Subject </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='updateSubject'){
$subjectID=$_REQUEST['subjectID'];
$subjectName = $_REQUEST['subjectName'];

	$sql_sheet_update = "UPDATE attend_subjects SET subjectName = '".mysql_real_escape_string($subjectName)."'
	WHERE subjectID = '".$subjectID."' ";
	$res_sheet = mysql_query($sql_sheet_update) or die(mysql_error());
if($res_sheet > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Subject Name Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Update Subject Name </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='addAttendStudent'){
 $studentName = $_REQUEST['studentName'];
 $sheetID = $_REQUEST['sheetID'];
$rollNo = $_REQUEST['rollNo'];

  	$insert_add=("INSERT INTO attend_students (sheetID,studentName,rollNo,addTime) VALUES ('".$sheetID."','".mysql_real_escape_string($studentName)."',
	'".($rollNo)."','".$time."')");
	$res11=mysql_query($insert_add);
if($res11 > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student Added Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Add Student </h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='updateAttendStudent'){
$attend_StudID=$_REQUEST['attend_StudID'];
$studentName = $_REQUEST['studentName'];
$rollNo = $_REQUEST['rollNo'];

	$sql_stud_update = "UPDATE attend_students SET studentName = '".mysql_real_escape_string($studentName)."',rollNo = '".($rollNo)."'
	WHERE attend_StudID = '".$attend_StudID."' ";
	$res_stud = mysql_query($sql_stud_update) or die(mysql_error());
if($res_stud > 0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student Info Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Update Student Info </h3>
      		</div>'; exit;
	}
}



if($_REQUEST['xAction']=='addStudent'){
$userID=$_REQUEST['userID'];
$ci_ID=$_REQUEST['ci_ID'];
	
	$sql_add="INSERT INTO coaching_institute_students (userID,ci_ID,cis_addTime) VALUES 
	('".$userID."','".$ci_ID."','".$time."')";
	$res = mysql_query($sql_add) or die(mysql_error());
	if($res > 0){
		header('location:mycoaching.php?addSuccess=1'); exit;
	}else{
		header('location:mycoaching.php?addFailed=1'); exit;
	}
}



if($_REQUEST['xAction']=='editProfile'){
$userName=$_REQUEST['userName'];
$day=$_REQUEST['day'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$eduYear=$_REQUEST['eduYear'];
$emailPrivacy=$_REQUEST['emailPrivacy'];

	$sql = "UPDATE user SET userID = '".$_SESSION['userid']."', userName = '".mysql_real_escape_string($userName)."',day = '".mysql_real_escape_string($day)."',month = '".mysql_real_escape_string($month)."',
	year = '".mysql_real_escape_string($year)."',eduYear = '".mysql_real_escape_string($eduYear)."' ,emailPrivacy = '".($emailPrivacy)."' 
	WHERE userID = '".$_SESSION['userid']."'";
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		header('location:myprofile.php?updateSuccess=1'); exit;
	}else{
		echo "Sorry, Please try again";	
	}
}

if($_REQUEST['xAction']=='sentRequest'){
$acceptStatus='pending';	
$instituteName=$_REQUEST['instituteName'];
$collegeAddress=$_REQUEST['collegeAddress'];
$collegeContact=$_REQUEST['collegeContact'];
$collegeWebsite=$_REQUEST['collegeWebsite'];
$collegeDirector=$_REQUEST['collegeDirector'];
$collegeCode=$_REQUEST['collegeCode'];
$courseName=$_REQUEST['courseName'];
$branchName=$_REQUEST['branchName'];

	$sql11 = "INSERT INTO college_request (userID,acceptStatus,instituteName,courseName,branchName,collegeCode,collegeAddress,collegeWebsite,collegeContact,collegeDirector,requestTime) 
	VALUES ('".$_SESSION['userid']."','".$acceptStatus."','".mysql_escape_string($instituteName)."','".mysql_escape_string($courseName)."',
	'".mysql_escape_string($branchName)."','".$collegeCode."','".mysql_escape_string($collegeAddress)."','".$collegeWebsite."',
	'".mysql_escape_string($collegeContact)."','".mysql_escape_string($collegeDirector)."','".$time."')";
	$res11 = mysql_query($sql11) or die(mysql_error());
	if($res11 > 0) {
		echo 'reqSentSuccess'; exit;
	}else{
		echo 'reqSentFail'; exit;
	}
}


if($_REQUEST['xAction']=='coachingInfo'){
$cf_ID=$_REQUEST['cf_ID'];
$ci_Address=$_REQUEST['ci_Address'];
$ci_Contact=$_REQUEST['ci_Contact'];
$ci_Website=$_REQUEST['ci_Website'];
$startHour=$_REQUEST['startHour'];
$closeHour=$_REQUEST['closeHour'];
$courseName=$_REQUEST['courseName'];
$courseFee=$_REQUEST['courseFee'];
	
if($courseName and $courseFee != ''){
	$sql_fee="INSERT INTO coaching_fee (userID,ci_ID,courseName,courseFee,cf_time) VALUES 
	('".$_SESSION['userid']."','".$ci_ID."','".$courseName."','".$courseFee."','".$time."')";
	$res = mysql_query($sql_fee) or die(mysql_error());
	}
	else {
	$sql = "UPDATE coaching_institute SET userID = '".$_SESSION['userid']."',ci_Address = '".mysql_real_escape_string($ci_Address)."',
	ci_Contact = '".mysql_real_escape_string($ci_Contact)."',ci_Website = '".mysql_real_escape_string($ci_Website)."'
	,startHour = '".mysql_real_escape_string($startHour)."',closeHour = '".mysql_real_escape_string($closeHour)."'
	,ci_updateTime='".$time."' WHERE ci_ID = '".$_REQUEST['ci_ID']."'";
	$res = mysql_query($sql) or die(mysql_error());
	}
	if($res > 0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Info Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Update </h3>
      		</div>'; exit;
	}
}
	
	
if($_REQUEST['xAction']=='updateFee'){
$cf_ID=$_REQUEST['cf_ID'];
$courseName=$_REQUEST['courseName'];
$courseFee=$_REQUEST['courseFee'];
	$sql_fee_update = "UPDATE coaching_fee SET courseName = '".mysql_real_escape_string($courseName)."',
	courseFee = '".mysql_real_escape_string($courseFee)."', cf_time='".$time."' WHERE cf_ID = '".$cf_ID."' ";
	$res = mysql_query($sql_fee_update) or die(mysql_error());
		if($res){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Data Updated Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Update </h3>
      		</div>'; exit;
	}
	}
?>