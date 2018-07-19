<?php 
require '../config.php';
$cID=$_REQUEST['cID'];

$sql=mysqli_query($dbconfig,"SELECT * FROM celebrity WHERE cID='".$cID."'");
($editStory=mysqli_fetch_assoc($sql)) ;

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Edit Story | Admin :: clapdust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head>
<body>
<div class="page-container"> 
  <!--/content-inner-->
  <div class="left-content">
    <div class="mother-grid-inner"> 
      <!--header start here-->
      <?php include 'header.php'; ?>
      <!--heder end here-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="celebrityList.php">Celebrites</a>
      </ol>
      <script>
			$(document).ready(function(){
				//showing the forgot form
			$("a.clickShow").hide();
			$("a.clickHide").click(function(){
			$("div.cPhoto").hide(1000);
			$("a.clickHide").hide();
			$("a.clickShow").show();
			 /// 1000 means 1sec
			return false;	
			});
			$("a.clickShow").click(function(){
			$("a.clickShow").hide();
			$("a.clickHide").show();
			$("div.cPhoto").show(1000);
			return false;	
			});
		});
        </script>
<div align="right" > <a href="#" class="clickHide btn btn-success btn-sm btn-rect"><i style="color:#FFF" class="glyphicon glyphicon-eye-close"></i> Hide </a> <a href="#" class="clickShow btn btn-success btn-sm btn-rect"><i style="color:#FFF" class="glyphicon glyphicon-eye-open"></i> Show </a> </div>
 <div class="cPhoto">
 <form action="insertStory.php" method="post" enctype="multipart/form-data">
 <input type="hidden" name="cID" value="<?php echo $editStory['cID']; ?>">
 <input type="hidden" name="xAction" value="cpPhoto">
            <!--Working Details End Here-->
            <div class="vali-form vali-form1">
              <div class="col-md-6 form-group1">
                <label for="exampleInputFile">Extra Celebrity Photos</label>
                <input type="file" name="cpPhoto" id="exampleInputFile">
              </div>
             </br>
             <div class="col-md-4 form-group" style="float:right">
              <input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <div class="clearfix"> </div>
          </form></div></div>
      <!--grid-->
      <div class="validation-system">
        <div class="validation-form"> 
          <!---->
          <h4 align="center">1. Personal Details About the Person</h4>
          <form action="updateStory.php" method="post" enctype="multipart/form-data">
          <input type="hidden" value="<?php echo $editStory['cID']; ?>" name="cID">
            <div class="vali-form">
              <div class="col-md-6 form-group1">
                <label class="control-label">User Name</label>
                <input type="text" name="cName" value="<?php echo $editStory['cName']; ?>" required>
              </div>
              <div class="col-md-6 form-group1 form-last">
                <label class="control-label">Email-ID</label>
                <input type="text" name="cEmail" placeholder="Email Not Mandatory" value="<?php echo $editStory['cEmail']; ?>" >
              </div>
              <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1 ">
              <label class="control-label">User Info</label>
              <textarea name="cInfo"  placeholder="User Info..." required><?php echo $editStory['cInfo']; ?></textarea>
            </div>
            <div class="clearfix"> </div>
            </br>
            <div class="vali-form vali-form1">
              <div class="col-md-6 form-group1">
                <label for="exampleInputFile">User Profile Photo</label>
				<span class="prfil-img"> <img src="<?php echo '../uploads/'.$editStory['cPhoto'];  ?>" class=" img-responsive"> </span> 
                <input type="file" value="3" name="cPhoto" id="exampleInputFile">
              </div>
              <div class="clearfix"> </div>
            </div>
            <hr>
            <!--User Details End Here-->
            <h4 align="center">2. Working Activity Details</h4>
            <div class="col-md-12 form-group1 ">
              <label class="control-label">User Info</label>
              <textarea name="workInfo"  placeholder="User Info..." required><?php echo $editStory['workInfo']; ?></textarea>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group2 group-mail">
              <label class="control-label">Activity Type</label>
              <select name="tag" required>
              <option value=''>Select Catagory</option>
                <?php
			$sql=mysqli_query($dbconfig,"SELECT * FROM tag");
			while($addStory=mysqli_fetch_assoc($sql)) {
			 ?>
                <option value="<?php echo $addStory['catagory']; ?>"<?php if ($addStory['catagory'] == $editStory['tag']){ echo 'selected';};?> >
				<?php echo $addStory['catagory']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="clearfix"> </div>
            <div class="vali-form vali-form1">
              <div class="col-md-4 form-group2 group-mail">
                <label class="control-label">Day</label>
                <select class="col-md-3" name="day" />
                <option value=''>Select Day</option>
                 <?php $k=0; 
			for($i=1;$i<=31;$i++)
		  { echo "<option value=".$i." " ?>
           <?php if($editStory['day'] == $i)
		    { echo 'selected';} ?>>
                <?php if($i<=9) echo $k; echo $i ?>
                <?php } ?>
                  </option>
                </select>
              </div>
              <div class="col-md-4 form-group2 group-mail">
                <label class="control-label">Month</label>
                <select name="month" class='form-control1'>
                <option value=''>Select Month</option>
                
                <option value="01"<?php if($editStory['month'] == '01'){ echo 'selected';};?>>January</option>
                <option value="02"<?php if($editStory['month'] == '02'){ echo 'selected';};?>>February</option>
                <option value="03"<?php if($editStory['month'] == '03'){ echo 'selected';};?>>March</option>
                <option value="04"<?php if($editStory['month'] == '04'){ echo 'selected';};?>>April</option>
                <option value="05"<?php if($editStory['month'] == '05'){ echo 'selected';};?>>May</option>
                <option value="06"<?php if($editStory['month'] == '06'){ echo 'selected';};?>>June</option>
                <option value="07"<?php if($editStory['month'] == '07'){ echo 'selected';};?>>July</option>
                <option value="08"<?php if($editStory['month'] == '08'){ echo 'selected';};?>>August</option>
                <option value="09"<?php if($editStory['month'] == '09'){ echo 'selected';};?>>September</option>
                <option value="10"<?php if($editStory['month'] == '10'){ echo 'selected';};?>>October</option>
                <option value="11"<?php if($editStory['month'] == '11'){ echo 'selected';};?>>November</option>
                <option value="12"<?php if($editStory['month'] == '12'){ echo 'selected';};?>>December</option>
                </select>
              </div>
              <div class="col-md-4 form-group2 form-last">
                <label class="control-label">Year</label>
                <select name="year" class='form-control1' >
                <option value=''>Select Year</option>
                
                <option
         	<?php for($i=1980;$i<=2017;$i++)
		  { echo "<option value=".$i." " ?>
           <?php if($editStory['year'] == $i)
		    { echo 'selected';} ?>> <?php echo  $i ?>
                <?php } ?>
                </option>
                </select>
              </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1">
              <label class="control-label">Details Recommended By</label>
              <input type="text" name="recommend" value="<?php echo $editStory['recommend']; ?>"  placeholder="Name of the Person who Recommended this Details" >
            </div>
            <div class="clearfix"> </div>
            <br/>
            <hr>
            <!--Working Details End Here-->
            <h4 align="center">3. Working Activity Photos</h4>
            <br/>
            <div class="vali-form vali-form1">
              <div class="col-md-6 form-group1">
                <label for="exampleInputFile">Activity Photos 1</label>
				<span class="prfil-img"> <img src="<?php echo '../uploads/'.$editStory['workPhoto'];  ?>" class=" img-responsive"> </span> 
                <input type="file" src="<?php echo '../uploads/'.$editStory['workPhoto'];  ?>" name="workPhoto" id="exampleInputFile">
              </div>
              <!-- <div class="col-md-6 form-group1 form-last">
             <label for="exampleInputFile">Activity Photos 2</label>
        <input type="file" name="workPhoto" id="exampleInputFile">
            </div>-->
              <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 form-group" style="float:right">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
            <div class="clearfix"> </div>
          </form>
          
          <!----> 
        </div>
      </div>
      <!--//grid--> 
      
      <!-- script-for sticky-nav --> 
      <script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script> 
      <!-- /script-for sticky-nav --> 
      <!--inner block start here-->
      <div class="inner-block"> </div>
      <!--inner block end here--> 
      <!--copy rights start here-->
      <?php 
				include 'copyright.php';
				?>
      <!--COPY rights end here--> 
    </div>
  </div>
  <!--//content-inner--> 
  <!--/sidebar-menu-->
  <?php 
				include 'sidebar-left.php';
				?>
<!--js --> 
<script src="js/jquery.nicescroll.js"></script> 
<script src="js/scripts.js"></script> 
<!-- Bootstrap Core JavaScript --> 
<script src="js/bootstrap.min.js"></script> 
<!-- /Bootstrap Core JavaScript -->

</body>
</html>