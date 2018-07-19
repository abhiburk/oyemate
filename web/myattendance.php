<?php require '../config.php';
define('MyConst', TRUE);
 
$sql_created=mysqli_query($dbconfig,"SELECT * FROM user 
WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql_created));

if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
if(($user['company']!='Student') ){
  header('LOCATION:home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View My Attendance : Oyemate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<?php include 'assetsLinks.php'; ?>
</head>
<body class="body">
<div class="body_wrapper">
  <?php include 'header.php'; ?>
  <div class="center">
    <div class="content_area">
      <div class="main_content floatleft">
        <?php include 'left-menu.php'; ?>
        <div class="left_coloum floatleft" >
          <div class="text_area_home">
            <p align="center">Look Your Attendance Here</p>
            <h6 align="center" class="font-set"><small>If your attendance rollno/subjects are not available, you can convey your teaching staff</small></h6>
          </div>
          
          <!--This is Sheet Sending Form-->
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="getAttend" />
            <div class="text_area_home"> <a href="#" class="clickCalender font-set">Select Dates <i class="icon-calendar"></i></a> <small style="display: flex;" class="floatright">
              <select name="rollNo" class="form-control" style="width:100%;" >
                <option value="">Select Roll No</option>
                <?php 
				//fetching login user's staff members	
			   $sql_fetch_staff=mysqli_query($dbconfig,"SELECT * FROM attend_sheets LEFT JOIN user ON 
			   attend_sheets.userID=user.userID
			   WHERE branchName='".$branchName."' AND instituteName='".$instituteName."'
			   AND eduYear='".$eduYear."' GROUP BY attend_sheets.userID");
			   while($match_user=mysqli_fetch_assoc($sql_fetch_staff)){
			   
			   	//fetching rollNo of the students who are added by above staff
			    $sql=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_sheets ON  
				attend_students.sheetID=attend_sheets.sheetID
			    WHERE attend_sheets.userID='".$match_user['userID']."'");
				$count_roll=mysqli_num_rows($sql);
			    while($foundUser=mysqli_fetch_assoc($sql)){
			   ?>
                <option><?php echo $foundUser['rollNo']; ?></option>
                <?php }}?>
              </select>
              <select id="clickSub" name="subjectID"  class="form-control" style="width:100%" />
              <option value="">Select Subject</option>
              <?php 
			   //fetching login user's staff members	
			   $sql_fetch_staff=mysqli_query($dbconfig,"SELECT * FROM attend_sheets LEFT JOIN user ON 
			   attend_sheets.userID=user.userID
			   WHERE branchName='".$branchName."' AND instituteName='".$instituteName."'
			   AND eduYear='".$eduYear."' GROUP BY attend_sheets.userID");
			   while($match_user=mysqli_fetch_assoc($sql_fetch_staff)){
				   
				   //fetching subjects of the students who are added by above staff
			    $sql_fetch_subject=mysqli_query($dbconfig,"SELECT * FROM attend_subjects LEFT JOIN attend_sheets ON  
				attend_subjects.sheetID=attend_sheets.sheetID
			    WHERE attend_sheets.userID='".$match_user['userID']."'
				AND attendPrivacy= 'mystudents' ");
				$count_subject=mysqli_num_rows($sql_fetch_subject);				
				while($subjects=mysqli_fetch_assoc($sql_fetch_subject)){
			   ?>
              <option value="<?php echo $subjects['subjectID']; ?>"><?php echo $subjects['subjectName']; ?></option>
              <?php }} ?>
              </select>
              </small> </div>
            <div class="text_area_home hideCalender">
              <h3 style="display:flex;">
                <input name="dateFrom" id="date" onchange="postinput()" class="datepicker form-control  floatleft" placeholder="Click Here to Select Date From" style="width:100%" />
                <input name="dateTo" id="date1" onchange="postinput()" class="datepicker1 form-control floatright" placeholder="Click Here to Select Date To" style="width:100%" />
              </h3>
            </div>
            <?php 
			if($count_roll=='') {echo '<p class="font-set">No Attendance Records Found </p>';}else {
			if($count_subject=='') echo '<p class="font-set">Attendance Records are hidden by all of your staff members</p>';} ?>
            <div class="loadingDiv">Loading...</div>
            <div id="new_select"></div>
          </form>
          <script>
 $(document).ready(function(){
	 $(".loadingDiv").hide();
    $("#clickSub").on('change', function (){
		$(".loadingDiv").show();
		var formData= $(this).closest('form').serialize();
        $.ajax({ 
            url: 'searchMyAttend.php',
            data: formData,
            type: 'GET'
        }).done(function(response) {
			$(".loadingDiv").hide();
           document.getElementById("new_select").innerHTML=response; 
        }).fail(function() {
            console.log('Failed');
        });
    });
});
</script> 
          <script>
      $(document).ready(function(e) {
        $(".hideCalender").hide();
			$("a.clickCalender").click(function(){
			$(".hideCalender").toggle(500);
			return false;	
			});
			
    });
      </script> 
        </div>
        <?php include 'midRightbar.php'; ?>
        </div>
      </div>
      <?php include 'rightbar.php'; ?>
    <?php include 'footer.php'; ?>
  </div>
</div>
</body>
</html>
