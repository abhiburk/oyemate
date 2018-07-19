<?php require '../config.php'; 
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Notification : Oyemate</title>
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
          <div id="createResult"> </div>
          <div id="updateResult"> </div>
          <div class="text_area_home">
            <p align="center"><b>Notifications</b></p>
            </h3>
          </div> <?php if($user['company']=='College Staff'){ ?>
          <div class="text_area_home">
           <?php
				$notification=mysqli_query($dbconfig,"SELECT * FROM send_records LEFT JOIN user ON send_records.sendBy=user.userID
				LEFT JOIN attend_subjects ON send_records.subjectID=attend_subjects.subjectID WHERE sendTo='".$_SESSION['userid']."'
				ORDER BY sendTime DESC");
				$count_noti=mysqli_num_rows($notification);
				if($count_noti=='') {echo 'No Notificaton Available';}else {
  				while($row_notification=mysqli_fetch_assoc($notification)){ ?>
            <div class="left-menu-margin"  style=" <?php if($row_notification['readStatus']=='unread'){ ?> background-color:#E4E4E4; <?php }?>  padding:5px; margin-bottom:3px;">
              <p style="display:inline; <?php if($row_notification['readStatus']=='unread'){ ?> font-weight:bold<?php }?>"> <a href="user/<?php echo $row_notification['userID']; ?>"><?php echo $row_notification['userName'] ?></a> has send you <a href="viewNotification.php?srID=<?php echo $row_notification['srID']; ?>"><?php echo $row_notification['subjectName'] ?> sheet </a> <small class="floatright"><?php echo "" . humanTiming( $row_notification['sendTime'] ). " ago"; ?></small> </p>
            </div>
            <?php }}?>
          </div><?php }  ?>
          
            <?php if($user['company']=='Student'){
				echo '<div class="text_area_home">';
				$notification=mysqli_query($dbconfig,"SELECT * FROM send_records LEFT JOIN user ON send_records.sendBy=user.userID
				LEFT JOIN attend_subjects ON send_records.subjectID=attend_subjects.subjectID WHERE sendTo='".$_SESSION['userid']."'
				ORDER BY sendTime DESC");
				$count_noti=mysqli_num_rows($notification);
				if($count_noti=='') {echo 'No Notificaton Available';}else {
  				while($row_notification=mysqli_fetch_assoc($notification)){ ?>
            <div class="left-menu-margin"  style=" <?php if($row_notification['readStatus']=='unread'){ ?> background-color:#E4E4E4; <?php }?>  padding:5px; margin-bottom:3px;">
              <p style="display:inline; <?php if($row_notification['readStatus']=='unread'){ ?> font-weight:bold<?php }?>"> <a href="user/<?php echo $row_notification['userID']; ?>"><?php echo $row_notification['userName'] ?></a> has send you <a href="viewNotification.php?srID=<?php echo $row_notification['srID']; ?>"><?php echo $row_notification['subjectName'] ?> sheet </a> <small class="floatright"><?php echo "" . humanTiming( $row_notification['sendTime'] ). " ago"; ?></small> </p>
            </div>
            <?php }} ?>
          </div><?php }  ?>
         
          <script>
			$(".createAttend").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("createResult").innerHTML=response; 
 		}
 		}); });
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
//<!--<?php
//				$notification=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN attend_records ON user.userID=attend_records.userID
//				LEFT JOIN attend_subjects ON attend_records.subjectID=attend_subjects.subjectID
//				WHERE instituteName='".$instituteName."' AND branchName='".$branchName."' AND eduYear='".$eduYear."' AND attendPrivacy='mystudents'
//				GROUP BY attend_records.subjectID ORDER BY recordID DESC");
//  				while($row_notification=mysqli_fetch_assoc($notification)){ ?>
//            <div class="left-menu-margin break"  style=" <?php if($row_notification['readStatus']=='unread'){ ?> background-color:#E4E4E4; <?php }?>  padding:5px; margin-bottom:3px;">
//              <p style="display:inline; <?php if($row_notification['readStatus']=='unread'){ ?> font-weight:bold<?php }?>"> <a href="user.php?userID=<?php echo $row_notification['userID']; ?>"> <?php echo $row_notification['userName']; ?></a> has updated <a href="myAttendance.php?subjectID=<?php echo $row_notification['subjectID']; ?>"><?php echo $row_notification['subjectName'] ?> Sheet </a> of
//                <?php  
//			  $dateFetch=mysqli_query($dbconfig,"SELECT * FROM (SELECT * FROM attend_records ORDER BY recordID DESC) AS t 
//			  WHERE subjectID='".$row_notification['subjectID']."' GROUP BY subjectID ");
//			  while($rowDate=mysqli_fetch_assoc($dateFetch)){
//			  $conv1= strtotime($rowDate['attendDate']);
//			  $date=date('d-M-Y', $conv1);
//			  echo $date; ?>
//                <small class="floatright"><?php echo "" . humanTiming( $rowDate['attendTime'] ). " ago"; //}?></small> </p>
//            </div>
//            <?php //} ?>-->