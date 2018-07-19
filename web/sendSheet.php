<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}

$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_subjects WHERE subjectID='".$_REQUEST['subjectID']."' ");
($subject=mysqli_fetch_assoc($sql_created));

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(($user['company']!='College Staff') and ($user['company']!='Coaching Staff')){
  header('LOCATION:home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Send Sheet : Oyemate</title>
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
          <div id="sendSuccess"></div>
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
          <script>
	$(function() {
    $( "#userName" ).autocomplete({
     source: 'searchStudent.php?xAction=<?php echo 'searchUser'; ?>'
    });
	});
</script>
          <div class="text_area_home"> <b class="font-set">Subject: <?php echo $subject['subjectName']; ?></b> </div>
          
          <!--This is Sheet Sending Form-->
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="sheetID" value="<?php echo $_REQUEST['sheetID'];?>" />
            <input type="hidden" name="subjectID" value="<?php echo $_REQUEST['subjectID'];?>" />
            <input type="hidden" name="xAction" value="sendSheet" />
            <div class="text_area_home"> <a href="#" class="clickCalender font-set">Select Date From-To <i class="icon-calendar"></i></a> <small style="display: flex;width: 50%;" class="floatright">
              <input id="userName" name="userName" class="form-control" placeholder="Search user you want to send"/>
              </small> </div>
            <div class="text_area_home hideCalender">
              <h3 style="display: flex;">
                <input name="dateFrom" id="date" onchange="postinput()" class=" click datepicker form-control  floatleft" placeholder="Click Here to Select Date From" style="width:100%" />
                <input name="dateTo" id="date1" onchange="postinput()" class="click datepicker1 form-control floatright" placeholder="Click Here to Select Date To" style="width:100%" />
              </h3>
            </div>
            <div class="loadingDiv">Loading...</div>
            <div id="new_select"></div>
            <input type="submit" value="Send" class="sendSheet floatright btn btn-primary btn-xs btn-rect" />
          </form>
          <script>
 $(document).ready(function(){
	 $(".loadingDiv").hide();
    $("#date1").on('change', function (){
		$(".loadingDiv").show();
		var formData= $(this).closest('form').serialize();
        $.ajax({ 
            url: 'searchDate.php',
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
			$(".sendSheet").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("sendSuccess").innerHTML=response; 
 		}
 		}); });
		</script> 
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
		  $("input.hideSend").hide();
			$("a.clickSend").click(function(){
			$("input.hideSend").toggle(500);
			return false;	
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
<script type="text/javascript">
selectnav('nav', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
selectnav('f_menu', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
$('.bxslider').bxSlider({
    mode: 'fade',
    captions: true
});
</script>
</body>
</html>
