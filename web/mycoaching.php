<?php require '../config.php'; 
session_start();
ob_start();

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(!isset($_SESSION['userid']) || ($user['company']!='Coaching Staff')){
  header('LOCATION:../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Coaching Institute : Oyemate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        <div id="addsuccess"></div>
          <?php 	
			if(isset($_GET['addSuccess']) && $_GET['addSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0C0;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student Added Successfully </h3>
          </div>
          <?php } ?>
          <?php 	
			if(isset($_GET['fileSuccess']) && $_GET['fileSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0C0;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">File Uploaded Successfully </h3>
          </div>
          <?php } ?>
          <?php 	
			if(isset($_GET['fileFailed']) && $_GET['fileFailed'] == 1) { ?>
          <div id="fade" style="background-color:#F00;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Upload file </h3>
          </div>
          <?php } ?>
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM coaching_institute LEFT JOIN user 
		  		ON coaching_institute.userID=user.userID 
		  		WHERE user.userID='".$_SESSION['userid']."'");
				$count_upload=mysqli_num_rows($myCollege_query);
				$rowCollege=mysqli_fetch_assoc($myCollege_query);
		  ?>
          <div class="text_area_home">
            <div class="content-right">
              <?php if($rowCollege['ci_photo']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)"></div>'; } else{ ?>
              <div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$rowCollege['ci_photo']; ?>)"></div>
                <?php } ?>
              
              <div class="bnr-img">
                <?php if($user['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="userImg"/>'; } else{ ?>
                <img src="<?php echo '../uploads/'.$user['userImg']; ?>" class="userImg"/>
                <?php } ?>
              </div>
              <div class="bnr-text">
                <h6><a href="#" class="collegePhoto floatright" ><i class="glyphicon glyphicon-pencil"></i> Photo</a></h6>
                <h1><a href="coaching/<?php echo $rowCollege['ci_ID']; ?>"><?php echo $rowCollege['instituteName']; ?></a></h1>
                <h3>
                  <p><b>Type:</b> <?php echo $rowCollege['branchName']; ?></p>
                </h3>
                <?php if($rowCollege['ci_Contact']=='') { echo '<p>Phone:Not Available</p>'; } else {?>
                <p><b>Phone:</b> <?php echo $rowCollege['ci_Contact']; ?></p>
                <h3>
                  <p>
                    <?php if($rowCollege['ci_Address']=='') { echo '<h5>Address:Not Available</h5>'; } else {?>
                    <?php echo $rowCollege['ci_Address']; ?>
                    <?php } ?>
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
                    <?php 
						$sql = mysqli_query($dbconfig,"SELECT AVG(ci_rating) as rating_avg FROM coaching_institute_rating 
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
							WHERE `userID`='".$_SESSION['userid']."'");
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
            <div class="floatright text_area_button"  id="hide_img_btn">
              <form  method="post" enctype="multipart/form-data" action="update_photo.php">
                <input type="hidden" name="xAction" value="ciPhoto"/>
                <input type="hidden" name="ci_ID" value="<?php echo $rowCollege['ci_ID']; ?>" />
                <div class="fileupload fileupload-new" data-provides="fileupload"> <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"> </span> <span class="btn btn-file btn btn-xs btn-primary" > <i class="glyphicon glyphicon-pencil"></i> <span class="fileupload-new">Select</span> <span class="fileupload-exists" >Change</span>
                  <input type="file" name="ci_Photo" required/>
                  </span> <!--<a href="#" class="btn btn-file btn btn-xs btn-primary fileupload-exists" data-dismiss="fileupload"><i class="glyphicon glyphicon-remove"></i> Remove</a>-->
                  <input class="btn btn-file btn btn-xs btn-primary fileupload-exists"  type="submit" value="Save">
                </div>
              </form>
            </div>
          </div>
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN coaching_institute 
				ON user.userID=coaching_institute.userID WHERE ci_ID='".$rowCollege['ci_ID']."'");
				$infoUpdated=mysqli_fetch_assoc($myCollege_query);
		  ?>
          <!--<div class="text_area_home hideHome">
            <?php if($infoUpdated['userID']='') { echo '<h3>Info not updated yet</<h3>'; } else {?>
            <h3> Last Info Updated: <a href="userProfile.php?userID=<?php echo $infoUpdated['userID']; ?>"><?php echo $infoUpdated['userName']; ?> <a class="floatright" >
              <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $infoUpdated['ci_updateTime'] ). " ago"; ?>
              </a></h3>
            <?php } ?>
          </div>-->
          <div class="text_area_home hideHome">
            <?php if($infoUpdated['userID']='') { echo '<h3>Info not updated yet</<h3>'; } else {?>
            <h3>Files <a class="viewFile" href="#" title="<?php if($count_upload !='') {?>Last Upload: <?php echo $infoUpdated['uploadDoc']; ?><?php }else echo'No File Uploaded Yet'; ?>">(<?php echo $count_upload; ?> View)</a> | <a href="#" class="clickAddStud">Add Student</a> </h3>
            <?php } ?>
          </div>
          <div class="text_area_home searchStud">
            <form method="POST" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="searchStud" />
              <h3 style="display: flex;">
                <input type="text" class="form-control hideSearchStud" name="searchStud" placeholder="Search Student to Add" />
                <input type="submit" value="Search" class="searchStudbtn floatright btn btn-primary btn-xs btn-rect"  />
              </h3>
            </form>
          </div>
          <script>
			$(".searchStudbtn").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("searchResult").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script>
          <div id="searchResult"> </div>
          
          <div class="single_left_coloum_wrapper fileDiv">
            <h2 class="title">Files Uploaded</h2>
            <a class="more viewFile" href="#">Hide</a>
            <div class="left-margin">
              <?php 
     	  		$upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user 
				ON upload.userID=user.userID WHERE upload.userID='".$user['userID']."' ORDER BY uploadID DESC");
				$count_download=mysqli_num_rows($upload_query);
				if($count_download ==0){ echo 'Not Available';}
				while($uploaded=mysqli_fetch_assoc($upload_query)){
				?>
              <div class="text_area_home">
                <p class="floatright">
                  <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $uploaded['uploadTime'] ). " ago"; ?>
                </p>
                <br/>
                <p><?php echo $uploaded['detail']; ?></p>
                <h3><?php echo $uploaded['uploadDoc']; ?> &nbsp;
                  <ul class="dropdown">
                    <a href="#" title="File Download Count" class=" floatright dropbtn">(<?php echo $uploaded['downloadCount']; ?>)</a>
                    <li class="dropdown-content">
                      <?php $download_query=mysqli_query($dbconfig,"SELECT * FROM download LEFT JOIN user 
							ON download.userID=user.userID WHERE uploadID=$uploaded[uploadID] ORDER BY downloadID DESC");
							$count_download=mysqli_num_rows($download_query);
							while($downloadby=mysqli_fetch_assoc($download_query)){
						?>
                      <a href="#"><?php echo $downloadby['userName']; ?></a>
                      <?php  } ?>
                    </li>
                  </ul>
                </h3>
              </div>
              <?php } ?>
            </div>
          </div>
          <script>
	 		$(document).ready(function(){
  			$("div.searchStud").hide();
			$("a.clickAddStud").click(function(){
			$("div.searchStud").toggle(500);
			return false;	
			});});
			
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
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="xAction" value="coachingInfo" />
                <input type="hidden" name="ci_ID" value="<?php echo $rowCollege['ci_ID']; ?>" />
                <div id="feeSave"></div>
                <div id="coachingSubmit"></div>
                <?php 	
				if(isset($_GET['updateFailed']) && $_GET['updateFailed'] == 1) { ?>
                <div id="fade" style="background-color:#F00;">
                  <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Institute Info Failed to Update </h3>
                </div>
                <?php } ?>
                
                <div class="text_area_home hideHome">
                  <h3> Address: <small class="font"><?php echo $rowCollege['ci_Address']; ?> </small> <a class="floatright showAddressField" href="#" rel="<?php echo $rowCollege['userID']; ?>" >Edit</a>
                    <textarea class="form-control hideTextareaAddress<?php echo $rowCollege['userID']; ?> hideAddress" name="ci_Address" placeholder="Enter Address of Institute" /><?php echo $rowCollege['ci_Address']; ?></textarea>
                  </h3>
                </div>
                <div class="text_area_home hideHome">
                  <h3> Contact Info: <small class="font"><?php echo $rowCollege['ci_Contact']; ?></small> <a class="floatright showContactField" href="#" rel="<?php echo $rowCollege['userID']; ?>" >Edit</a>
                    <input type="text" class="form-control hideInputContact<?php echo $rowCollege['userID']; ?> hideContact" name="ci_Contact" placeholder="Institute Contact Info" value="<?php echo $rowCollege['ci_Contact']; ?>" />
                  </h3>
                </div>
                <div class="text_area_home hideHome">
                  <h3> Website: <small class="font"><?php echo $rowCollege['ci_Website']; ?></small> <a class="floatright showWebsiteField" href="#" rel="<?php echo $rowCollege['userID']; ?>" >Edit</a>
                    <input type="text" class="form-control hideInputWebsite<?php echo $rowCollege['userID']; ?> hideWebsite" name="ci_Website" placeholder="Institute Website" value="<?php echo $rowCollege['ci_Website']; ?>" />
                  </h3>
                </div>
                <div class="text_area_home hideHome">
                  <h3> Coaching Hours: <small class="font"><?php echo $rowCollege['startHour']; ?>-<?php echo $rowCollege['closeHour']; ?></small> <a class="floatright showCoachingHourField" href="#" rel="<?php echo $user['userID']; ?>" >Edit</a> </h3>
                  <select name="startHour" class="form-control hideInputCoachingHour<?php echo $rowCollege['userID']; ?> hideCoachingHour" style="width:32%; display:inline-table">
                    <option value="">Starting Hour</option>
                    <option
         	  	  <?php for($i=1;$i<=12;$i++)
		  		  	{ echo "<option value=".$i."am" ?>
            	  <?php if($rowCollege['startHour'] == $i)
		    		{ echo 'selected';} ?>> <?php echo  $i ?> am
                    <?php } ?>
                    <?php for($i=1;$i<=12;$i++)
		  			{ echo "<option value=".$i."pm" ?>
                  <?php if($rowCollege['startHour'] == $i)
		    		{ echo 'selected';} ?> > 
					<?php echo  $i ?> pm
                    <?php } ?>
                    </option>
                  </select>
                  <select name="closeHour" class="form-control hideInputCoachingHour<?php echo $rowCollege['userID']; ?> hideCoachingHour" style="width:32%; display:inline-table">
                    <option value="">Closing Hour</option>
                    <option
         		<?php for($i=1;$i<=12;$i++)
		  			{ echo "<option value=".$i."am" ?>
		  		<?php if($rowCollege['startHour'] == $i)
		    		{ echo 'selected';} ?>> <?php echo  $i ?> am
                    <?php } ?>
                    <?php for($i=1;$i<=12;$i++)
		  			{ echo "<option value=".$i."pm" ?>
                <?php if($rowCollege['closeHour'] == $i)
		    		{ echo 'selected';} ?>
                    > <?php echo  $i ?> pm
                    <?php } ?>
                    </option>
                  </select>
                </div>
                <div class="text_area_home hideHome">
                  <h3> Fee Structure: <small class="font">Add your coaching fee structure one by one here</small>
                    <div class="floatright"><a href="#" class="clickFee">View </a> | <a class="showCourseNameField" href="#" rel="<?php echo $rowCollege['userID']; ?>">Add</a></div>
                  </h3>
                  <h3>
                  	<input type="hidden" name="ci_ID" value="<?php echo $rowCollege['ci_ID']; ?>" />
                    <input type="text" class="form-control hideInputCourseName<?php echo $rowCollege['userID']; ?> hideCourseName" name="courseName" placeholder="Course Name" value="<?php echo $rowCollege['courseName']; ?>" style="width:49%; display:inline-table" />
                    <input type="text" class="form-control hideInputCourseFee<?php echo $rowCollege['userID']; ?> hideCourseFee" name="courseFee" placeholder="Course Fee" value="<?php echo $rowCollege['courseFee']; ?>" style="width:49%;display:inline-table"/>
                  </h3>
                </div>
                <input type="submit" value="Save" class="coachingSubmit floatright btn btn-primary btn-xs btn-rect hideHome"  />
              </form>
              <br/>
              <br/>
              <br/>
              <div class="text_area_home hideHome hideFee">
                <?php $fee_query=mysqli_query($dbconfig,"SELECT * FROM coaching_fee WHERE userID='".$_SESSION['userid']."'");
					  $count_fee_data=mysqli_num_rows($fee_query);
					  if($count_fee_data == 0) { echo 'Data Not Available';}else {
					  while($fee_row=mysqli_fetch_assoc($fee_query)){
		  		?>
                <div class="hideFee"> <?php echo $fee_row['courseName']; ?>: <small class="font"> &#8377 <?php echo $fee_row['courseFee']; ?></small>
                  <div class="floatright"><small class="feeTime">
                    <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $fee_row['cf_time'] ). " ago"; ?>
                    </small> | <a class="editFee showCourseFee" href="#" rel="<?php echo $fee_row['cf_ID']; ?>">Edit</a> | <a class="editFee confirmDelete" href="delete.php?xAction=deleteFee&deleteItem=<?php echo $fee_row['cf_ID']; ?>">Delete</a></div>
                </div>
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="xAction" value="updateFee" />
                  <input type="hidden" name="cf_ID" value="<?php echo $fee_row['cf_ID']; ?>" />
                  
                  <input type="text" class="form-control hideInputCourseName1<?php echo $fee_row['cf_ID']; ?> hideCourseName1" name="courseName" value="<?php echo $fee_row['courseName']; ?>" style="width:35%; display:inline-table" />
                  <input type="text" class="form-control hideInputCourseFee1<?php echo $fee_row['cf_ID']; ?> hideCourseFee1" name="courseFee" value="<?php echo $fee_row['courseFee']; ?>" style="width:35%;display:inline-table"/>
                  <input type="submit" value="Save" class="feeSubmit hideInputCourseFee1<?php echo $fee_row['cf_ID']; ?> hideCourseFee1  floatright btn btn-primary btn-xs btn-rect"  />
                </form>
                <?php  }} ?>
              </div>
            </div>
          </div>
          <script>
			$(".feeSubmit").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("feeSave").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script> 
          <script>
			$(".coachingSubmit").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("coachingSubmit").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script> 
          <script>
$(document).ready(function(){
			$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			$(".hideFee").toggle();
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
			$("select.hideCoachingHour").hide();
			$("a.showCoachingHourField").click(function(){
			var userID= $(this).attr('rel');
			$("select.hideInputCoachingHour"+userID).toggle(500);
			return false;	
			});
			$("input.hideCourseName,input.hideCourseFee").hide();
			$("a.showCourseNameField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputCourseName"+userID).toggle(500);
			$("input.hideInputCourseFee"+userID).toggle(500);
			return false;	
			});
			
			$("input.hideCourseName1,input.hideCourseFee1").hide();
			$("a.showCourseFee").click(function(){
			var cf_ID= $(this).attr('rel');
			$("input.hideInputCourseName1"+cf_ID).toggle(500);
			$("input.hideInputCourseFee1"+cf_ID).toggle(500);
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
</body>
</html>
