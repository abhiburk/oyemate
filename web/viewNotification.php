<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
} 

$sql_send=mysqli_query($dbconfig,"SELECT * FROM send_records LEFT JOIN attend_subjects ON
send_records.subjectID=attend_subjects.subjectID
WHERE srID='".$_REQUEST['srID']."' ");
($row_subject=mysqli_fetch_assoc($sql_send));

$sql_read=mysql_query("UPDATE send_records SET readStatus='read' WHERE srID='".$_REQUEST['srID']."'");
$sql_read=mysql_query("UPDATE improve_us SET readStatus='read' WHERE improveID='".$_REQUEST['improveID']."'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Notification : Oyemate</title>
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
        <p align="center">Notification</p>
        </div>
        <!--Improve us notification-->
        <?php if(isset($_REQUEST['improveID'])) { 
		$sql_improve=mysqli_query($dbconfig,"SELECT * FROM improve_us
		WHERE improveID='".$_REQUEST['improveID']."' ");
		($row_improve=mysqli_fetch_assoc($sql_improve));
		?>
        <div class="text_area_home">
        <b>Your message:<?php echo $row_improve['improveMessage']; ?></b>
        <p><b>Reply</b>: <?php echo $row_improve['replyMessage']; ?>
        <small class="floatright"><?php echo "" . humanTiming( $row_improve['replyTime'] ). " ago"; ?></small></p>
        
        </div>
        <?php } ?>
        
        
        <!--Attendance Notification-->
        <?php if(isset($_REQUEST['srID'])) { ?>
          <div class="text_area_home">
            <p><b>Subject: <?php echo $row_subject['subjectName']; ?></b> |
              <?php 
			$conv1= strtotime($row_subject['dateFrom']);
			$conv2= strtotime($row_subject['dateTo']);
    		$dateFrom=date('d-M-Y', $conv1);
			$dateTo=date('d-M-Y', $conv2);
			?>
              Attendence Date : <?php echo $dateFrom; ?> <b>to</b> <?php echo $dateTo; ?> </p>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Student Name</th>
              <th>RollNo</th>
              <th>Attendence</th>
              <th>Total</th>
              <th>%</th>
            </tr>
            <?php 
				$sql_send=mysqli_query($dbconfig,"SELECT * FROM send_records
				WHERE srID='".$_REQUEST['srID']."' ");
				($row_send=mysqli_fetch_assoc($sql_send));
					
				$sql_fetch=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON 
				attend_records.attend_StudID=attend_students.attend_StudID 
 				WHERE attendDate BETWEEN '".$row_send['dateFrom']."' AND '".$row_send['dateTo']."' AND subjectID='".$row_send['subjectID']."'
				GROUP BY attend_students.attend_StudID");	 
				while($row_students=mysqli_fetch_assoc($sql_fetch)){ 
				
				?>
            <tr>
              <td><?php echo $row_students['studentName']; ?></td>
              <td><?php echo $row_students['rollNo']; ?></td>
              <td><?php if($row_students['attendStatus']=='present') echo 'Present'; else{ echo 'Absent';}?></td>
              <?php 
				//counting attended lectures
				$sql_count=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE attendDate BETWEEN '".$row_send['dateFrom']."' AND '".$row_send['dateTo']."' AND
				subjectID='".$row_students['subjectID']."' AND attend_StudID='".$row_students['attend_StudID']."' AND attendStatus='present'");
  				$totalAttended=mysqli_num_rows($sql_count);
				//counting total lectures
				$sql_count_total=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE attendDate BETWEEN '".$row_send['dateFrom']."' AND '".$row_send['dateTo']."' AND
				subjectID='".$row_students['subjectID']."' AND attend_StudID='".$row_students['attend_StudID']."'");
  				$totalLectures=mysqli_num_rows($sql_count_total);
				?>
              <td><?php echo $totalAttended; ?> of <?php echo $totalLectures; ?></td>
              <td><?php if ($totalLectures!=0) { echo round($totalAttended/$totalLectures*100); }else { echo '0';} ?>
                %</td>
            </tr>
            <?php }} ?>
          </table>
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
