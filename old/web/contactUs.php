<?php require '../config.php'; 
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}

$eventName_query=mysqli_query($dbconfig,"SELECT * FROM events WHERE eventID='".$_REQUEST['eventid']."' ");
$row_web_name=mysqli_fetch_assoc($eventName_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Contact us : Oyemate</title>
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
          <div id="sendSuccess"> </div>
          
          <div class="text_area_home">
            <p align="center"><b> <b>Contact us</p>
          </div>
          
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="contactUs" />
              <input type="hidden" name="userID" value="<?php echo $user['userID']; ?>" />
          <div class="text_area_home">
              <input type="text" disabled="disabled" value="<?php echo $user['userName']; ?>" class="form-control" name="userName" />
          </div>
          
          <div class="text_area_home">
             <textarea class="form-control" name="contactMessage" placeholder="Message here" /></textarea>
          </div>
        <div class="text_area_home">
          <input type="submit" value="SEND" class="sendMsg col-xs-12 btn btn-primary btn-xs btn-rect"  />
        </form>
        </div>
           <script>
			$(".sendMsg").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertSMData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("sendSuccess").innerHTML=response; 
 		}
 		}); });
		</script>
        <div class="text_area_home">
        <p align="center"> Your Contact us Messages Status</p>
        </div>
        <?php $sql_contact=mysqli_query($dbconfig,"SELECT * FROM contactus 
		WHERE userID='".$_SESSION['userid']."' ");
		while($row_contact=mysqli_fetch_assoc($sql_contact)){
		?>
         <div class="text_area_home">
         <p><?php echo $row_contact['contactMessage']; ?></p>
         <p><b>Status: </b><?php echo $row_contact['contactStatus']; ?> 
         <small class="floatright"><?php echo "" . humanTiming( $row_contact['contactTime'] ). " ago"; ?></small>
         </p>
         </div> 
		<?php } ?>
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
