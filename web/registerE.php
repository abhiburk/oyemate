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
<title>Event Registration : Oyemate</title>
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
          <div id="registersuccess"> </div>
          <div class="text_area_home">
            <p align="center"><b> <b>Fill Below Details to get Register for <?php echo $row_web_name['eventName']; ?></p>
          </div>
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="eventRegister" />
            <input type="hidden" name="eventID" value="<?php echo $_REQUEST['eventid']; ?>" />
            <div class="text_area_home">
              <input type="text" disabled="disabled" value="<?php echo $user['userName']; ?>" class="form-control" name="userName" />
            </div>
            <div class="text_area_home">
              <input type="text" class="form-control" name="participantContact" placeholder="Enter Your Phone No." />
            </div>
            <div class="text_area_home">
              <h3 style="display: flex;margin: 0;">
              <select name="compEID" class="form-control" onChange="outputValue(this)" id="compFee">
                <option value="">Select Competition</option>
                <?php $sql_created=mysqli_query($dbconfig,"SELECT * FROM comp_fee WHERE eventID='".$_REQUEST['eventid']."' ");
  				while($row_created=mysqli_fetch_assoc($sql_created)){ ?>
                <option value="<?php echo $row_created['compEID']; ?>" data-fee="<?php echo $row_created['compFee']; ?>"><?php echo $row_created['compName']; ?></option>
                <?php } ?>
              </select>
              <input class="form-control" type='text' id="feeOutput" disabled="disabled" placeholder="Competition Fee" />
            </div>
            </h3>
            <div class="text_area_home">
              <select id="options" class="form-control" onchange="setbox(this.value)">
                <option value="">Select No of Partners for this Competition</option>
                <option value="1">Single</option>
                <option value="2">Team</option>
              </select>
              <input class="form-control space part1" type='text' name="part1" placeholder="Name of Partner 1" />
              <input class="form-control space part2" type='text' name="part2" placeholder="Name of Partner 2" />
              <input class="form-control space part3" type='text' name="part3" placeholder="Name of Partner 3" />
              <input class="form-control space part4" type='text' name="part4" placeholder="Name of Partner 4" />
              <input class="form-control space part5" type='text' name="part5" placeholder="Name of Partner 5" />
            </div>
            <input type="submit" value="Register Me" class="registerUser floatright  btn btn-primary btn-xs btn-rect"  />
          </form>
          <script>
			$(".registerUser").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertEvent.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("registersuccess").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script> 
          <script>
		$(document).ready(function(){
		$(".part1").hide();$(".part2").hide();$(".part3").hide();$(".part4").hide();$(".part5").hide();
	 	$('#options').on('change',function(){
		if( $(this).val()== "2"){
		$(".part1").show()
		$(".part2").show()
		$(".part3").show()
		$(".part4").show()
		$(".part5").show()
		$(".space").addClass("space")
		}
		if( $(this).val()== "1"){
		$(".part1").hide()
		$(".part2").hide()
		$(".part3").hide()
		$(".part4").hide()
		$(".part5").hide()
		$(".space").addClass("space")
		}
        
});
});
</script> 
          <script>
$(function () {
    $('#compFee').change(function () {
        $('#feeOutput').val($('#compFee option:selected').attr('data-fee'));
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
