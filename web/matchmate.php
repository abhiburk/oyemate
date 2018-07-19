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
        <?php 
		$match=mysqli_query($dbconfig,"SELECT * FROM hifi_user") or die (mysqli_error());
	    $matchCount=mysqli_num_rows($match);
		if($matchCount=='') {?>
        <div class="text_area_home">
            <div class="single_left_coloum_wrapper single_cat_left">
              <h2 class="title">Matchmate coming soon.... </h2>
              <a class="more" href="#">readme</a>
              <div class="single_cat_left_content floatleft">
                <h3>what is matchmate ?</h3>
                <p>matchmate is simple user portal where if user agree to join this will be displayed along with another person.so that two people can be rated by their profile photo.</p>
                <p>1. no user will be match again with each other unless they have same ratings given by users.</p>
                <p>2. your match will always be with the random person.</p>
                <p>3. if you're with high ratings, you will be in popular list of web page.</p>
                <p>4. this feature will be <b>coming soon</b> on oyemate stay tune....</p>
              </div>
            </div>
          </div>
          <?php }else { ?>
        
        
        
          <?php $sql_mm=mysqli_query($dbconfig,"SELECT * FROM matchmate WHERE userID='".$_SESSION['userid']."'");
			  ($count_mm=mysqli_num_rows($sql_mm)); 
			  if($count_mm=='') {?>
          <div id="enterSuccess"></div>
          <div class="text_area_home">
            <div class="single_left_coloum_wrapper single_cat_left">
              <h2 class="title">what is ? </h2>
              <a class="more" href="#">readme</a>
              <div class="single_cat_left_content floatleft">
                <h3>what is matchmate ?</h3>
                <p>matchmate is simple user portal where if user agree to join this will be displayed along with another person.so that two people can be rated by photo.</p>
                <p>1. no user will be match again with each other unless they have same ratings given by users.</p>
                <p>2. your match will always be with the random person.</p>
                <p>3. if you're with high rating then you will be in top list of web page.</p>
                <p>4. if your are <b>intrested</b> to be a part of this, you can continue here</p>
              </div>
            </div>
          </div>
          <a href="#" class="enterme">
          <div class="text_area_home" id="eventRegister">
            <p align="center">Yes Enter me & Fetch My Profile Photo</p>
          </div>
          </a>
          <?php }else { ?>
          <script type="text/javascript">
// Show loading overlay when ajax request starts
 $('.loading-overlay').hide();
$( document ).ajaxStart(function() {
    $('.loading-overlay').show();
});
// Hide loading overlay when ajax request completes
$( document ).ajaxStop(function() {
    $('.loading-overlay').hide();
});
</script>
          <div class="post-wrapper">
            <div class="loading-overlay">
              <div class="overlay-content">Loading.....</div>
            </div>
            <div id="posts_content">
              <?php
    //Include pagination class file
    include('Pagination.php');
    
    //Include database configuration file
    include('../config.php');
    
    $limit = 2;
    
    //get number of rows
    $queryNum = $dbconfig->query("SELECT COUNT(*) as postNum FROM matchmate");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
    
    //initialize pagination class
    $pagConfig = array('baseURL'=>'getData.php', 'totalRows'=>$rowCount, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = $dbconfig->query("SELECT * FROM matchmate LEFT JOIN user ON matchmate.userID=user.userID ORDER BY matchmate.userID ASC LIMIT $limit");
    if($query->num_rows > 0){ ?>
              <div id="hified"></div>
              <div class="text_area_home inline" style="display: block;">
                <?php
            while($row = $query->fetch_assoc()){ 
        ?>
                <form action="insertData.php" id="myform" method="post" enctype="multipart/form-data" style="display: flex;"/>
                <input type="hidden" name="xAction" value="hifi" />
                <input type="hidden" name="hifiWith[]" value="<?php echo $row['userID']; ?>" />
                <div class="matchImg box">
                  <div class="overlay">
                  <?php $match=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN hifi_user ON user.userID=hifi_user.hifiBy 
				  WHERE user.userID='".$_SESSION['userid']."' AND hifiTo='".$row['userID']."' ");
				  $matchCount=mysqli_num_rows($match);
				  $rowMatch=mysqli_fetch_assoc($match);
				  if($matchCount==true){ echo '<p style="color:#333;">Click Image to <b>NoHifi</b> this</p>'; }
				  else { echo '<p style="color:#333;">Click Image to <b>Hifi</b> this</p>';}
			?>
                  </div>
                  <div class="opacity">
                    <?php if($row['userImg']=='') {echo '<img src="../images/default.jpg" class="">';}else { ?>
                    <a href="#" <?php if($matchCount!=true) {echo'class="clickHifi"';}else {echo 'class="clickNoHifi"';}?> rel="<?php echo $row['userID']; ?>"> <img src="<?php echo '../uploads/'.$row['userImg']; ?>" /></a>
                    <?php } ?>
                  </div>
                  <p><a href="user/<?php echo $row['userID']; ?>"><?php echo $row['userName']; ?></a></p>
                </div>
                <?php } ?>
              </div>
              <?php echo $pagination->createLinks(); ?>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
          <input type="submit" class="clickHifi" style="visibility:hidden;"/>
          </form>
          <script>
		  $(document).on("click", ".clickHifi", function (e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
			var hifiTo = this.rel;
			var data_string = 'formData='+ formData +'&hifiTo='+ hifiTo;
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data:data_string ,
 				success: function (response) {
  				document.getElementById("hified").innerHTML=response; 
 		}
 		}); });
        </script> 
          <script>
			$(".clickNoHifi").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "insertData.php?xAction=unhifi",
				data:{hifiTo:this.rel},
 				success: function (response) {
  				document.getElementById("hified").innerHTML=response; 
 		}
 		}); });
		</script> 
          <script>
			$(".enterme").click(function(e) {
				//$("#results").load("fetchData.php");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "insertData.php?xAction=enterme",
 				success: function (response) {
  				document.getElementById("enterSuccess").innerHTML=response; 
 		}
 		}); });
		</script> 
          <script>
      $(document).ready(function(e) {
        $("input.hideSheet").hide();
			$("a.showSheetField").click(function(){
			var sheetID= $(this).attr('rel');
			$("input.hideInputSheet"+sheetID).toggle(500);
			return false;	
			});
    });
      </script> 
          <!--<script>
$(document).ready(function(){
	$("a.confirmDelete").click(function(){
		var isConfirm = window.confirm('Are You Sure Want To Delete This Record ?');
		if(isConfirm != true){
			return false;	
		}
	});
		return false;
	});
</script>--> <?php } ?>
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
