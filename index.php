<?php 
require 'config.php';
$searchVal=$_REQUEST['searchVal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register & Login : Oyemate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="web/assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="web/assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="web/assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="web/assets/css/jquery.bxslider.css" media="screen" />
<script type="text/javascript" src="web/assets/js/jquery-min.js"></script>
<script type="text/javascript" src="web/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="web/assets/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="web/assets/js/selectnav.min.js"></script>
</head>
<body>
<div class="body_wrapper">
<?php include 'homeheader.php'; ?>
<div class="center">
  <div class="content_area">
    <?php include 'loginRegister.php'; ?>
    
    <!--What is Oyemate-->
    <div class="col_home_50 floatleft">
      <div class="text_area_home" id="grey_head">
        <p class="grey_head">oyemate.com</p>
      </div>
      <div class="text_area_home">
        <div class="single_cat_left_content floatleft">
          <h3>what is oyemate ?</h3>
          <p>oyemate is an online portal for college students containing large useful features,where one can <b>share</b> or <b>get</b> everything needed to a college </p>
          <!-- <p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>--> 
        </div>
        <div class="single_cat_left_content floatleft">
          <h3>what oyemate contains ? </h3>
          <p>1. oyemate contains simple but useful like features.This contains attendance system for college staff,docs,zips,images etc. can be uploaded on your 
            college department.</p>
          <p>2. this also contain dynamic colleges,coaching institutes <b>auto generated</b> profiles and thus can be rated by everyone in this community.</p>
          <p>3. dynamic <b>attendance system</b> for teaching staff.</p>
          <!--<p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>--> 
        </div>
        <div class="single_cat_left_content floatleft">
          <h3>how attendance system work ? </h3>
          <p>1. this work much simple then the paperwork, teaching staff can <b>create</b> their own sheets/class overhere and thus can add students into this.
            once students are added then then can create multiple subjects and this can start recording the attendance with one click.</p>
          <p>2. attendance can be recorded from<b> anywhere</b>.</p>
          <p>3. benefits of this system is that their is <b>no need</b> to calculate everything of the respective student,just need to mark attendance of the student and that's it, your
            are done for that..</p>
          <p>4. student attendaance %,attended of total lectures will be <b>auto calculated</b>.</p>
          <p>5. if you wanna send monthly attendance sheet to ? <b>yes</b> you can.</p>
          <h3>request for your college ? </h3>
          <p>1. yes,you can request your college.the only thing you need to do is just select <b>other</b> while registration and then just request after login.</p>
          <!--<p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>--> 
        </div>
      </div>
    </div>
    
    <?php    $sql_college = mysqli_query($dbconfig,"SELECT * FROM colleges");
			 $count_colleges=mysqli_num_rows($sql_college);
			 ?>
    <div class="col_home_25 floatright">
      <div class="text_area_home" id="grey_head">
        <p class="grey_head">Colleges Added (<?php echo $count_colleges; ?>)</p>
      </div>
      
      <div class="text_area_home">
          <form method="get" enctype="multipart/form-data">
            <div class="flex">
              <input type="hidden" name="xAction" value="searchCollege" />	
              <input type="text" class="form-control" name="searchCollege" placeholder="Search for college" />
              <input type="submit" value="Search" class="searchCollege btn btn-file btn btn-xs btn-primary" />
            </div>
          </form>
      </div>
      	<script>
    $(document).ready(function(){
      	$(".loadingDiv").hide();
		  $(".searchCollege").click(function(e) {
            e.preventDefault();
			$(".loadingDiv").show();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "web/insertData.php",
                data: formData,
 				success: function (response) {
                $(".loadingDiv").hide();
				$("div.hideSearch").hide(); 
  				document.getElementById("searchResult").innerHTML=response; 
				 
 		}
 		}); });});
		
		</script>
     <div id="searchResult"> </div> 
      <div class="loadingDiv">Loading...</div>
      
      <div class="scroll_hostel hideSearch">
        <?php 
			 $sql = mysqli_query($dbconfig,"SELECT * FROM colleges ORDER BY collegeID DESC");
    		 while($row_college = mysqli_fetch_assoc($sql)){
		 ?>
        <div class="text_area_home">
          <div class="single_cat_left_content floatleft">
            <p><b><?php echo $row_college['instituteName']; ?></b></p>
            <p class="single_cat_left_content_meta"><b>Address: </b><?php echo $row_college['collegeAddress']; ?> | 
			Added <?php echo "" . humanTiming( $row_college['collegeUpdateTime'] ). " ago"; ?> | </p>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    
  </div>
</div>
</body>
</html>