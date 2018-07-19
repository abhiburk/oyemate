<?php require '../config.php';
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
$RequestInstitute=mysql_real_escape_string($_REQUEST['instituteName']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'basehref.php'; ?>
<title>College Profile : Oyemate</title>
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
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM colleges WHERE colleges.instituteName='".$RequestInstitute."'");
		  		$count_upload=mysqli_num_rows($myCollege_query);
		  		$rowCollege=mysqli_fetch_assoc($myCollege_query);
		 ?>
          <div class="text_area_home">
            <div class="content-right">
              <?php if($rowCollege['collegePhoto']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)">'; } else{ ?>
              <a href="<?php echo '../uploads/'.$rowCollege['collegePhoto']; ?>"> 
             <div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$rowCollege['collegePhoto']; ?>)"></div>
             </a><?php } ?>
              <div class="bnr-img">
                <?php if($user['userImg']=='') { 
                  echo '<img src="../images/default.jpg" />'; } else{ ?>
                <a href="<?php echo '../uploads/'.$user['userImg']; ?>"><img src="<?php echo '../uploads/'.$user['userImg']; ?>" class="userImg"/></a>
                <?php } ?>
              </div>
              <div class="bnr-text">
                <h1><?php echo $rowCollege['instituteName']; ?></h1>
                <?php if($rowCollege['collegeWebsite']=='') { echo '<h5>Website:Not Available</h5>'; } else {?>
                <h5><a class="lower" href="http://<?php echo $rowCollege['collegeWebsite']; ?>" ><?php echo $rowCollege['collegeWebsite']; ?></a></h5>
                <?php } ?>
                <?php if($rowCollege['collegeContact']=='') { echo '<p>Phone:Not Available</p>'; } else {?>
                <p><b>Phone:</b> <?php echo $rowCollege['collegeContact']; ?></p>
                <?php } ?>
                <a href="#" class="clickStar1 floatright" >Rate this</a> <a href="#" class="clickStar2 floatright" >Hide this</a> </div>
              <div class="btm-num hideStar">
                <ul>
                  <li>
                    <h4><?php echo $rowCollege['views']; ?></h4>
                    <h5>Views</h5>
                  </li>
                  <li>
                    <?php $sql = mysqli_query($dbconfig,"SELECT AVG(rating) as rating_avg FROM college_rating 
						  WHERE collegeID='".$rowCollege['collegeID']."'");
    					  while($row = mysqli_fetch_assoc($sql)){
					?>
                    <h4>
                      <fieldset id='demo2' class="rating1">
                        <input class="stars" type="radio" id="star55" value="5"<?php if(round($row['rating_avg']) == '5'){ echo 'checked';}?> />
                        <span class = "full1" for="star5" title="Awesome - 5 stars"></span>
                        <input class="stars" type="radio" id="star44" value="4"<?php if(round($row['rating_avg']) == '4'){ echo 'checked';}?> />
                        <span class = "full1" for="star4" title="Pretty Good - 4 stars"></span>
                        <input class="stars" type="radio" id="star33" value="3"<?php if(round($row['rating_avg']) == '3'){ echo 'checked';}?>/>
                        <span class = "full1" for="star3" title="Average - 3 stars"></span>
                        <input class="stars" type="radio" id="star22" value="2"<?php if(round($row['rating_avg']) == '2'){ echo 'checked';}?> />
                        <span class = "full1" for="star2" title="Kinda Bad - 2 stars"></span>
                        <input class="stars" type="radio" id="star11" value="1"<?php if(round($row['rating_avg']) == '1'){ echo 'checked';}?> />
                        <span class = "full1" for="star1" title="Very Bad time - 1 star"></span>
                      </fieldset>
                    </h4>
                    <?php } ?>
                    <script>    
					      
					  		$(document).ready(function(){
  							$("div.showStar").hide();
							$("a.clickStar2").hide();
							$("a.clickStar1").click(function(){
							$("div.hideStar").hide(250);
							$("div.showStar").show(250);
							$("a.clickStar1").hide();
							$("a.clickStar2").show();
							return false;	
							});
							$("a.clickStar2").click(function(){
							$("div.hideStar").show(250);
							$("div.showStar").hide(250);
							$("a.clickStar1").show();
							$("a.clickStar2").hide();
							return false;	
							});
							});
                    </script> 
                  </li>
                  <li>
                    <h4><?php if($rowCollege['ratingCount']!=''){ echo $rowCollege['ratingCount'];} else{echo '0';} ?></h4>
                    <h5>Rating</h5>
                  </li>
                </ul>
              </div>
              <div class="btm-num showStar">
                <ul>
                  <li> </li>
                  <li>
                    <?php $sql = mysqli_query($dbconfig,"SELECT * FROM college_rating 
						  WHERE `userID`='".$_SESSION['userid']."' AND collegeID='".$rowCollege['collegeID']."'");
    					  $row = mysqli_fetch_assoc($sql);
					?>
                    <h4>
                      <fieldset id='demo1' class="rating">
                        <input type="hidden" name="xAction" id="xAction" value="collegeRate" />
                        <input class="stars" type="hidden" id="collegeID" name="collegeID" value="<?php echo $rowCollege['collegeID']; ?>" />
                        <input class="stars" type="radio" id="star5" name="rating" value="5"<?php if($row['rating'] == '5'){ echo 'checked';}?> />
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4"<?php if($row['rating'] == '4'){ echo 'checked';}?> />
                        <label class = "full" for="star4" title="Pretty Good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3"<?php if($row['rating'] == '3'){ echo 'checked';}?>/>
                        <label class = "full" for="star3" title="Average - 3 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2"<?php if($row['rating'] == '2'){ echo 'checked';}?> />
                        <label class = "full" for="star2" title="Kinda Bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1"<?php if($row['rating'] == '1'){ echo 'checked';}?> />
                        <label class = "full" for="star1" title="Very Bad time - 1 star"></label>
                      </fieldset>
                    </h4>
                    <script>          
					  		$(document).ready(function () {
                            $("#demo1 .stars").click(function () {
    							var val1 = $('#collegeID').val();
								var val2 = $('#xAction').val();
                                $.post('rating.php',{rating:$(this).val(),collegeID:val1,xAction:val2},function(d){
                                    if(d>0)
                                    {
                                        alert('You Already Rated');
                                    }else{
                                        alert('Thanks For Rating');
                                    }
                                });
                                $(this).attr("checked");
                            });
                        });
                    </script> 
                  </li>
                  <li> </li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM user INNER JOIN colleges ON 
				user.userID=colleges.userID WHERE collegeID='".$rowCollege['collegeID']."'");
				$infoUpdated=mysqli_fetch_assoc($myCollege_query);
		  ?>
          <!--<div class="text_area_home">
            <?php if($infoUpdated['userID']=='') { echo '<h3>Info not updated yet</<h3>'; } else {?>
            <h3> <b>Last Info Updated:</b> <a href="user.php?userID=<?php echo $infoUpdated['userID']; ?>"><?php echo $infoUpdated['userName']; ?> <a class="floatright" >
              <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $infoUpdated['collegeUpdateTime'] ). " ago"; ?>
              </a></h3>
            <?php } ?>
          </div>--> 
          <script>
	 		$(document).ready(function(){
  			$("div.fileDiv").hide();
			$("a.viewFile").click(function(){
			$("div.fileDiv").toggle(500);
			return false;	
			});});
     </script>
          <div class="single_left_coloum_wrapper ">
            <h2 class="title">Institute Info</h2>
            <a class="more toggleOne" href="#">Toggle</a>
            <div class="left-margin">
              <div class="text_area_home hideHome">
                <h3> <b>Address:</b> <a class="font"><?php echo $rowCollege['collegeAddress']; ?></a></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> <b>Contact Info:</b> <a class="font"><?php echo $rowCollege['collegeContact']; ?></a></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> <b>Website:</b> <a class="lower font" href="http://<?php echo $rowCollege['collegeWebsite']; ?>"><?php echo $rowCollege['collegeWebsite']; ?></a></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> <b>Director:</b> <a class="font"><?php if($rowCollege['collegeDirector']==''){echo 'Not Available';}else echo $rowCollege['collegeDirector']; ?></a></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> <b>Institute Code:</b> <a class="font" ><?php echo $rowCollege['collegeCode']; ?></a></h3>
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
<?php 
$time=time();
$collegeID=$rowCollege['collegeID'];

$sqlCheck=mysqli_query($dbconfig,"SELECT * FROM college_views WHERE collegeID ='".$collegeID."' AND userID='".$_SESSION['userid']."'");
$count=mysqli_num_rows($sqlCheck);
if($count == 0){
$sql=mysqli_query($dbconfig,"INSERT INTO college_views (collegeID,userID,viewTime) VALUES ('".$collegeID."','".$_SESSION['userid']."','".$time."')");
$sql_count=mysqli_query($dbconfig,"UPDATE colleges SET views=views+1 WHERE collegeID='".$collegeID."'");
} 
?>
