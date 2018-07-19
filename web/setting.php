<?php require '../config.php'; 
session_start();
ob_start();

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Setting : Oyemate</title>
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
          <div id="settingSuccess"> </div>
          <?php 
		  if($user['userRealPass']==0){
		  if(isset($_GET['passNotSet'])==1){ ?>
		  <div id="fade" style="background-color:#F00;">
            <p><h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Your Password is Not Change Yet.Please Change to your Secure Password.
            <!--<a href="setting.php">Click here to change</a>--></h3></p>
          </div>
		  <?php }}?>
		  
		  
          <div class="text_area_home">
            <p align="center"><b> <b>Settings</p>
          </div>
          <div class="text_area_home">
          <p>Change Password </p>
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="settingPassword" />
              <h3 style="display: flex;">
               <input type="password" class="form-control"  name="userPass" placeholder="Your New Password" style="width:100%" />
               <input type="password" class="form-control" name="userPassRetype" placeholder="Retype Password" style="width:100%" />
              </h3>
               <input type="submit" value="Save" class="settingPassword floatright btn btn-primary btn-xs btn-rect"  />
            </form>
          </div>
          <script>
			$(".settingPassword").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("settingSuccess").innerHTML=response; 
				<?php include 'autoload.php'; ?>
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
