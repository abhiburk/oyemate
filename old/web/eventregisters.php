<?php require '../config.php'; 

if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
$sql_check=mysqli_query($dbconfig,"SELECT DISTINCT events.* FROM events LEFT JOIN event_co ec ON ec.eventID = events.eventID
WHERE events.userID  = {$_SESSION['userid']} OR ec.addedTo = {$_SESSION['userid']}")  or die(mysqli_error($dbconfig));
$check_user=mysqli_num_rows($sql_check);
if($check_user ==''){
	header('LOCATION:home.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Registered Students | Events : Oyemate</title>
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
            <p align="center"><b> <b>Registered User</p>
          </div>
          <?php 
		  		$sql_req=mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN event_register_user ON user.userID=event_register_user.userID
				LEFT JOIN comp_fee ON event_register_user.compEID=comp_fee.compEID
				WHERE event_register_user.eruID='".$_REQUEST['eruID']."' ORDER BY eruID DESC");
				$countData=mysqli_num_rows($sql_req);
  				($row_req=mysqli_fetch_assoc($sql_req));
				if($countData!='') {
		  ?>
          <div class="text_area_home">
            <p><b><a href="user/<?php echo $row_req['userID'] ?>"><?php echo $row_req['userName'] ?></a></b> <b class="floatright">Contact: <?php echo $row_req['participantContact'] ?></b></p>
            <p><b>Competition: <?php echo $row_req['compName'] ?></b> <b class="floatright">Fee: <?php echo $row_req['compFee'] ?></b></p>
            <p><b>
              <?php if($row_req['partner1']!='') {echo 'Partners: '; echo $row_req['partner1'];} ?>
              </b> <b class="floatright">
              <?php if($row_req['partner2']!='') {echo 'Partners: '; echo $row_req['partner1'];} ?>
            </b></p>
            <p><b>
              <?php if($row_req['partner3']!='') {echo 'Partners: '; echo $row_req['partner3'];} ?>
              </b> <b class="floatright">
              <?php if($row_req['partner4']!='') {echo 'Partners: '; echo $row_req['partner4'];} ?>
            </b></p>
            <p><b>
              <?php if($row_req['partner5']!='') {echo 'Partners: '; echo $row_req['partner5'];} ?>
              </b> <b class="floatright"> <?php echo "" . humanTiming( $row_req['eventRegisterTime'] ). " ago";  ?>
            </b></p>
          </div>
          <?php } 
				$sql_created=mysqli_query($dbconfig,"SELECT * FROM event_register_user LEFT JOIN user ON 
				event_register_user.userID=user.userID
				WHERE eventID='".$_REQUEST['eventID']."' ORDER BY eruID DESC");
				$countData1=mysqli_num_rows($sql_created);
  				while($row_created=mysqli_fetch_assoc($sql_created)){ ?>
          <div class="text_area_home">
            <p><b><a href="user/<?php echo $row_created['userID'] ?>"><?php echo $row_created['userName'] ?></b> <small class="floatright"><a href="eventregisters.php?eventID=<?php echo $row_created['eventID'] ?>&eruID=<?php echo $row_created['eruID'] ?>"> View </a> | Contact: <?php echo $row_created['participantContact'] ?> </small> </p>
          </div>
          <?php } if($countData1==''){ echo '<div class="text_area_home">No user registerd yet</div>';} ?>
          <script>
			$(".updateAttend").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("updateResult").innerHTML=response; 
 		}
 		}); });
		</script> 
          <script>
      $(document).ready(function(e) {
        $("input.hideSheet").hide();
			$("a.showSheetField").click(function(){
			var sheetID= $(this).attr('rel');
			$("input.hideInputSheet"+sheetID).toggle(500);
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
