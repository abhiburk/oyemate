<?php require '../config.php';
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
} 
$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(($user['company']!='College Staff') and ($user['company']!='Coaching Staff')){
  header('LOCATION:home.php');
}
 
$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_subjects LEFT JOIN attend_sheets ON
attend_subjects.sheetID=attend_sheets.sheetID
WHERE attend_subjects.subjectID='".$_REQUEST['subjectID']."' AND userID='".$_SESSION['userid']."' ");
($subject=mysqli_fetch_assoc($sql_created)); 
$count=mysqli_num_rows($sql_created);
//checking if the data is of session user
if($count==0){
	 header('LOCATION:home.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Single Subject : Oyemate</title>
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
          <div id="savePrivacy"></div>
          <?php 	
			if(isset($_GET['addSuccess']) && $_GET['addSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0c3;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Data Added Successfully </h3>
          </div>
          <?php } ?>
          <?php 	
			if(isset($_GET['addFail']) && $_GET['addFail'] == 1) { ?>
          <div id="fade" style="background-color:#F00;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Add Data Please Try Again </h3>
          </div>
          <?php } ?>
          <p align="right" class="font-set">
            <?php 
				$sql_time=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE subjectID='".$_REQUEST['subjectID']."'  AND userID='".$_SESSION['userid']."'  ORDER BY recordID DESC");
				$time=mysqli_fetch_assoc($sql_time); 
				if($time['attendTime']=='') {echo 'Not Available Yet';}else {?>
            	Updated: <?php echo "" . humanTiming( $time['attendTime'] ). " ago"; }?> </p>
          <div class="text_area_home">
          <p><b>Subject: <?php echo $subject['subjectName']; ?></b> | <a href="#" class="clickCalender"> Select Date <i class="icon-calendar"></i></a> <small class="floatright"> | <a href="#" class="clickPrivacy"> Privacy <i class="icon-eye-open"></i></a> | <a href="sendSheet.php?sheetID=<?php echo $_REQUEST['sheetID']; ?>&subjectID=<?php echo $_REQUEST['subjectID']; ?>"> Send Sheet <i class="icon-envelope"></i> </a> </small> 
            
            <!--This is Privacy Form-->
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="savePrivacy" />
            <input type="hidden" name="subjectID" value="<?php echo $_REQUEST['subjectID']; ?>" />
            <label class="hidePrivacy">Whom you want to show this sheet ?</label>
            <select name="attendPrivacy" style="text-transform: uppercase;" class="hidePrivacy">
              <option value="onlyme"<?php if($subject['attendPrivacy'] == 'onlyme'){ echo 'selected';};?>>Only me</option>
              <option value="mystudents"<?php if($subject['attendPrivacy'] == 'mystudents'){ echo 'selected';};?>>Only <?php echo $subject['subjectName']; ?> students</option>
            </select>
            <input type="submit" value="Save" class="savePrivacy hidePrivacy btn btn-primary btn-xs btn-rect" />
          </form>
          <script>
			$(".savePrivacy").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("savePrivacy").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script> 
          
            </p>
            </div>
            <?php 
			$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_sheets ON  attend_students.sheetID=attend_sheets.sheetID
			WHERE attend_students.sheetID='".$_REQUEST['sheetID']."' AND userID='".$_SESSION['userid']."' ");
				$check_stud=mysqli_num_rows($sql_created);
				if($check_stud==0){echo 'Students not Added Yet';} else {
			?>
            <!--This is Attendance Form-->
          <form action="insertData.php" method="post" enctype="multipart/form-data">
            <input name="attendDate" class="datepicker form-control hideCalender" placeholder="Click Here to Select Date" style="width:27%" required/>
            <table class="table table-striped table-bordered table-hover">
              <tr>
                <th>Student Name</th>
                <th>RollNo</th>
                <th>Attendence</th>
                <th>Total</th>
                <th>%</th>
              </tr>
              <?php 
				$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_sheets ON  attend_students.sheetID=attend_sheets.sheetID
			WHERE attend_students.sheetID='".$_REQUEST['sheetID']."' AND userID='".$_SESSION['userid']."' ");
				
				while($row_students=mysqli_fetch_assoc($sql_created)){ ?>
              <tr>
                <td><input type="hidden" name="sheetID" value="<?php echo $_REQUEST['sheetID'];?>" />
                  <input type="hidden" name="subjectID1" value="<?php echo $_REQUEST['subjectID'];?>" />
                  <input type="hidden" name="xAction" value="addAttendRecord" />
                  <input type="hidden" name="subjectID[]" value="<?php echo $_REQUEST['subjectID'];?>" />
                  <input type="hidden" name="attend_StudID[]" value="<?php echo $row_students['attend_StudID']; ?>" />
                  <div class="hideAfterClick<?php echo $row_students['attend_StudID']; ?>"> <a href="singleStudent.php?subjectID=<?php echo $_REQUEST['subjectID'];?>&attend_StudID=<?php echo $row_students['attend_StudID']; ?>"><?php echo $row_students['studentName']; ?></a></div></td>
                <td><?php echo $row_students['rollNo']; ?></td>
                <td><div class="checkbox-tick"> Present:
                    <input type="radio" name="attendStatus[]<?php echo $row_students['attend_StudID']; ?>" value="present" required/>
                    | Absent:
                    <input type="radio" name="attendStatus[]<?php echo $row_students['attend_StudID']; ?>" value="absent" required/>
                  </div></td>
                <?php 
				//counting attended lectures
				$sql_count=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_records ON 
				attend_students.attend_StudID=attend_records.attend_StudID WHERE attend_students.attend_StudID='".$row_students['attend_StudID']."' 
				AND subjectID='".$_REQUEST['subjectID']."' AND attendStatus='present'");
  				$totalAttended=mysqli_num_rows($sql_count);
				//counting total lectures
				$sql_count_total=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE subjectID='".$_REQUEST['subjectID']."' AND attend_StudID='".$row_students['attend_StudID']."'");
  				$totalLectures=mysqli_num_rows($sql_count_total);
				?>
                <td><?php echo $totalAttended; ?> of <?php echo $totalLectures; ?></td>
                <td><?php if ($totalLectures!=0) { echo round($totalAttended/$totalLectures*100); }else { echo '0';} ?>
                  %</td>
              </tr>
              <?php } ?>
            </table>
            <input type="submit" value="Save" class="saveAttend floatright btn btn-primary btn-xs btn-rect" />
          </form>
          <?php }?>
          <script>
			$(".addSub").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("createResult").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script> 
          <script>
      $(document).ready(function(e) {
			$(".hidePrivacy").hide();
			$("a.clickPrivacy").click(function(){
			$(".hidePrivacy").toggle(500);
			return false;	
			});
    });
      </script> 
          <script>
      $(document).ready(function(e) {
        $("input.hideCalender").hide();
			$("a.clickCalender").click(function(){
			$("input.hideCalender").toggle(500);
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
