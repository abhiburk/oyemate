<?php 
require 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register & Login : SkyMate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="web/assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="web/assets/font/font.css" />
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
<div class="header_area">
  <div class="logo floatleft"><a href="#"><img src="images/oyemate2.jpg" alt="" /></a> </div>
</div>
<div class="center">
  <div class="content_area">
    <div class="main_content floatright "> 
      <script>
			$(document).ready(function(){
			$("div.showReg").hide(); 
			$("a.openReg").click(function(){
			$("div.showReg").show(500); 
			$("div.hideLog").hide(500);/// 1000 means 1sec
			return false;	
			});
			$("a.openLog").click(function(){
			$("div.hideLog").show(500);/// 1000 means 1sec	
			$("div.showReg").hide(500); 
			return false;	
			});
			
			$("div.showThis").hide();
			$("a.openFor").click(function(){
			$("div.showThis").toggle(500);/// 1000 means 1sec	
			return false;	
			});
		});
        </script> 
      <script>
 $(document).ready(function(){
	 $("#fade").hide(0);
	setInterval(function(){
        $("#fade").fadeIn(1000);
    }, 0);
		return false;	
	});
 </script> 
    </div>
    <div class="sidebar floatright ">
      <div class="single_sidebar">
        <?php 	
		if(isset($_GET['loginFailed']) && $_GET['loginFailed'] == 1) { ?>
        <div id="fade" style="background-color:#F00;">
          <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Incorrect Email/Password </h3>
        </div>
        <?php } ?>
        <?php 	
		if(isset($_GET['alrdyReg']) && $_GET['alrdyReg'] == 1) { ?>
        <div id="fade" style="background-color:#F00;">
          <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">You are already Register </h3>
        </div>
        <?php } ?>
        <?php 	
		if(isset($_GET['nameShort']) && $_GET['nameShort'] == 1) { ?>
        <div id="fade" style="background-color:#F00;">
          <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">User Name is too Short Enter 8 or more then 8 character</h3>
        </div>
        <?php } ?>
        <?php 	
		if(isset($_GET['passShort']) && $_GET['passShort'] == 1) { ?>
        <div id="fade" style="background-color:#F00;">
          <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Password is too Short Enter 8 or more then 8 character </h3>
        </div>
        <?php } ?>
        <?php 	
		if(isset($_GET['passnotMatch']) && $_GET['passnotMatch'] == 1) { ?>
        <div id="fade" style="background-color:#F00;">
          <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Entered Password do not Match </h3>
        </div>
        <?php } ?>
        <?php 	
		if(isset($_GET['createSuccess']) && $_GET['createSuccess'] == 1) { ?>
        <div id="fade" style="background-color:#0C3;">
          <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Account Successfully Created Login Here </h3>
        </div>
        <?php } ?>
        <div class="news-letter hideLog ">
          <h2>LogIn to your account</h2>
          <p></p>
          <form action="web/checkLogin.php" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Email Address" name="userEmail" class="form-control" required/>
            <br/>
            <input type="password" placeholder="Password" name="userPass" class="form-control" required />
            <br/>
            <input type="submit" value="LOGIN" class=" col-xs-12 btn btn-file btn btn-xs btn-primary" />
          </form>
          <br />
          <div class="showThis">
            <form action="web/sendForgot.php" method="post">
              <input type="text" name="userEmail" placeholder="Email Address" class="form-control" required/>
              <br/>
              <input type="submit" value="SUBMIT" class=" col-xs-12 btn btn-file btn btn-xs btn-primary" />
            </form>
          </div>
          <p class="news-letter-privacy"><a href="#" class="openReg"> Create Account </a> | <a href="#" class="openFor"> Forgot Password ? </a></p>
        </div>
        <script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'web/insertData.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}
</script> 
        <script>
		$(document).ready(function(){
		$("div.coaching").hide();
	 	$('#coaching').on('change',function(){
		if( $(this).val()=== "Coaching Staff"){
        $("div.coaching").show()
		 $("div.college").hide()
		 $("div.college").addClass("college")
        }
        
});
});
</script>
        <div class="news-letter showReg">
          <h2>Sign Up to your account</h2>
          <p>please select <b>other</b> option if your institute is not available</p>
          <form action="web/checkRegister.php" method="post" enctype="multipart/form-data">
            <select  id="coaching" class="form-control" name="company">
              <option value="">Select Type</option>
              <option>Student</option>
              <option>College Staff</option>
              <option value="Coaching Staff">Coaching Staff</option>
            </select>
            <br/>
            <div class="coaching">
              <select class="form-control" name="branchName-c">
                <option>Select Coaching Type</option>
                <option>Mathematics</option>
                <?php
  			$select=mysql_query("select * from branch Group by branchName");
  			while($row=mysql_fetch_array($select)) {
   			echo "<option>".$row['branchName']."</option>"; }
		 ?>
              </select>
              <br/>
              <input type="text" name="instituteName-c" class='form-control' value="" placeholder="Institute Name"/>
            </div>
            <div class="college">
              <select onchange="fetch_select(this.value);" class="form-control" name="courseName">
                <option value="">Select Course</option>
                <option>Other</option>
                <?php
  			$select=mysql_query("SELECT * FROM courses");
  			while($row=mysql_fetch_array($select)) {
   			echo "<option>".$row['courseName']."</option>"; }
		 ?>
              </select>
              <br />
              <select id="new_select" class="form-control" name="branchName" >
                <option value="">Select Branch</option>
                <option>Other</option>
              </select>
              <br/>
              <select class="form-control" name="instituteName">
                <option value="">Select College</option>
                <option>Other</option>
                <?php 
 				$select=mysqli_query($dbconfig,"SELECT * FROM colleges ORDER BY instituteName ASC");
  				while($row=mysqli_fetch_array($select)){
 			  ?>
                <option><?php echo $row['instituteName']; ?></option>
                <?php } ?>
              </select>
              <br/>
              <select class="form-control" name="eduYear">
                <option value="">Select Year</option>
                <?php 
 				$select=mysqli_query($dbconfig,"SELECT * FROM year");
  				while($row=mysqli_fetch_array($select)){
 			  ?>
                <option><?php echo $row['year']; ?></option>
                <?php } ?>
              </select>
            </div>
            <br/>
            <input type="text" name="userName" class='form-control' value="" placeholder="Your Name" required/>
            <br/>
            <input type="text" name="userEmail" class='form-control' value="" placeholder="Email-ID" required/>
            <br/>
            <input type="password" name="userPass" class='form-control' value="" placeholder="Password" required/>
            <br/>
            <input type="password" name="userPassConfirm" class='form-control' value="" placeholder="Retype Password" required/>
            <br/>
            <input type="submit" value="SUBMIT" class="btn-success_green" />
          </form>
          <p class="news-letter-privacy">Already Registered ?<a href="#" class="openLog"> LogIn </a></p>
        </div>
      </div>
      
      <!--<div class="single_sidebar"> <img src="images/add1.png" alt="" /> </div>--> 
    </div>
    <div class="left_coloum floatleft features ">
      <div class="text_area_home">
        <div class="single_left_coloum_wrapper single_cat_left">
          <h2 class="title">what ? </h2>
          <a class="more" href="#">readme</a>
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
              are done for the that..</p>
            <p>4. student attendaance %,attended of total lectures will be <b>auto calculated</b>.</p>
            <p>5. if you wanna send monthly attendance sheet to ? <b>yes</b> you can.</p>
            <h3>request for your college ? </h3>
            <p>1. yes,you can request your college.the only thing you need to do is just select <b>other</b> while registration and then just request after login.</p>
            <!--<p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>--> 
          </div>
        </div>
      </div>
    </div>
    <?php include 'web/footer.php'; ?>
  </div>
</div>
</body>
</html>