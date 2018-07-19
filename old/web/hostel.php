<?php require '../config.php'; 
session_start();
ob_start();

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
if(($user['company']!='Student')){
  header('LOCATION:home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Matchmate : Oyemate</title>
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
            <div class="single_left_coloum_wrapper single_cat_left">
              <h2 class="title">Hostel coming soon.... </h2>
              <a class="more" href="#">readme</a>
              <div class="single_cat_left_content floatleft">
                <h3>what is hostel feature ?</h3>
                <p>this tool is useful for a user to <b>find out hostels</b> near by them or is a platform to add you hostel services for students</p>
                <p>1. this feature will help a new student to find out best hostel's <b>near</b> to their colleges.</p>
                <p>2. hostel service provider will be able to <b>add their hostels</b> to the list.</p>
                <p>3. their will be <b>no more</b> searching of a place physically for new comer.</p>
                <p>4. feature <b>coming soon</b> on oyemate stay tune....</p>
              </div>
            </div>
          </div>
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
