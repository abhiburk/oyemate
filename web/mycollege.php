<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My College : Oyemate</title>
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
        <div id="requestSuccess"></div>
          <?php		$check_req_sql=mysqli_query($dbconfig,"SELECT * FROM college_request
					WHERE userID='".$_SESSION['userid']."'");
				 	$count_req=mysqli_num_rows($check_req_sql);
					$row_req=mysqli_fetch_assoc($check_req_sql);
		  if($user['instituteName']== 'Other') { 
			if($row_req['acceptStatus']=='accepted'){ ?>
          <div id="fade" style="background-color:#0C0;">
            <h3 class="notification" id="fade1" style="color:#fff;"> Your Request has been Accepted for <?php echo $row_req['instituteName'] ?> and will be updated automatically for your account</h3>
          </div>
          <?php }else { ?>
          <?php  if($row_req['acceptStatus']=='rejected'){ ?>
          <div id="fade" style="background-color:#F00;">
            <h3 class="notification" id="fade1" style="color:#fff;"> Your Request has been Rejected due to some reason.Please Try Again with Appropriate Details</h3>
          </div>
          <?php } else {  ?>
          <?php  if($row_req['acceptStatus']=='pending'){ ?>
          <div id="fade" style="background-color:#FF6;">
            <h3 class="notification" id="fade1" style="color:#000;"> Your Request is pending and will process soon</h3>
          </div>
          <?php } else {  ?>
          <?php  if(isset($_GET['reqCollege']) && $_GET['reqCollege'] == 1){ ?>
          <div id="fade" style="background-color:#F00;">
            <h3 class="notification" id="fade1" style="color:#FFF;"> Your College is Not in our list Request your college here </h3>
          </div>
          <?php }}}} ?>
          <?php if($count_req == 1){ ?>
          <div id="fade" style="background-color:#0C0;">
            <h3 class="notification" id="fade1" style="color:#fff; "> You have requested for <?php echo $row_req['instituteName'] ?> </h3>
          </div>
          <?php }} else echo '';  ?>
          
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM colleges LEFT JOIN user ON 
		  		colleges.instituteName=user.instituteName WHERE colleges.instituteName='".($instituteName)."'");
				$count_upload=mysqli_num_rows($myCollege_query);
				$rowCollege=mysqli_fetch_assoc($myCollege_query);
		  ?>
          <div class="text_area_home other">
            <div class="content-right">
              <?php if($rowCollege['collegePhoto']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)"></div>'; } else{ ?>
              <div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$rowCollege['collegePhoto']; ?>)"></div>
                <?php } ?>
              
              <div class="bnr-img">
                <?php if($user['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="userImg" />'; } else{ ?>
                <img src="<?php echo '../uploads/'.$user['userImg']; ?>" class="userImg"/>
                <?php } ?>
              </div>
              <div class="bnr-text">
                <h6><a href="#" class="collegePhoto floatright" ><i class="glyphicon glyphicon-pencil"></i> Photo</a></h6>
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
                    <?php 
						$sql = mysqli_query($dbconfig,"SELECT AVG(rating) as rating_avg FROM college_rating
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
                    <?php 	$sql = mysqli_query($dbconfig,"SELECT * FROM college_rating 
							WHERE `userID`='".$_SESSION['userid']."'");
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
            <div class="floatright text_area_button" id="hide_img_btn">
              <form  method="post" enctype="multipart/form-data" action="update_photo.php">
                <input type="hidden" name="xAction" value="collegePhoto"/>
                <input type="hidden" name="collegeID" value="<?php echo $rowCollege['collegeID']; ?>" />
                <div class="fileupload fileupload-new" data-provides="fileupload"> <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"> </span> <span class="btn btn-file btn btn-xs btn-primary" > <i class="glyphicon glyphicon-pencil"></i> <span class="fileupload-new">Select</span> <span class="fileupload-exists" >Change</span>
                  <input type="file" name="collegePhoto" required/>
                  </span> <!--<a href="#" class="btn btn-file btn btn-xs btn-primary fileupload-exists" data-dismiss="fileupload"><i class="glyphicon glyphicon-remove"></i> Remove</a>-->
                  <input class="btn btn-file btn btn-xs btn-primary fileupload-exists"  type="submit" value="Save">
                </div>
              </form>
            </div>
          </div>
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM user INNER JOIN colleges ON 
				user.userID=colleges.userID WHERE collegeID='".$rowCollege['collegeID']."'");
				$infoUpdated=mysqli_fetch_assoc($myCollege_query);
		  ?>
          <div class="single_left_coloum_wrapper fileDiv">
            <h2 class="title">Files Uploaded</h2>
            <a class="more viewFile" href="#">Hide</a>
          <?php $upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON 
				upload.userID=user.userID WHERE upload.userID='".$user['userID']."' AND uploadDoc!='' ORDER BY uploadID DESC");
				$count_download=mysqli_num_rows($upload_query);
				while($uploaded=mysqli_fetch_assoc($upload_query)){
				?>
            <div class="text_area_home">
              <div class="left-margin">
                <p class="floatright">
                  <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $uploaded['uploadTime'] ). " ago"; ?>
                </p>
                <br/>
                <p><?php echo $uploaded['detail']; ?></p>
                <h3><?php echo $uploaded['uploadDoc']; ?> &nbsp;
                  <ul class="dropdown">
                    <a href="#" title="File Download Count" class=" floatright dropbtn">(<?php echo $uploaded['downloadCount']; ?>)</a>
                    <li class="dropdown-content">
                  <?php $download_query=mysqli_query($dbconfig,"SELECT * FROM download LEFT JOIN user ON 
						download.userID=user.userID WHERE uploadID=$uploaded[uploadID] ORDER BY downloadID DESC");
						$count_download=mysqli_num_rows($download_query);
						while($downloadby=mysqli_fetch_assoc($download_query)){
						?>
                      <a href="#"><?php echo $downloadby['userName']; ?></a>
                      <?php  } ?>
                    </li>
                  </ul>
                </h3>
              </div>
            </div>
            <?php } ?>
          </div>
          <script>
	 		$(document).ready(function(){
  			$("div.fileDiv").hide();
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
     </script> 
          <script>
                  <?php if($user['instituteName']=='Other') { ?>
				  $("div.other").hide();
				  <?php } else { ?> 
				   $("div.other").show();
				   <?php } ?> 
                </script>
          <div class="single_left_coloum_wrapper ">
            <h2 class="title">Institute Info </h2>
            <a class="more toggleOne" href="#">Toggle</a>
            <div style="color:#F00" class="extra">&nbsp; &nbsp;( * Required )</div>
            <br />
            &nbsp;
            <form id="myform" action="insertData.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="sentRequest" />
              <div class="left-margin">
              <div class="text_area_home hideHome">
                <h3>* Institute Name: 
                  <textarea class="form-control" name="instituteName" placeholder="Enter Name of Institute" required="required" /></textarea>
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3>* Institute Code: 
                  <input type="text" class="form-control " name="collegeCode" placeholder="Institute Code" required />
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Address:
                  <textarea class="form-control " name="collegeAddress" placeholder="Enter Address of Institute" /></textarea>
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Contact Info: 
                  <input type="text" class="form-control" name="collegeContact" placeholder="Institute Contact Info" value="<?php echo $rowCollege['collegeContact']; ?>" />
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Website: 
                  <input type="text" class="form-control" name="collegeWebsite" placeholder="Institute Website" value="<?php echo $rowCollege['collegeWebsite']; ?>" />
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Director: 
                  <input type="text" class="form-control" name="collegeDirector" placeholder="Institute Director" value="<?php echo $rowCollege['collegeDirector']; ?>" />
                </h3>
              </div>
              <input type="submit" value="Save" class="collegeSubmit floatright btn btn-primary btn-xs btn-rect hideHome"  />
            </form>
          </div>
        </div>
        <script>
			$(".collegeSubmit").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php?xAction=coachingInfo",
                data: formData,
                success: function (response) {
  				document.getElementById("requestSuccess").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
		});
				})
		</script>
        <?php if($user['instituteName']=='Other') { ?>
        <script>
$(document).ready(function(){
			$(".extra").show();
			$("a.showCodeField").show();
			$("a.showBranchField").show();
			$("a.showCourseField").show();
			$("a.showInstituteField").show();
			$("a.showAddressField").show();
			$("a.showContactField").show();
			$("a.showWebsiteField").show();
			$("a.showDirectorField").show();
			$("a.showCodeField").show();
			$("a.collegePhoto").show();
			$("input.collegeSubmit").show();
			return false;	
			});
		</script>
        <?php }else { ?>
        <script>
$(document).ready(function(){
			$(".extra").hide();
			$("a.showCodeField").hide();
			$("a.showBranchField").hide();
			$("a.showCourseField").hide();
			$("a.showInstituteField").hide();
			$("a.showAddressField").hide();
			$("a.showContactField").hide();
			$("a.showWebsiteField").hide();
			$("a.showDirectorField").hide();
			$("a.showCodeField").hide();
			$("a.collegePhoto").hide();
			$("input.collegeSubmit").hide();
			return false;	
			});
		</script>
        <?php } ?>
        <script>
$(document).ready(function(){
			$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			$("input.collegeSubmit").hide();			
			return false;	
			});
			
			$("textarea.hideInstitute").hide();
			$("a.showInstituteField").click(function(){
			var userID= $(this).attr('rel');
			$("textarea.hideTextareaInstitute"+userID).toggle(500);
			return false;	
			});
			
			$("input.hideCourse").hide();
			$("a.showCourseField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputCourse"+userID).toggle(500);
			return false;	
			});
			
			$("input.hideBranch").hide();
			$("a.showBranchField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputBranch"+userID).toggle(500);
			return false;	
			});
			
			$("textarea.hideAddress").hide();
			$("a.showAddressField").click(function(){
			var userID= $(this).attr('rel');
			$("textarea.hideTextareaAddress"+userID).toggle(500);
			return false;	
			});
			
			$("input.hideContact").hide();
			$("a.showContactField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputContact"+userID).toggle(500);
			return false;	
			});
			
			$("input.hideWebsite").hide();
			$("a.showWebsiteField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputWebsite"+userID).toggle(500);
			return false;	
			});
			$("input.hideDirector").hide();
			$("a.showDirectorField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputDirector"+userID).toggle(500);
			return false;	
			});
			$("input.hideCode").hide();
			$("a.showCodeField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputCode"+userID).toggle(500);
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
