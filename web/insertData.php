<?php
require '../config.php';
session_start();
ob_start();
$time=time();
$userid=$_SESSION['userid'];

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
if(isset($_POST['get_option']))
{
 $courseName = $_POST['get_option'];
 $sql=mysqli_query($dbconfig,"SELECT * FROM courses LEFT JOIN branch ON courses.courseID=branch.courseID WHERE courses.courseName='".$courseName."'");
 $sql>0;
 $countSearch=mysqli_num_rows($sql);
 while($row=mysqli_fetch_assoc($sql)) 
 {  ?>
 <option><?php echo $row['branchName']; ?></option>
 <?php } ?>
 <option>Other</option>
<?php  exit;
}


if($_REQUEST['xAction']=='settingPassword'){
$userPass=md5($_REQUEST['userPass']);
$userPassRetype = $_REQUEST['userPassRetype'];
$userRealPass='1';

	if(strlen($_POST['userPass']) <= 7){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Password too Short.Enter More then 8 Character </h3>
      		</div>'; exit;
	}
	
	if($_POST['userPass'] != $_POST['userPassRetype']){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Enter Password do not match </h3>
      		</div>'; exit;
	}

	$sql =$conn->prepare( "UPDATE user SET userPass=:userPass,userRealPass=:userRealPass
	WHERE userID = '".$_SESSION['userid']."' ");
	$sql->execute(array(':userPass'=>$userPass,':userRealPass'=>$userRealPass));
	
	if($sql>0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Your Password Change Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Change Password.Try After Sometime </h3>
      		</div>'; exit;
	}
}


if($_REQUEST['xAction']=='searchCollege'){
 $searchCollege = $_POST['searchCollege'];
 
 echo'<div class="scroll_hostel">';	
	$q=$conn->prepare("SELECT * FROM colleges WHERE instituteName LIKE :searchCollege OR collegeAddress LIKE :searchCollege");
    $q->bindValue(':searchCollege','%'.$searchCollege.'%'); 
    $q->execute();
    while ($row_college = $q->fetch(PDO::FETCH_ASSOC)) { 
  ?>

        <div class="text_area_home">
          <div class="single_cat_left_content floatleft">
            <p><b><?php echo $row_college['instituteName']; ?></b></p>
            <p class="single_cat_left_content_meta"><b>Address: </b><?php echo $row_college['collegeAddress']; ?> | 
			Added <?php echo "" . humanTiming( $row_college['collegeUpdateTime'] ). " ago"; ?> | </p>
          </div>
        </div>
        <?php } ?>
      </div>
<?php 
exit; }
 ?>

<?php
if($_REQUEST['xAction']=='contactus'){
$contactMessage=$_REQUEST['contactMessage'];
$logincontactMessage=$_REQUEST['logincontactMessage'];
$contactusName=$_REQUEST['contactusName'];
$contactusEmail=$_REQUEST['contactusEmail'];
$contactusEmail = filter_var($contactusEmail, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (!filter_var($contactusEmail, FILTER_VALIDATE_EMAIL) === true) {
	 
    echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Invalid Email ID</h3>
      		</div>'; exit;
}else {	
	
	if(($contactusName!='').''.($contactusEmail!='')){
		if(($contactMessage=='').''.($contactusName=='').''.($contactusEmail=='')){
	 		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Pleaseaa fill all the fields</h3>
      		</div>'; exit;
	 		}
			$sql=$conn->prepare("INSERT INTO contactus (contactusName,contactusEmail,contactMessage,contactTime) VALUES 
			(?,?,?,?)");
 			$sql->execute(array($contactusName,$contactusEmail,$contactMessage,$time)); 
		 	}  
		 else 
		 {
			if($logincontactMessage==''){
	 		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Please fill all the fields</h3>
      		</div>'; exit; }
			
			$sql=$conn->prepare("INSERT INTO contactus (userID,contactMessage,contactTime) VALUES 
			(?,?,?)");
 			$sql->execute(array($_SESSION['userid'],$logincontactMessage,$time)); 
		 }
	
		//print_r($sql->errorInfo());exit;
		if($sql>0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Thankyou for writting to us, we will respond you soon </h3>
      		</div>'; exit;
		}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to send.Please try again after sometime</h3>
      		</div>'; exit;
	}
}
}
if($_REQUEST['xAction'] == 'faq'){
	$faqName=$_REQUEST['faqName'];
	$faqEmail=$_REQUEST['faqEmail'];
	$question=$_REQUEST['question'];
	$readStatus='unread';   
	if(($faqName =='').''.($faqEmail =='').''.($question =='')){
	 echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Please fill all the fields</h3>
      		</div>'; exit;
	 }	
	 	$sql=$conn->prepare("INSERT INTO faq (faqName,faqEmail,question,readStatus,faqTime) VALUES (?,?,?,?,?)");
 		$sql->execute(array($faqName,$faqEmail,$question,$readStatus,$time)); 
	 	
		if($sql>0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Your question has been successfully sent</h3>
      		</div>'; exit;
		}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to sent question please try again later</h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='addHostel'){
 $hostelName = $_REQUEST['hostelName'];
 $hostelContact = $_REQUEST['hostelContact'];
 $hostelEmail = $_REQUEST['hostelEmail'];
 $nearCollege = $_REQUEST['nearCollege'];
 $hostelFor = $_REQUEST['hostelFor'];
 $hostelType = $_REQUEST['hostelType'];
 $hostelAddress = $_REQUEST['hostelAddress'];
 $ratingCount=0;
 if(($hostelName =='').''.($hostelContact =='').''.($hostelEmail =='').''.($nearCollege =='').''.($hostelFor =='').''.($hostelType =='').''.($hostelAddress =='')){
	 echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Please fill all the fields</h3>
      		</div>'; exit;
	 }
	$sql=$conn->prepare("INSERT INTO hostel (hostelName,hostelContact,hostelEmail,nearCollege,hostelFor,hostelType,hostelAddress,ratingCount,hostelAddTime) 
	VALUES (?,?,?,?,?,?,?,?,?)");
 	$sql->execute(array($hostelName,$hostelContact,$hostelEmail,$nearCollege,$hostelFor,$hostelType,$hostelAddress,$ratingCount,$time));  
	if (!$sql>0) {
    print_r($sql->errorInfo());exit;
	}
	if($sql>0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Hostel Added Successfully</h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to add your hostel.Please try again after sometime</h3>
      		</div>'; exit;
	}
}

if($_REQUEST['xAction']=='updateupload'){
$uploadID=$_REQUEST['uploadID'];
$detail=$_REQUEST['detail'];

	$sql=$conn->prepare("UPDATE upload SET detail = ? WHERE uploadID=$uploadID");
 	$sql->execute(array($detail));
	
	if($sql>0) {
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
	if($coRow>0){
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
 
	$sql=$conn->prepare("INSERT INTO improve_us (userID,improveMessage,improveTime) 
	VALUES (?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$improveMessage,$time));
	
	if (!$sql>0) {
    print_r($sql->errorInfo());exit;
	}
	if($sql>0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Thank you for writting to us. Kindly Check your Email for further response</h3>
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
if($coRow>0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Co-ordinator Added Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Fail to Add Co-ordinator </h3>
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
if($sendRow>0){
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
  
 	$sql=$conn->prepare("SELECT * FROM user WHERE userName LIKE :searchStud");
	$sql->bindValue(':searchStud','%'.$searchStud.'%');
	$sql->execute();
	$sql>0;
 	while($searchRow=$sql->fetch(PDO::FETCH_ASSOC)) { 
  ?>

<div class="text_area_home">
  <h3> <?php 
  	echo $searchRow['userName']; 
	$coaching=mysql_query("SELECT * FROM coaching_institute_students WHERE userID='".$searchRow['userID']."' AND ci_ID='".$coachingRow['ci_ID']."'");
 	$check_student=mysql_num_rows($coaching);
	if($check_student !=0){
	echo '<p class="floatright" >Already Added | '; ?> &nbsp;
	<a class="floatright addStud" href="delete.php?xAction=deleteCoachingStud&userID=<?php echo $searchRow['userID']; ?>&ci_ID=<?php echo $coachingRow['ci_ID']; ?>" >Delete</a></p>
	<?php }else {
	?> <a class="floatright addStud" href="insertData.php?xAction=addStudent&userID=<?php echo $searchRow['userID']; ?>&ci_ID=<?php echo $coachingRow['ci_ID']; ?>" >Add this</a>
    <?php } ?>
  </h3>
</div>
<?php 
}exit;
} ?>


<?php
if($_REQUEST['xAction']=='updateCheck'){
$attendDate=$_REQUEST['attendDate'];
$recordID=$_REQUEST['recordID'];
$subjectID=$_REQUEST['subjectID'];
$attendStatus = $_REQUEST['attendStatus'];
$attend_StudID = $_REQUEST['attend_StudID'];

	$sql_sheet_update = "UPDATE attend_records SET attendStatus = '".mysql_real_escape_string($attendStatus)."'
	,attendDate='".$attendDate."' WHERE recordID = '".$recordID."' AND subjectID = '".$subjectID."' ";
	$res_sheet = mysql_query($sql_sheet_update) or die(mysql_error());
if($res_sheet>0){
		header('location:singleStudent.php?attend_StudID='.$attend_StudID.'&subjectID='.$subjectID.'&addSuccess=1'); exit;
	}else{
		header('location:singleStudent.php?attend_StudID='.$attend_StudID.'&subjectID='.$subjectID.'&addFail=1'); exit;
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
if($res11>0){
		header('location:singleSubject.php?sheetID='.$sheetID.'&subjectID='.$subjectID1.'&addSuccess=1'); exit;
	}else{
		header('location:singleSubject.php?sheetID='.$sheetID.'&subjectID='.$subjectID1.'&addFail=1'); exit;
	}
}



if($_REQUEST['xAction']=='createAttendance'){
 $sheetName = $_REQUEST['sheetName'];
 
 	$sql=$conn->prepare("INSERT INTO attend_sheets (userID,sheetName,createTime) 
	VALUES (?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$sheetName,$time));  
if($sql>0) {
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

	$sql =$conn->prepare( "UPDATE attend_sheets SET sheetName = :sheetName
	WHERE sheetID = '".$sheetID."' ");
	$sql->execute(array(':sheetName'=>$sheetName));
if($sql>0) {
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
 
 $sql_check=mysqli_query($dbconfig,"SELECT * FROM attend_subjects WHERE subjectName='".$subjectName."' AND sheetID='".$sheetID."'");
	$count=mysqli_num_rows($sql_check);
	if($count==true){
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Sheet Already Added</h3>
      		</div>'; exit;
		}else {
 	$sql=$conn->prepare("INSERT INTO attend_subjects (sheetID,subjectName,addTime)
	VALUES (?,?,?)");
 	$sql->execute(array($sheetID,$subjectName,$time));  
	
if($sql>0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Subject Created Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Create Subject </h3>
      		</div>'; exit;
	}
}
}

if($_REQUEST['xAction']=='updateSubject'){
$subjectID=$_REQUEST['subjectID'];
$subjectName = $_REQUEST['subjectName'];

	$sql =$conn->prepare( "UPDATE attend_subjects SET subjectName = :subjectName
	WHERE subjectID = '".$subjectID."' ");
	$sql->execute(array(':subjectName'=>$subjectName));
	
	if($sql>0) {
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

	$sql_check=mysqli_query($dbconfig,"SELECT * FROM attend_students WHERE rollNo='".$rollNo."' AND sheetID='".$sheetID."'");
	$count=mysqli_num_rows($sql_check);
	if($count==true){
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student or Roll No is Already Added</h3>
      		</div>'; exit;
		}else {
	$sql=$conn->prepare("INSERT INTO attend_students (sheetID,studentName,rollNo,addTime)
	VALUES (?,?,?,?)");
 	$sql->execute(array($sheetID,$studentName,$rollNo,$time));  
	
	if($sql>0) {
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student Added Successfully </h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Add Student </h3>
      		</div>'; exit;
	}}
}

if($_REQUEST['xAction']=='updateAttendStudent'){
$attend_StudID=$_REQUEST['attend_StudID'];
$studentName = $_REQUEST['studentName'];
$sheetID = $_REQUEST['sheetID'];
$studID = $_REQUEST['studID'];
$rollNo = $_REQUEST['rollNo'];


	
	$sql =$conn->prepare( "UPDATE attend_students SET studentName = :studentName,rollNo=:rollNo
	WHERE attend_StudID = '".$attend_StudID."' ");
	$sql->execute(array(':studentName'=>$studentName,':rollNo'=>$rollNo));
	
if($sql>0) {
		header('location:singleSheet.php?sheetID='.$sheetID.'&studID='.$studID.'&addSuccess=1'); exit;
	}else{
		header('location:singleSheet.php?sheetID='.$sheetID.'&studID='.$studID.'&addFail=1'); exit;
	}
}



if($_REQUEST['xAction']=='addStudent'){
$userID=$_REQUEST['userID'];
$ci_ID=$_REQUEST['ci_ID'];
	
	
	$sql=$conn->prepare("INSERT INTO coaching_institute_students (userID,ci_ID,cis_addTime)
	VALUES (?,?,?)");
 	$sql->execute(array($userID,$ci_ID,$time)); 
	
	if($sql>0){
		header('location:mycoaching.php?ci_ID='.$ci_ID.'&addSuccess=1'); exit;
	}else{
		header('location:singleSheet.php?ci_ID='.$ci_ID.'&addFail=1'); exit;
	}
}



if($_REQUEST['xAction']=='editProfile'){
$userName=$_REQUEST['userName'];
$day=$_REQUEST['day'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$eduYear=$_REQUEST['eduYear'];
$emailPrivacy=$_REQUEST['emailPrivacy'];
$instituteName=$_REQUEST['instituteName'];

	$sql =$conn->prepare( "UPDATE user SET userName=:userName,day=:day,month=:month,year=:year,eduYear=:eduYear,emailPrivacy=:emailPrivacy,instituteName=:instituteName
	WHERE userID = '".$_SESSION['userid']."' ");
	$sql->execute(array(':userName'=>$userName,':day'=>$day,':month'=>$month,':year'=>$year,':eduYear'=>$eduYear,':emailPrivacy'=>$emailPrivacy,':instituteName'=>$instituteName));

	if($sql>0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Profile Info Updated Successfully</h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Update Info </h3>
      		</div>'; exit;
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

	$sql=$conn->prepare("INSERT INTO college_request (userID,acceptStatus,instituteName,collegeCode,collegeAddress,collegeWebsite,collegeContact,collegeDirector,requestTime)
	VALUES (?,?,?,?,?,?,?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$acceptStatus,$instituteName,$collegeCode,$collegeAddress,$collegeWebsite,$collegeContact,$collegeDirector,$time)); 

	if($sql>0){
		echo '<div id="fade" style="background-color:#0C0;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Your Request is Seccesfully Sent</h3>
      		</div>'; exit;
	}else{
		echo '<div id="fade" style="background-color:#F00;">
        	<h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Sent </h3>
      		</div>'; exit;
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
$ci_ID=$_REQUEST['ci_ID'];	
if(($courseName!='').''.($courseFee!='')){
	$sql=$conn->prepare("INSERT INTO coaching_fee (userID,cf_ID,courseName,courseFee,ci_ID,cf_time)
	VALUES (?,?,?,?,?,?)");
 	$sql->execute(array($_SESSION['userid'],$ci_ID,$courseName,$courseFee,$ci_ID,$time));
	}
	else {
	$sql =$conn->prepare( "UPDATE coaching_institute SET ci_Address=:ci_Address,ci_Contact=:ci_Contact,ci_Website=:ci_Website,startHour=:startHour,
	closeHour=:closeHour,ci_updateTime=:ci_updateTime
	WHERE ci_ID = '".$_REQUEST['ci_ID']."' ");
	$sql->execute(array(':ci_Address'=>$ci_Address,':ci_Contact'=>$ci_Contact,':ci_Website'=>$ci_Website,
	':startHour'=>$startHour,':closeHour'=>$closeHour,':ci_updateTime'=>$time));	
		
	}
	if($sql>0){
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

	$sql =$conn->prepare( "UPDATE coaching_fee SET courseName=:courseName,courseFee=:courseFee,cf_time=:cf_time
	 WHERE cf_ID = '".$cf_ID."' ");
	$sql->execute(array(':courseName'=>$courseName,':courseFee'=>$courseFee,':cf_time'=>$time));
if($sql>0){
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
<?php 
	function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'min',
        1 => 'sec'
);
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
	?>   