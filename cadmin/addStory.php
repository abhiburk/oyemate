<?php 
require '../config.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add New Story | Admin :: clapdust</title>
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
        <li class="breadcrumb-item"><a href="home.php">Home</a>
      </ol>
      <!--grid-->
      <div class="validation-system">
        <div class="validation-form"> 
          <!---->
          <h4 align="center">1. Personal Details About the Person</h4>
          <form action="insertStory.php" method="post" enctype="multipart/form-data">
            <div class="vali-form">
              <div class="col-md-6 form-group1">
                <label class="control-label">User Name</label>
                <input type="text" name="cName" placeholder="Enter the Person Name" required>
              </div>
              <div class="col-md-6 form-group1 form-last">
                <label class="control-label">Email-ID</label>
                <input type="text" name="cEmail" placeholder="Email Not Mandatory">
              </div>
              <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1 ">
              <label class="control-label">User Info</label>
              <textarea name="cInfo"  placeholder="User Info..." required></textarea>
            </div>
            <div class="clearfix"> </div>
            </br>
            <div class="vali-form vali-form1">
              <div class="col-md-6 form-group1">
                <label for="exampleInputFile">User Profile Photo</label>
                <input type="file" name="cPhoto" id="exampleInputFile">
              </div>
              <div class="col-md-6 form-group2 ">
              <label class="control-label">Gender/Type</label>
              <select name="gender" required>
              <option value=''>Select Type</option>
                 <option >Male</option>
                <option >Female</option>
                  <option >Group</option>
              </select>
            </div>
            
              <div class="clearfix"> </div>
            </div>
            <hr>
            <!--User Details End Here-->
            <h4 align="center">2. Working Activity Details</h4>
            <div class="col-md-12 form-group1 ">
              <label class="control-label">Working Info</label>
              <textarea name="workInfo"  placeholder="User Info..." required></textarea>
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
                <option ><?php echo $addStory['catagory']; ?></option>
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
                  >
                  <?php if($i<=9) echo $k; echo $i ?>
                  <?php } ?>
                  </option>
                </select>
              </div>
              <div class="col-md-4 form-group2 group-mail">
                <label class="control-label">Month</label>
                <select name="month" class='form-control1'>
                <option value=''>Select Month</option>
                
                <option value="01"> January</option>
                <option value="02"> February</option>
                <option value="03"> March</option>
                <option value="04"> April</option>
                <option value="05"> May</option>
                <option value="06"> June</option>
                <option value="07"> July</option>
                <option value="08"> August</option>
                <option value="09"> September</option>
                <option value="10"> October</option>
                <option value="11"> November</option>
                <option value="12"> December</option>
                </select>
              </div>
              <div class="col-md-4 form-group2 form-last">
                <label class="control-label">Year</label>
                <select name="year" class='form-control1' >
                <option value=''>Select Year</option>
                
                <option
         	<?php for($i=1980;$i<=2017;$i++)
		  { echo "<option value=".$i." " ?> > 
		  <?php echo  $i ?>
                <?php } ?>
                </option>
                </select>
              </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1">
              <label class="control-label">Details Recommended By</label>
              <input type="text" value="clapdust team"  name="recommend"  placeholder="Name of the Person who Recommended this Details" >
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
                <input type="file" name="workPhoto" id="exampleInputFile">
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