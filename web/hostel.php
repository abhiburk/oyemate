<?php require '../config.php'; 
session_start();
ob_start();

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
if(($user['company']!='Student')){
  header('LOCATION:home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Matchmate : Oyemate</title>
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
        
        <!--<div class="text_area_home">
            <div class="single_left_coloum_wrapper single_cat_left">
              <h2 class="title">Hostel coming soon.... </h2>
              <a class="more" href="#">readme</a>
              <div class="single_cat_left_content floatleft">
                <h3>what is hostel feature ?</h3>
                <p>this tool is useful for a user to <b>find out hostels</b> near by them or is a platform to add you hostel services for students</p>
                <p>1. this feature will help a new student to find out best hostel's <b>near</b> to their colleges.</p>
                <p>2. hostel service provider will be able to <b>add their hostels</b> to the list.</p>
                <p>3. their will be <b>no more</b> searching of a place physically for new comer.</p>
                <p>4. feature <b>coming soon</b> on oyemate stay tune....</p>
              </div>
            </div>
          </div>-->
          <a href="#" class="clickAddHostel">
           <div class="text_area_home" id="eventRegister">
            <p align="center"><b>Add Hostel</b></p>
          </div>
          </a>
		<div class="hideAddHostel">
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="addHostel" />
            <div class="text_area_home">
              <input type="text" class="form-control" name="hostelName" placeholder="Hostel Name" required/>
            </div>
            <div class="text_area_home">
              <input type="text" class="form-control" name="hostelContact" placeholder="Mobile No." required/>
            </div>
            <div class="text_area_home">
              <h3 style="display: flex;margin: 0;">
              <select name="compEID" class="form-control" required>
                <option value="">Select Near College</option>
                <?php $sql_college=mysqli_query($dbconfig,"SELECT * FROM colleges");
  				while($row_college=mysqli_fetch_assoc($sql_college)){ ?>
                <option value="<?php echo $row_college['collegeID']; ?>"><?php echo $row_college['instituteName']; ?></option>
                <?php } ?>
              </select>
              <input class="form-control" type='text' id="feeOutput" disabled="disabled" placeholder="Competition Fee" />
            </div>
            </h3>
            <div class="text_area_home">
              <select id="options" class="form-control" onchange="setbox(this.value)">
                <option value="">Select No of Partners for this Competition</option>
                <option value="1">Single</option>
                <option value="2">Team</option>
              </select>
              <input class="form-control space part1" type='text' name="part1" placeholder="Name of Partner 1" />
              <input class="form-control space part2" type='text' name="part2" placeholder="Name of Partner 2" />
              <input class="form-control space part3" type='text' name="part3" placeholder="Name of Partner 3" />
              <input class="form-control space part4" type='text' name="part4" placeholder="Name of Partner 4" />
              <input class="form-control space part5" type='text' name="part5" placeholder="Name of Partner 5" />
            </div>
            <input type="submit" value="Register Me" class="registerUser floatright  btn btn-primary btn-xs btn-rect"  />
          </form>
          <script>
			$(".registerUser").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertEvent.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("registersuccess").innerHTML=response; 
 		}
 		}); });
		</script> 
        </div>
        
         <script>
         $(document).ready(function(e) {
            $(".hideAddHostel").hide();
			$(".clickAddHostel").click(function(e) {
            $(".hideAddHostel").toggle(500);
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
