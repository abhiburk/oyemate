<!DOCTYPE HTML>
<html>
<head>
<title>Add Colleges | Admin :: Oyemate</title>
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
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<!-- //tables -->
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
  <li class="breadcrumb-item"><a href="home.php">Home</a><i class="fa fa-angle-right"></i></li>
</ol>
<div class="agile-grids">
<script>
			
		  $(document).ready(function(){
			$("div.hideReqForm").hide();
			$("a.addInstitute").click(function(){
			$("div.hideReqForm").toggle(1000);
			return false;	
			});
		});
        </script>
<div align="right" >
<a href="#" class="btn btn-success btn-sm btn-rect addInstitute"><small><i style="color:#FFF" class="glyphicon glyphicon-plus"></i> Add New Institute</small></a>
</div>
<!-- tables --> 

<!--<script language="JavaScript" src="//scripts.hashemian.com/js/countdown.js"></script>-->
<head>
</body>

<!--grid-->
 <div class="grid-form hideReqForm">
 	<div class="grid-form1">
  <form action="insertData.php" method="post" enctype="multipart/form-data">
  <input type="hidden" value="addCollege" name="xAction">
  <div class="form-group inline">
    <input type="text" name="instituteName" class="form-control" placeholder="Institute Name">
  </div>
  
  <div class="form-group inline">
    <input type="text" name="collegeCode" class="form-control" placeholder="Institute Code">
  </div>
  
  <div class="form-group inline">
    <input type="text" name="collegeContact" class="form-control" placeholder="Contact">
  </div>
  
  <div class="form-group inline">
    <input type="text" name="collegeWebsite" class="form-control" placeholder="Website">
  </div>
  
  <div class="form-group inline">
    <input type="text" name="collegeDirector" class="form-control" placeholder="Director">
  </div>
  
  <div class="form-group">
    <textarea class="form-control" name="collegeAddress" placeholder="Address"></textarea>
  </div>
  
 <div class="form-group">
    <input type="file" name="collegePhoto" >
  </div>
  
   <input type="submit" class="btn btn-default" value="Save">
  </form>
	</div>
</div>
<!----->

<div class="agile-tables">
  <div class="w3l-table-info">
    <h3>Colleges</h3>
    <table id="table-two-axis" class="two-axis">
      <thead>
        <tr>
          <th>Institute Name</th>
          <th>Action</th>
          <th>ID</th>
          <th>Institute Code</th>
          <th>College Photo</th>
          <th>Address</th>
          <th>Contact</th>
          <th>Website</th>
          <th>Director</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php 	$sql=mysqli_query($dbconfig,"SELECT * FROM colleges
				ORDER BY collegeID DESC");
				while($userInfo=mysqli_fetch_assoc($sql)){
		?>
        <tr>
        <td><?php echo $userInfo['instituteName']; ?></td>
          <td><a href="delete.php?xAction=deleteCollege&collegeID=<?php echo $userInfo['collegeID']; ?>" class="confirmDelete">Delete</a></td>
          <td><?php echo $userInfo['collegeID']; ?></td>
          <td><?php echo $userInfo['collegeCode']; ?></td>
          <td><a href="<?php echo '../uploads/'.$userInfo['collegePhoto'];?>">
                  <?php if($userInfo['collegePhoto']=='') { 
                 		echo '<img src="../images/default.jpg" class="img-responsive" />'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$userInfo['collegePhoto'];  ?>" style="display: block;height: 50px;max-width: 75%;object-fit: cover;" class="img-responsive"></a>
                <?php } ?></td>
          <td><?php echo $userInfo['collegeAddress']; ?></td>
          <td><?php echo $userInfo['collegeContact']; ?></td>
          <td><?php echo $userInfo['collegeWebsite']; ?></td>
          <td><?php echo $userInfo['collegeDirector']; ?></td>
          <td><?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $userInfo['collegeUpdateTime'] ). " ago"; ?></td>
         
        </tr>
        <?php } ?>
      </tbody>
    </table>
    
    <!-- <code class="css w3agile-css">
					
				  </code>-->
    
  </div>
  <!-- //tables -->
</div>
<script>
$(document).ready(function(){
	$("a.confirmDelete").click(function(){
		var isConfirm = window.confirm('Are You Sure Want To Delete This Record ?');
		if(isConfirm != true){
			return false;	
		}
	});
		return false;
	});
</script>
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
<div class="inner-block"></div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include 'copyright.php'; ?>
<!--COPY rights end here-->
</div>
</div>
<!--//content-inner-->
<!--/sidebar-menu-->
<?php include 'sidebar-left.php'; ?>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- /Bootstrap Core JavaScript -->

</body>
</html>
