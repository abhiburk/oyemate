<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
} 

$request_user_query=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_REQUEST['userID']."'");
$request_user=mysqli_fetch_assoc($request_user_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include 'basehref.php'; ?>
<title>Profile : Oyemate</title>
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
          <?php $sql_popular=mysqli_query($dbconfig,"SELECT * FROM colleges LEFT JOIN user ON 
		  		colleges.instituteName=user.instituteName 
		  		WHERE user.userID='".$_REQUEST['userID']."'");
				($rowPopular=mysqli_fetch_assoc($sql_popular));
				
				$upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
				WHERE upload.userID='".$_REQUEST['userID']."' AND uploadDoc!='' ORDER BY uploadID DESC");
				$count_upload=mysqli_num_rows($upload_query);
				$uploaded=mysqli_fetch_assoc($upload_query);
		  ?>
          <div class="text_area_home">
            <div class="content-right">
              <?php if($rowPopular['collegePhoto']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)"></div>'; } else{ ?>
              <a href="<?php echo '../uploads/'.$rowPopular['collegePhoto']; ?>"><div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$rowPopular['collegePhoto']; ?>)"></div></a>
                <?php } ?>
              
              <div class="bnr-img userImg">
                <?php if($request_user['userImg'] == '') { echo '<img src="../images/default.jpg"/>'; } else {?>
                <a href="<?php echo '../uploads/'.$request_user['userImg']; ?>"><img src="<?php echo '../uploads/'.$request_user['userImg']; ?>" /></a>
                <?php } ?>
              </div>
              <div class="bnr-text">
                <a ><h1><?php echo $request_user['userName']; ?></h1></a>
                 <?php 
				 if($request_user['instituteName']!= 'Other') {
				 if($request_user['company']== 'Coaching Staff') {  ?>
                <h5><a href="coaching.php?instituteName=<?php echo $request_user['instituteName']; ?>"><?php echo $request_user['instituteName']; ?></a></h5>
                <?php } else { ?>
                <h5><a href="collegeprofile/<?php echo $request_user['instituteName']; ?>"><?php echo $request_user['instituteName']; ?></a></h5>
                <?php }} ?>
                <div style="display:flex">
                  <p><b>Company: </b><?php echo $request_user['company']; ?></p>
                  |<p><b>Join: </b>  <?php echo "" . humanTiming( $request_user['signupDate'] ). " ago"; ?></p>
                </div>
              </div>
              <div class="btm-num">
                <ul>
                  <li>
                    <h4></h4>
                    <h5></h5>
                  </li>
                  <li>
                    <h4><b> </b> <?php echo $count_upload; ?> </h4>
                    <h5><a class="viewFile" href="#" title="<?php if($count_upload!='') {?>Last Upload: <?php echo $uploaded['uploadDoc']; ?><?php }else echo'No File Uploaded Yet'; ?>">Files</a></h5>
                  </li>
                  <li>
                    <h4></h4>
                    <h5></h5>
                  </li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <!--<?php if($request_user['company']=='College Staff') { ?>
          <div class="text_area_home hideHome">
            <p align="center"><b><a href="#">Ask a Question</a></p>
          </div>
          <?php } ?>-->
          <div class="single_left_coloum_wrapper fileDiv">
            <h2 class="title">Files Uploaded</h2>
            <a class="more viewFile" href="#">Hide</a>
            <?php 
     	  		$upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON 
				upload.userID=user.userID WHERE upload.userID='".$_REQUEST['userID']."' AND uploadDoc!='' ORDER BY uploadID DESC");
				$count_download=mysqli_num_rows($upload_query);
				if($count_download=='') {echo '<div class="left-margin">No Files Uploaded Yet</div>';}else {
				while($uploaded=mysqli_fetch_assoc($upload_query)){
				?>
            <div class="text_area_home">
              <div class="left-margin">
                <p class="floatright">
                  <?php echo "" . humanTiming( $uploaded['uploadTime'] ). " ago"; ?>
                </p>
                <br/>
                <p><?php echo $uploaded['detail']; ?></p>
                <?php if($uploaded['uploadDoc']!='') { ?>
                <h3 class="floatright"><a class="content" title="<?php echo $uploaded['uploadDoc']; ?>" href="download.php?fileDetail=<?php echo $uploaded['uploadDoc']?> &uploadID=<?php echo $uploaded['uploadID']?>"> Download
                  <?php $str=$uploaded['uploadDoc']; if(strlen($str)>=25){ echo substr($str,0,30).'...';}else{echo $str; }?></a>
                </h3>
                <h3><?php echo $uploaded['uploadDoc']; ?> &nbsp;
                  <ul class="dropdown">
                    <a href="#" title="File Download Count" class=" floatright dropbtn">(<?php if($uploaded['downloadCount']==''){echo '0';}else {echo $uploaded['downloadCount'];} ?>)</a>
                                   
                    <li class="dropdown-content">
                      <?php 
						$download_query=mysqli_query($dbconfig,"SELECT * FROM download LEFT JOIN user ON 
						download.userID=user.userID WHERE uploadID=$uploaded[uploadID] ORDER BY downloadID DESC");
						$count_download=mysqli_num_rows($download_query);
						while($downloadby=mysqli_fetch_assoc($download_query)){
						?>
                      <a href="user.php?userID=<?php echo $downloadby['userID']; ?>"><?php echo $downloadby['userName']; ?></a>
                      <?php  } ?>
                    </li>
                  </ul>
                </h3><?php  } ?>
              </div>
            </div>
            <?php }} ?>
          </div>
          <script>
	 		$(document).ready(function(){
  			$("div.fileDiv").hide();
			$("a.viewFile").click(function(){
			$("div.fileDiv").toggle(500);
			return false;	
			});});
	      </script>
          <div class="single_left_coloum_wrapper ">
            <h2 class="title"><?php echo $request_user['userName']; ?> Profile</h2>
            <a class="more toggleOne" href="#">Toggle</a>
            <?php 	
			if(isset($_GET['updateSuccess']) && $_GET['updateSuccess'] == 1) { ?>
            <div id="fade" style="background-color:#0C0;">
              <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Profile Info Updated Successfully </h3>
            </div>
            <?php } ?>
            <div class="left-margin">
              <div class="text_area_home hideHome">
                <h3> Birthday: <a class="">
                  <?php if($request_user['day'].''.$request_user['month'].''.$request_user['year']=='') {echo '<small class="font">Not Available</small>';}else {
				   echo '<small class="font">';echo $request_user['day']; ?> / <?php echo $request_user['month']; ?> / <?php echo $request_user['year']; echo '</small>'; }?> </a> </h3>
              </div>
              <?php if($request_user['company']!= 'Coaching Staff') { ?>
              <div class="text_area_home hideHome">
                <h3> Year: <a class="font"><?php echo $request_user['eduYear']; ?></a> </h3>
              </div>
              <?php } if($request_user['emailPrivacy']=='public') { ?>
              <div class="text_area_home hideHome">
                <h3> Email: <a class="font"><?php echo $request_user['userEmail']; ?></a> </h3>
              </div>
              <?php } ?>
              
              <div class="text_area_home hideHome">
                <h3> Institite: <a class="font"><?php echo $request_user['instituteName']; ?></a> </h3>
              </div>
             <?php if($request_user['company']!= 'Coaching Staff') { ?>
              <div class="text_area_home hideHome">
                <h3> Course: <a class="font"><?php echo $request_user['courseName']; ?></a> </h3>
              </div>
              <?php } ?>
              <div class="text_area_home hideHome">
                <h3> Field: <a class="font" ><?php echo $request_user['branchName']; ?></a> </h3>
              </div>
            </div>
          </div>
          <script>
$(document).ready(function(){
			$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
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
