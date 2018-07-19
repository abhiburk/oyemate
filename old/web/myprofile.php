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
<title>Edit User : Oyemate</title>
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
          <?php $myCollege_query=mysqli_query($dbconfig,"SELECT * FROM colleges LEFT JOIN user ON 
				colleges.instituteName=user.instituteName WHERE user.userID='".$_SESSION['userid']."'");
				$rowCollege=mysqli_fetch_assoc($myCollege_query);
		  
     	  		$upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON 
				upload.userID=user.userID WHERE upload.userID='".$user['userID']."'  ORDER BY uploadID DESC");
				$count_upload=mysqli_num_rows($upload_query);
				$uploaded=mysqli_fetch_assoc($upload_query);
		  ?>
          <div class="text_area_home">
            <div class="content-right">
              <?php if($rowCollege['collegePhoto']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)">'; } else{ ?>
             <a href="<?php echo '../uploads/'.$rowCollege['collegePhoto']; ?>"> 
             <div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$rowCollege['collegePhoto']; ?>)"></div>
             </a><?php } ?>
              <div class="bnr-img">
                <?php if($user['userImg'] == '') { echo '<img src="../images/default.jpg" class="userImg"/>'; } else {?>
               <a href="<?php echo '../uploads/'.$user['userImg']; ?>"> <img src="<?php echo '../uploads/'.$user['userImg']; ?>" class="userImg"/></a>
                <?php } ?>
              </div>
              <div class="proBtn">
                <p><a href="#" class="photo">Edit Photo</a></p>
              </div>
              <div class="bnr-text">
                <a><h1><?php echo $user['userName']; ?></h1></a>
                <?php if($user['company']== 'Coaching Staff') { ?>
                <h5><a href="coaching/<?php echo $user['instituteName']; ?>"><?php echo $user['instituteName']; ?></a></h5>
                <?php }else { ?>
                <h5><a href="collegeprofile/<?php echo $user['instituteName']; ?>"><?php echo $user['instituteName']; ?></a></h5>
				<?php } ?>
                <div style="display:flex">
                  <p><b>Company: </b><?php echo $user['company']; ?></p>
                  <p><b>Join: </b><?php echo "" . humanTiming( $user['signupDate'] ). " ago"; ?></p>
                </div>
              </div>
              <div class="btm-num">
                <ul>
                  <li>
                    <h4></h4>
                    <h5></h5>
                  </li>
                  <li>
                    <h4> <?php echo $count_upload; ?> </h4>
                    <h5><a class="viewFile" href="#" title="<?php if($count_upload!='') {?>Last Upload: <?php echo $user['uploadDoc']; ?><?php }else echo'No File Uploaded Yet'; ?>"> Files</a></h5>
                  </li>
                  <li>
                    <h4></h4>
                    <h5></h5>
                  </li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <form  method="post" enctype="multipart/form-data" action="update_profile_photo.php">
              <input type="hidden" name="xAction" value="userImg"/>
              <div class="floatleft text_area_button"  id="hide_img_btn">
                <div class="fileupload fileupload-new" data-provides="fileupload"> <i class="icon-file fileupload-exists"></i> 
                <span class="fileupload-preview"> </span> <span class="btn btn-file btn btn-xs btn-primary" > <span class="fileupload-new">Select Photo</span> <span class="fileupload-exists" >Change</span>
                  <input type="file" name="userImg" required/>
                  </span>
                  <input class="btn btn-file btn btn-xs btn-primary fileupload-exists"  type="submit" value="Save">
                </div>
              </div>
            </form>
          </div>
          <div class="single_left_coloum_wrapper fileDiv">
            <h2 class="title">Files Uploaded</h2>
            <a class="more viewFile" href="#">Hide</a>
            <?php $upload_query=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON 
				  upload.userID=user.userID WHERE upload.userID='".$user['userID']."'  ORDER BY uploadID DESC");
				 $count_download=mysqli_num_rows($upload_query);
				 while($uploaded=mysqli_fetch_assoc($upload_query)){
				?>
            <div class="text_area_home">
              <div class="left-margin">
                <p class="floatright"> <?php echo "" . humanTiming( $uploaded['uploadTime'] ). " ago"; ?> </p>
                <br/>
                <p><?php echo $uploaded['detail']; ?></p>
                
                <?php if($uploaded['uploadDoc']!='') { ?>
                <h3 class="floatright"><a class="content" title="<?php echo $uploaded['uploadDoc']; ?>" href="download.php?fileDetail=<?php echo $uploaded['uploadDoc']?> &uploadID=<?php echo $uploaded['uploadID']?>"> Download
                  <?php $str=$uploaded['uploadDoc']; if(strlen($str)>=25){ echo substr($str,0,30).'...';}else{echo $str; }?></a>
                </h3>
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
                </h3><?php  } ?>
                
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
			$("a.photo").click(function(){
			$("div#hide_img_btn").toggle(500);
			return false;	
			});});
     </script>
          <div class="single_left_coloum_wrapper ">
            <h2 class="title">Edit Profile</h2>
            <a class="more toggleOne" href="#">Toggle</a>
            <form method="post" enctype="multipart/form-data" >
              <input type="hidden" name="xAction" value="editProfile" />
              <?php 	
			if(isset($_GET['updateSuccess']) && $_GET['updateSuccess'] == 1) { ?>
              <div id="fade" style="background-color:#0C0;">
                <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Profile Info Updated Successfully </h3>
              </div>
              <?php } ?>
              <div class="left-margin">
              <div class="text_area_home hideHome">
                <h3> Name: <small class="font"><?php echo $user['userName']; ?></small> <a class="floatright shownameField" href="#" rel="<?php echo $user['userID']; ?>" >Edit</a>
                  <input type="text" class="form-control hideInputName<?php echo $user['userID']; ?> hideName" name="userName" value="<?php echo $user['userName']; ?>" />
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Birthday:
                  <?php if($user['day'].''.$user['month'].''.$user['year']=='') {echo 'Not Available';}else {
				 echo '<small class="font">';  echo $user['day']; ?>
                  / <?php echo $user['month']; ?>/ <?php echo $user['year'];echo '<small class="font">'; } ?><a class="floatright showbirthField" href="#" rel="<?php echo $user['userID']; ?>" >Edit</a>
                  <div class="hideInputbirth<?php echo $user['userID']; ?> hideBirth">
                    <select name="day" class='form-control1' style="width:32%;">
                      <option>Date</option>
                      <option
         		  <?php $k=0; 
						  for($i=1;$i<=31;$i++)
		  				  { echo "<option value=".$i." " ?>
           		  <?php if($user['day'] == $i)
		    			  { echo 'selected';} ?>>
                  <?php if($i<=9) echo $k; echo $i ?>
                    <?php } ?>
                      </option>
                    </select>
                    <select name="month" class='form-control1' style="width:32%;">
                      <option>Of</option>
                      <option value="01"<?php if($user['month'] == '01'){ echo 'selected';};?>>January</option>
                      <option value="02"<?php if($user['month'] == '02'){ echo 'selected';};?>>February</option>
                      <option value="03"<?php if($user['month'] == '03'){ echo 'selected';};?>>March</option>
                      <option value="04"<?php if($user['month'] == '04'){ echo 'selected';};?>>April</option>
                      <option value="05"<?php if($user['month'] == '05'){ echo 'selected';};?>>May</option>
                      <option value="06"<?php if($user['month'] == '06'){ echo 'selected';};?>>June</option>
                      <option value="07"<?php if($user['month'] == '07'){ echo 'selected';};?>>July</option>
                      <option value="08"<?php if($user['month'] == '08'){ echo 'selected';};?>>August</option>
                      <option value="09"<?php if($user['month'] == '09'){ echo 'selected';};?>>September</option>
                      <option value="10"<?php if($user['month'] == '10'){ echo 'selected';};?>>October</option>
                      <option value="11"<?php if($user['month'] == '11'){ echo 'selected';};?>>November</option>
                      <option value="12"<?php if($user['month'] == '12'){ echo 'selected';};?>>December</option>
                    </select>
                    <select name="year" class='form-control1' style="width:32%;">
                      <option>Birth</option>
                      <option
         		<?php for($i=1980;$i<=2016;$i++)
		  			{ echo "<option value=".$i." " ?>
           		<?php if($user['year'] == $i)
		    		{ echo 'selected';} ?>> <?php echo  $i ?>
                <?php } ?>
                      </option>
                    </select>
                  </div>
                </h3>
              </div>
              <?php  if($user['company']!='Coaching Staff') { ?>
              <div class="text_area_home hideHome">
                <h3> Year: <small class="font"><?php echo $user['eduYear']; ?></small> <a class="floatright showyearField" href="#" rel="<?php echo $user['userID']; ?>" >Edit</a>
                  <select name="eduYear" class='form-control hideSelectyear<?php echo $user['userID']; ?> hideYear' style="width:100%;">
                   <option value="1st Year"<?php if($user['eduYear'] == '1st Year'){ echo 'selected';};?>>1st Year</option>
                    <option value="2nd Year"<?php if($user['eduYear'] == '2nd Year'){ echo 'selected';};?>>2nd Year</option>
                    <option value="3rd Year"<?php if($user['eduYear'] == '3rd Year'){ echo 'selected';};?>>3rd Year</option>
                    <option value="4th Year"<?php if($user['eduYear'] == '4th Year'){ echo 'selected';};?>>4th Year</option>
                    <option value="5th Year"<?php if($user['eduYear'] == '5th Year'){ echo 'selected';};?>>5th Year</option>
                  </select>
                </h3>
              </div>
              <?php } ?>
              <div class="text_area_home hideHome">
                <h3> Email: <small class="font"><?php echo $user['userEmail']; ?></small><a title="<?php echo $user['emailPrivacy']; ?>" class="floatright showemailField" href="#" rel="<?php echo $user['userID']; ?>">Privacy</a>
                  <select name="emailPrivacy" class='form-control hideSelectEmailPrivacy<?php echo $user['userID']; ?> hideEmailPrivacy' style="width:100%;">
                    <option value="public"<?php if($user['emailPrivacy'] == 'public'){ echo 'selected';};?>>Public</option>
                    <option value="onlyMe"<?php if($user['emailPrivacy'] == 'onlyMe'){ echo 'selected';};?>>Only Me</option>
                  </select>
                </h3>
              </div>
              <div class="text_area_home hideHome">
                <h3> Institite: <small class="font"><?php echo $user['instituteName']; ?></small><a class="floatright" title="You cannot edit this due to privacy concern">Info</a> </h3>
              </div>
              <?php if($user['company']!= 'Coaching Staff') { ?>
              <div class="text_area_home hideHome">
                <h3> Course: <small class="font"><?php echo $user['courseName']; ?></small><a class="floatright" title="You cannot edit this due to privacy concern">Info</a> </h3>
              </div>
              <?php } ?>
              <div class="text_area_home hideHome">
                <h3> Field: <small class="font"><?php echo $user['branchName']; ?></small><a class="floatright" title="You cannot edit this due to privacy concern">Info</a> </h3>
              </div>
              <input type="submit" value="Save" class="profileSubmit floatright btn btn-primary btn-xs btn-rect hideHome"  />
            </form>
          </div>
        </div>
        <script>
			$(".profileSubmit").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php?xAction=editProfile",
                data: formData,
                success: function(result) {
                   window.location = "myprofile.php?updateSuccess=1";
                } });});
		</script> 
        <script>
$(document).ready(function(){
			$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			return false;	
			});
			
			$("input.hideName").hide();
			$("a.shownameField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputName"+userID).toggle(500);
			return false;	
			});
			
			$("div.hideBirth").hide();
			$("a.showbirthField").click(function(){
			var userID= $(this).attr('rel');
			$("div.hideInputbirth"+userID).toggle(500);
			return false;	
			});
			
			$("select.hideYear").hide();
			$("a.showyearField").click(function(){
			var userID= $(this).attr('rel');
			$("select.hideSelectyear"+userID).toggle(500);
			return false;	
			});
			$("select.hideEmailPrivacy").hide();
			$("a.showemailField").click(function(){
			var userID= $(this).attr('rel');
			$("select.hideSelectEmailPrivacy"+userID).toggle(500);
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
