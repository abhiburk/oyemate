
<div class="col_home_30 floatright ">
  <div class="single_sidebar">
    <?php 	
		if(isset($_GET['notLogin']) && $_GET['notLogin'] == 1) { ?>
    <div id="fade" style="background-color:#F00;">
      <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">You're not login </h3>
    </div>
    <?php } ?>
    <?php 	
		if(isset($_GET['createSuccess']) && $_GET['createSuccess'] == 1) { ?>
    <div id="fade" style="background-color:#0C3;">
      <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Account Created Successfully</h3>
    </div>
    <?php } ?>
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
		if(isset($_GET['emailFail']) && $_GET['emailFail'] == 1) { ?>
    <div id="fade" style="background-color:#0C3;">
      <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Please try again after sometime</h3>
    </div>
    <?php } ?>
    <?php 	
		if(isset($_GET['emailSuccess']) && $_GET['emailSuccess'] == 1) { ?>
    <div id="fade" style="background-color:#0C3;">
      <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Password Mailed successfully.Please Check your email</h3>
    </div>
    <?php } ?>
    <?php 	
		if(isset($_GET['emailnotValid']) && $_GET['emailnotValid'] == 1) { ?>
    <div id="fade" style="background-color:#F00;">
      <h3 id="fade1" align="center" style="color:#FFF; font-size:15px"><?php echo $_REQUEST['email'] ?> is not a valid Email Address</h3>
    </div>
    <?php } ?>
    <?php 	
		if(isset($_GET['emailNotfound']) && $_GET['emailNotfound'] == 1) { ?>
    <div id="fade" style="background-color:#F00;">
      <h3 id="fade1" align="center" style="color:#FFF; font-size:15px">Email not found in our system </h3>
    </div>
    <?php } ?>
    <div class="hideLog">
      <div class="text_area_home" id="grey_head">
        <p class="grey_head">LogIn to your account</p>
      </div>
      <div class="news-letter ">
        <form action="web/checkLogin.php" method="post" enctype="multipart/form-data">
          <input type="text" placeholder="Email Address" name="userEmail" class="form-control" required/>
          <br/>
          <input type="password" placeholder="Password" name="userPass" class="form-control" required />
          <br/>
          <input type="submit" value="LOGIN" class=" col-xs-12 btn btn-file btn btn-xs btn-primary" style="padding: 5px;" />
        </form>
        <br />
        <div class="showThis">
          <form action="web/sendForgot.php" method="post">
            <input type="text" name="userEmail" placeholder="Email Address" class="form-control" required/>
            <br/>
            <input type="submit" value="SUBMIT" class=" col-xs-12 btn btn-file btn btn-xs btn-primary" style="padding: 5px;" />
          </form>
        </div>
        <p class="news-letter-privacy"><a href="#" class="openReg"> Create Account </a> | <a href="#" class="openFor"> Forgot Password ? </a></p>
      </div>
    </div>
    <div class="showReg">
      <div class="text_area_home" style="background:#C0C0C0">
        <p class="grey_head">Sign Up to your account</p>
      </div>
      <div class="news-letter showReg">
        <p>please select <b>other</b> option if your institute is not available</p>
        <form action="web/checkRegister.php" method="post" enctype="multipart/form-data">
          <select  id="coaching" class="form-control" name="company">
            <option value="">Select Type</option>
            <option value="Student"<?php if($_SESSION['company'] == 'Student'){ echo 'selected';};?>>Student</option>
            <option value="College Staff"<?php if($_SESSION['company'] == 'College Staff'){ echo 'selected';};?>>College Staff</option>
            <option value="Coaching Staff"<?php if($_SESSION['company'] == 'Coaching Staff'){ echo 'selected';};?>>Coaching Staff</option>
          </select>
          <br/>
          <div class="coaching">
            <select class="form-control" name="coachbranchName">
              <option>Select Coaching Type</option>
              <option>Mathematics</option>
              <?php
  				$select=mysql_query("select * from branch Group by branchName");
  				while($row=mysql_fetch_array($select)) { ?>
              <option value="<?php echo $row['branchName']; ?>"<?php if($_SESSION['coachbranchName'] == $row['branchName']){ echo 'selected';};?>><?php echo $row['branchName']; ?></option>
              <?php }
		 		?>
            </select>
            <br/>
            <input type="text" name="coachinstituteName" class='form-control' value="<?php echo $_SESSION['coachinstituteName'];?>" placeholder="Institute Name"/>
          </div>
          <div class="college">
            <select onchange="fetch_select(this.value);" class="form-control" name="courseName">
              <option value="">Select Course</option>
              <option>Other</option>
              <?php
  		      	$select=mysql_query("SELECT * FROM courses");
  			      while($row=mysql_fetch_array($select)) { ?>
              <option value="<?php echo $row['courseName']; ?>"<?php if($_SESSION['courseName'] == $row['courseName']){ echo 'selected';};?>><?php echo $row['courseName']; ?></option>
              <?php } ?>
            </select>
            <br />
            <?php if(isset($_SESSION['branchName'])) { 
			   
			  ?>
            <select id="new_select" class="form-control"name="branchName" >
              <option value="">Select Branch</option>
              <option>Other</option>
              <?php 
				$sql=mysqli_query($dbconfig,"SELECT * FROM branch ");
			   $countSearch=mysqli_num_rows($sql);
 			   while($row=mysqli_fetch_assoc($sql)) {
				?>
              <option value="<?php echo $row['branchName']; ?>"<?php if($_SESSION['branchName'] == $row['branchName']){ echo 'selected';};?>><?php echo $row['branchName']; ?></option>
              <?php } ?>
            </select>
            <?php }else { ?>
            <select id="new_select" class="form-control"name="branchName" >
              <option value="">Select Branch</option>
              <option>Other</option>
            </select>
            <?php } ?>
            <br/>
            <select class="form-control" id="colgList" name="instituteName">
              <option value="">Select College</option>
              <option>Other</option>
              <?php 
 				$select=mysqli_query($dbconfig,"SELECT * FROM colleges ORDER BY instituteName ASC");
  				while($row=mysqli_fetch_array($select)){
 			  ?>
              <option value="<?php echo $row['instituteName']; ?>"<?php if($_SESSION['instituteName'] == $row['instituteName']){ echo 'selected';};?>><?php echo $row['instituteName']; ?></option>
              <?php } ?>
            </select>
            <div class="hideforcolgstaff"> <br/>
              <select class="form-control " name="year">
                <option value="">Select Year</option>
                <?php 
 				$select=mysql_query("SELECT * FROM year");
  				while($row=mysql_fetch_array($select)){
 			  ?>
                <option value="<?php echo $row['year']; ?>"<?php if($_SESSION['year'] == $row['year']){ echo 'selected';};?>><?php echo $row['year']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <br/>
          <input type="text" name="userName" class='form-control' placeholder="Your Name" value="<?php echo $_SESSION['userName'];?>" required/>
          <br/>
          <input type="text" name="userEmail" class='form-control'  placeholder="Email-ID" value="<?php echo $_SESSION['userEmail'];?>" required/>
          <br/>
          <input type="password" name="userPass" class='form-control' placeholder="Password" required/>
          <br/>
          <input type="password" name="userPassConfirm" class='form-control' placeholder="Retype Password" required/>
          <br/>
          <input type="submit" value="SUBMIT" class="btn-success_green" />
        </form>
        <p class="news-letter-privacy">Already Registered ?<a href="#" class="openLog"> LogIn </a></p>
      </div>
    </div>
  </div>
  <?php include 'web/footer.php'; ?>
  <!--<div class="single_sidebar"> <img src="images/add1.png" alt="" /> </div>--> 
</div>
<script>
 $(document).ready(function(){
	 $("#fade").hide(0);
	setInterval(function(){
        $("#fade").fadeIn(1000);
    }, 0);
		return false;	
	});
 </script>
<?php 
if(isset($_GET['alrdyReg'])or ($_GET['nameShort'])or ($_GET['passShort'])or ($_GET['passnotmatch'])
or ($_GET['emailFail'])or ($_GET['emailnotValid']) ) {  ?>
<script>
		$(document).ready(function(){
			$("div.showReg").show(); 
			$("div.hideLog").hide();
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
		});</script>
			<?php }else { ?> 
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
<?php } ?>
<script type="text/javascript">
function fetch_select(val){
 $.ajax({
 type: 'post',
 url: 'web/insertData.php',
 data: { get_option:val },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 } }); }
</script> 
<script>
$(document).ready(function(){
	<?php if($_SESSION['company'] == 'Coaching Staff') { ?>
        $(".coaching").show()
		 $("div.college").hide()
	<?php }else { ?>
		$("div.coaching").hide();
	 	$('#coaching').on('change',function(){
		if( $(this).val()=== "Coaching Staff"){
        $("div.coaching").show()
		 $("div.college").hide()
		 $("div.college").addClass("college")
        }
		if( $(this).val()=== "College Staff"){
		 $(".hideforcolgstaff").hide()
        }
}); <?php } ?>

$('#coaching').on('change',function(){
		if( $(this).val()=== "College Staff"){
        $(".college").show()
		 $("div.coaching").hide()
        }
		if( $(this).val()=== "College Staff"){
		 $(".hideforcolgstaff").hide()
        }
});
		<?php if($_SESSION['company'] == 'College Staff') { ?>
		 $(".hideforcolgstaff").hide()
		 <?php } ?>

$('#coaching').on('change',function(){
		if( $(this).val()=== "Student"){
        $(".college").show()
		 $("div.coaching").hide()
        }
		if( $(this).val()=== "Student"){
		 $(".hideforcolgstaff").show()
        }
});
});
</script>
<?php 
				function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'min',
        1 => 'sec'
);
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
	?>
