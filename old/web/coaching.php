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
<base href="//localhost/oyemate/web/"/>
<?php include 'basehref.php'; ?>
<title>Coaching Institute : Oyemate</title>
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
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM coaching_institute LEFT JOIN user ON 
		  		coaching_institute.userID=user.userID WHERE ci_ID='".$_REQUEST['ci_ID']."' OR coaching_institute.instituteName='".$_REQUEST['instituteName']."' ");
				$count_upload=mysqli_num_rows($myCollege_query);
				$rowCollege=mysqli_fetch_assoc($myCollege_query);
		  ?>
          <div class="text_area_home">
            <div class="content-right">
              <?php if($rowCollege['ci_photo']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)">'; } else{ ?>
              <div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$rowCollege['ci_photo']; ?>)">
                <?php } ?>
              </div>
              <div class="bnr-img">
                <?php if($user['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="userImg" />'; } else{ ?>
                <img src="<?php echo '../uploads/'.$user['userImg']; ?>" class="userImg"/>
                <?php } ?>
              </div>
              <div class="bnr-text">
                <h1><?php echo $rowCollege['instituteName']; ?></h1>
                <h3>
                  <p><b>Type:</b> <?php echo $rowCollege['branchName']; ?></p>
                </h3>
                <?php if($rowCollege['ci_Contact']=='') { echo '<p>Phone:Not Available</p>'; } else {?>
                <p><b>Phone:</b> <?php echo $rowCollege['ci_Contact']; ?></p>
                <h3>
                  <p>
                    <?php if($rowCollege['ci_Address']=='') { echo '<h5>Address:Not Available</h5>'; } else {?>
                    <?php echo $rowCollege['ci_Address']; }?>
                  </p>
                </h3>
                <?php } ?>
                <a href="#" class="clickStar1 floatright" >Rate this</a> <a href="#" class="clickStar2 floatright" >Hide this</a> </div>
              <div class="btm-num hideStar">
                <ul>
                  <li>
                    <h4><?php echo $rowCollege['ci_views']; ?></h4>
                    <h5>Views</h5>
                  </li>
                  <li>
                    <?php $sql = mysqli_query($dbconfig,"SELECT AVG(ci_rating) as rating_avg FROM coaching_institute_rating 
						  WHERE ci_ID='".$rowCollege['ci_ID']."'");
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
                    <h4><?php if($rowCollege['ci_ratingCount']!=''){ echo $rowCollege['ci_ratingCount'];} else{echo '0';} ?></h4>
                    <h5>Rating</h5>
                  </li>
                </ul>
              </div>
              <div class="btm-num showStar">
                <ul>
                  <li> </li>
                  <li>
                    <?php 	$sql = mysqli_query($dbconfig,"SELECT * FROM coaching_institute_rating 
							WHERE `userID`='".$_SESSION['userid']."' AND ci_ID='".$rowCollege['ci_ID']."'");
    						$row = mysqli_fetch_assoc($sql);
							?>
                    <h4>
                      <fieldset id='demo1' class="rating">
                        <input type="hidden" name="xAction" id="xAction" value="coachingRate" />
                        <input class="stars" type="hidden" id="collegeID" name="ci_ID" value="<?php echo $rowCollege['ci_ID']; ?>" />
                        <input class="stars" type="radio" id="star5" name="rating" value="5"<?php if($row['ci_rating'] == '5'){ echo 'checked';}?> />
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4"<?php if($row['ci_rating'] == '4'){ echo 'checked';}?> />
                        <label class = "full" for="star4" title="Pretty Good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3"<?php if($row['ci_rating'] == '3'){ echo 'checked';}?>/>
                        <label class = "full" for="star3" title="Average - 3 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2"<?php if($row['ci_rating'] == '2'){ echo 'checked';}?> />
                        <label class = "full" for="star2" title="Kinda Bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1"<?php if($row['ci_rating'] == '1'){ echo 'checked';}?> />
                        <label class = "full" for="star1" title="Very Bad time - 1 star"></label>
                      </fieldset>
                    </h4>
                    <script>          
					  		$(document).ready(function () {
                            $("#demo1 .stars").click(function () {
    							var val1 = $('#collegeID').val();
								var val2 = $('#xAction').val();
                                $.post('rating.php?xAction="coachingRate"',{rating:$(this).val(),ci_ID:val1,xAction:val2},function(d){
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
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN coaching_institute ON 
				user.userID=coaching_institute.userID WHERE ci_ID='".$rowCollege['ci_ID']."'");
				$infoUpdated=mysqli_fetch_assoc($myCollege_query);
		  	
				$upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
				WHERE upload.userID='".$rowCollege['userID']."' ORDER BY uploadID DESC");
				$count_upload=mysqli_num_rows($upload_query);
			 
				$sqlUpload=mysqli_query($dbconfig,"SELECT * FROM coaching_institute_students 
				WHERE userID = '".$_SESSION['userid']."' AND ci_ID = '".$infoUpdated['ci_ID']."'");
				$checkUser=mysqli_num_rows($sqlUpload);
				$coach=mysqli_fetch_assoc($sqlUpload);
				if($checkUser !=0){
			 ?>
          <div class="text_area_home">
            <?php if($infoUpdated['userID']='') { echo '<h3>Info not updated yet</<h3>'; } else {?>
            <h3>Files: <a class="viewFile" href="#" title="<?php if($count_upload !='') {?>Last Upload: <?php echo $infoUpdated['uploadDoc']; ?><?php }else echo'No File Uploaded Yet'; ?>"><?php echo $count_upload; ?> (View)</a> </h3>
            <?php } ?>
          </div>
          <?php } ?>
          <script>
	 		$(document).ready(function(){
			$("a.viewFile").click(function(){
			$("div.fileDiv").toggle(500);
			return false;	
			});});
	 
     		$(document).ready(function(){
  			$("div#hide_img_btn").hide();
			$("a.collegePhoto").click(function(){
			$("div#hide_img_btn").toggle(500);
			return false;	
			});});
			
			$(document).ready(function(){
  			$("div.hideFee").hide();
			$("a.clickFee").click(function(){
			$("div.hideFee").toggle(500);
			return false;	
			});});
     </script>
          <div class="single_left_coloum_wrapper ">
            <h2 class="title">Institute Info</h2>
            <a class="more toggleOne" href="#">Toggle</a>
            <div class="left-margin">
              <div class="text_area_home hideHome">
                <h3> Address: <small class="font">
                  <?php if($rowCollege['ci_Address']==''){echo 'No Info Available';}else { echo $rowCollege['ci_Address']; }?>
                  </small></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Contact Info: <small class="font">
                  <?php if($rowCollege['ci_Contact']==''){echo 'No Info Available';}else { echo $rowCollege['ci_Contact']; } ?>
                  </small></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Website: <small class="font">
                  <?php if($rowCollege['ci_Website']==''){echo 'No Info Available';}else {  echo $rowCollege['ci_Website'];} ?>
                  </small></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Coaching Hours: <small class="font">
                  <?php if($rowCollege['startHour']==''){echo 'No Info Available';}else {  echo $rowCollege['startHour']; ?>
                  -<?php echo $rowCollege['closeHour']; }?></small></h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Fee Structure: <small class="font">Click View to see Fee Structure </small>
                  <div class="floatright"><a href="#" class="clickFee">View </a></div>
                </h3>
              </div>
            </div>
            <div class="left-margin">
              <div class="text_area_home hideHome hideFee">
                <?php 
				$fee_query=mysqli_query($dbconfig,"SELECT * FROM coaching_fee 
				WHERE userID='".$rowCollege['userID']."'");
				$count_fee_data=mysqli_num_rows($fee_query);
				
				if ($count_fee_data == 0) { echo 'Data Not Available';}else {
				while($fee_row=mysqli_fetch_assoc($fee_query)){
		  		?>
                <div class="hideFee"> <?php echo $fee_row['courseName']; ?>: <small class="font"> &#8377 <?php echo $fee_row['courseFee']; ?></small>
                  <div class="floatright"><small class="feeTime">
                    <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $fee_row['cf_time'] ). " ago"; ?>
                    </small> 
                    <!--| <a class="editFee showCourseFee" href="#" rel="<?php echo $fee_row['cf_ID']; ?>">Satisfied</a> | <a class="editFee" href="#">Unsatisfied</a>--> 
                  </div>
                </div>
                <?php }} ?>
              </div>
            </div>
            <?php 
		 		$check_query=mysqli_query($dbconfig,"SELECT * FROM coaching_institute_students LEFT JOIN user ON 
		 		coaching_institute_students.userID=user.userID WHERE user.userID='".$_SESSION['userid']."' AND ci_ID= '".$rowCollege['ci_ID']."'");
				$check_student=mysqli_num_rows($check_query);
				if($check_student>0){
		
$start=0;
$limit=1;
if(isset($_GET['uploadID'])){
	$uploadID=$_GET['uploadID'];
	$start=($uploadID-1)*$limit;}
else{ $uploadID=1; }?>
            <div class="single_left_coloum_wrapper ">
              <h2 class="title">Files Uploaded</h2>
              <a class="more viewFile" href="#">Hide</a>
              <?php 
     	  		$upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
				WHERE upload.userID='".$rowCollege['userID']."' ORDER BY uploadID DESC LIMIT $start,$limit ");
				$count_upload=mysqli_num_rows($upload_query);
				if($count_upload==0){ echo '<div class="text_area_home">No Data Available</div>';} else{
				while($rowUpload=mysqli_fetch_assoc($upload_query)){
				?>
              <div class="text_area_home fileDiv">
                <h3> <a href="user.php?userID=<?php echo $rowUpload['userID']; ?>"> <?php echo $rowUpload['userName']; ?></a>
                  <div style="float:right; display:inline-block; font-size:11px;font-weight: normal;">
                    <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $rowUpload['uploadTime'] ). " ago"; ?>
                  </div>
                </h3>
                <img src="<?php echo '../uploads/'.$rowUpload['uploadDoc']; ?>" class="img-responsive timelineImg" alt="" />
                <p class="hideDetail<?php echo $rowUpload['uploadID']; ?> hideAll">
                  <?php $str=$rowUpload['detail']; if(strlen($str)>=101){ echo substr($str,0,100).'...';}else {echo $str;} ?>
                </p>
                <span class="more_text<?php echo $rowUpload['uploadID']; ?> hideAll">
                <p><?php echo $rowUpload['detail']; ?></p>
                <span class="miscs">
                <?php $download_query=mysqli_query($dbconfig,"SELECT * FROM download LEFT JOIN user ON download.userID=user.userID 
						WHERE  uploadID=$rowUpload[uploadID] ORDER BY downloadID DESC");
						$count_download=mysqli_num_rows($download_query);
						$downloadby=mysqli_fetch_assoc($download_query);
							 if($count_download !=0){ ?>
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <h3>Last Downloaded: <?php echo $downloadby['userName']; ?> | &nbsp;</h3>
                <?php }}?>
                </span><br/>
                </span> <span class="miscs">
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <h3>Downloaded: <?php echo $rowUpload['downloadCount']; ?> | &nbsp;</h3>
                <?php } ?>
                </span>
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <h3><a title="<?php echo $rowUpload['uploadDoc']; ?>" href="download.php?fileDetail=<?php echo $rowUpload['uploadDoc']?> &uploadID=<?php echo $rowUpload['uploadID']?>"> Download
                  <?php $str=$rowUpload['uploadDoc']; if(strlen($str)>=25){echo substr($str,0,30).'...';}else {echo $str;} ?>
                  </a></h3>
                <?php } ?>
                <a class="readmore showMore" rel="<?php echo $rowUpload['uploadID']; ?>" href="#" style="float:right">read more</a> <a class="readmore hideMore" rel="<?php echo $rowUpload['uploadID']; ?>" href="#" style="float:right">hide more</a> </div>
              <?php } }?>
              <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
WHERE upload.userID='".$rowCollege['userID']."'"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
<?php if($uploadID>1)
{?>
   <a href="?uploadID=<?php echo ($uploadID-1); ?>&ci_ID=<?php echo $rowCollege['ci_ID']; ?>"class='popular_more hideHome'> prev </a>
<?php
}
if($uploadID!=$total)
{ ?>
   <a href="?uploadID=<?php echo ($uploadID+1); ?>&ci_ID=<?php echo $rowCollege['ci_ID']; ?>"class='popular_more hideHome'> more </a>
 <?php }
 echo  '</div>';
 } ?>
          </div>
          <script>
$(document).ready(function(){
			$("span.hideAll").hide();
			$("a.hideMore").hide();
		$("a.showMore").click(function(){
			$("a.hideMore").show();	
			$("a.showMore").hide();
			var uploadID= $(this).attr('rel');
			$("p.hideDetail"+uploadID).toggle(500);
			$("span.more_text" +uploadID).toggle(1000);
			return false;	
		});
		$("a.hideMore").click(function(){
			$("a.hideMore").hide();	
			$("a.showMore").show();
			var uploadID= $(this).attr('rel');
			$("p.hideDetail"+uploadID).toggle(500);
			$("span.more_text" +uploadID).toggle(1000);
			return false;	
		});
		$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			$(".hideFee").toggle();
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
$ci_ID=$rowCollege['ci_ID'];

$sqlCheck=mysqli_query($dbconfig,"SELECT * FROM coaching_institute_views WHERE ci_ID ='".$ci_ID."' AND userID='".$_SESSION['userid']."'");
$count=mysqli_num_rows($sqlCheck);
if($count == 0){
$sql=mysqli_query($dbconfig,"INSERT INTO coaching_institute_views (ci_ID,userID,ci_viewTime) VALUES ('".$ci_ID."','".$_SESSION['userid']."','".$time."')");
$sql_count=mysqli_query($dbconfig,"UPDATE coaching_institute SET ci_views=ci_views+1 WHERE ci_ID='".$ci_ID."'");
} 
?>
