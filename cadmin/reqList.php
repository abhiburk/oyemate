<!DOCTYPE HTML>
<html>
<head>
<title>College Requests | Admin :: clapdust</title>
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
				//showing the forgot form
			$("a.clickShow").hide();
			$("a.clickHide").click(function(){
			$("div.asked").hide(1000);
			$("a.clickHide").hide();
			$("a.clickShow").show();
			 /// 1000 means 1sec
			return false;	
			});
			$("a.clickShow").click(function(){
			$("a.clickShow").hide();
			$("a.clickHide").show();
			$("div.asked").show(1000);
			return false;	
			});
		});
		$(document).ready(function(){
			$("div.hideReqForm").hide();
			$("a.addInstitute").click(function(){
			$("div.hideReqForm").toggle(1000);
			return false;	
			});
		});
        </script>
<div align="right" ><a href="#" class="btn btn-success btn-sm btn-rect addInstitute"><small><i style="color:#FFF" class="glyphicon glyphicon-plus"></i> Add this Institute</small></a>
<a href="#" class="clickHide btn btn-success btn-sm btn-rect"><i style="color:#FFF" class="glyphicon glyphicon-eye-close"></i> Hide </a> 
<a href="#" class="clickShow btn btn-success btn-sm btn-rect"><i style="color:#FFF" class="glyphicon glyphicon-eye-open"></i> Show </a> </div>
<!-- tables --> 

<!--<script language="JavaScript" src="//scripts.hashemian.com/js/countdown.js"></script>-->
<head>
</body>
<?php
		$colg_reqID=$_REQUEST['colg_reqID'];
		$sql=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN college_request ON user.userID=college_request.userID 
		WHERE colg_reqID='".$colg_reqID."'");
		($userInfo=mysqli_fetch_assoc($sql))
		?>
<!--grid-->
 <div class="grid-form hideReqForm">
 	<div class="grid-form1">
  <form action="insertData.php" method="post" enctype="multipart/form-data">
  <input type="hidden" value="saveReqInfo" name="xAction">
  <input type="hidden" value="<?php echo $colg_reqID; ?>" name="colg_reqID">
  <input type="hidden" value="<?php echo $userInfo['userID']; ?>" name="userID">
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

<div class="asked">
  <div class="questions">
  <div class="col-md-4">
   <p><b>Request By:</b> <?php echo $userInfo['userName']; ?></p>
    </div>
    <div class="col-md-4">
      <p><b>Request for:</b> <?php echo $userInfo['instituteName']; ?></p>
    </div>
    
    <div class="col-md-4">
      <p><b>Requested:</b>
        <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $userInfo['requestTime'] ). " ago"; ?>
      </p>
    </div>
    
    <div class="col-md-4">
      <p><b>Accept Status:</b> <?php echo $userInfo['acceptStatus']; ?></p>
    </div>
    
    <div class="col-md-4">
      <p><b>Institute Code:</b> <?php echo $userInfo['collegeCode']; ?></p>
    </div>
   
    <a href="#" rel="<?php echo $userInfo['colg_reqID']; ?>" class="btn btn-sm btn-success accept">Accept Request</a>
    <a href="#" rel="<?php echo $userInfo['colg_reqID']; ?>" class="btn btn-danger btn-sm btn-rect reject">Reject Request</a></div>
</div>
<?php 
	  if($userInfo['acceptStatus'] =='accepted'){ ?>
		<script>
			$(document).ready(function(){
			$("a.accept").hide();
			$("a.reject").show();
			return false;	});
        </script>

<?php }
	  if($userInfo['acceptStatus'] =='rejected')
{ ?>
<script>
			$(document).ready(function(){
			$("a.reject").hide();
			$("a.accept").show();
			return false;	});
        </script>
<?php } ?>
<script>
			$(document).ready(function(){
			$("a.accept").click(function(){
			$("a.accept").hide();
			$("a.reject").show();
			return false;	
			});
			
			$("a.reject").click(function(){
			$("a.reject").hide();
			$("a.accept").show();
			return false;	
			});
		});
        </script>
<script>
$('.accept').click(function() {
var colg_reqID= $(this).attr('rel');     
$.ajax({
    type: "POST",
    url: "insertData.php?xAction=requestAccept&userID=<?php echo $userInfo['userID']; ?>",
    data: {'colg_reqID':colg_reqID},
    success: function(){
    window.location.replace("reqList.php?colg_reqID=" +colg_reqID);
	}	
});
return false;           
});
$('.reject').click(function() {
var colg_reqID= $(this).attr('rel');     
$.ajax({
    type: "POST",
    url: "insertData.php?xAction=requestReject&userID=<?php echo $userInfo['userID']; ?>",
    data: {'colg_reqID':colg_reqID},
    success: function(){
    window.location.replace("reqList.php?colg_reqID=" +colg_reqID);
	}	
});
return false;           
});
</script>
<div class="agile-tables">
  <div class="w3l-table-info">
    <h3>Request Recieved</h3>
    <table id="table-two-axis" class="two-axis">
      <thead>
        <tr>
          <th>Request By</th>
          <th>Action</th>
          <th>ID</th>
          <th>Request For</th>
          <th>Institute Code</th>
          <th>Address</th>
          <th>Contact</th>
          <th>Website</th>
          <th>Director</th>
          <th>Accept Status</th>
          <th>Request Time</th>
        </tr>
        </a>
      </thead>
      <tbody>
        <?php 	$sql=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN college_request ON user.userID=college_request.userID 
				ORDER BY colg_reqID DESC");
				while($userInfo=mysqli_fetch_assoc($sql)){
		?>
        <tr>
          <td><a href="reqList.php?request&colg_reqID=<?php echo $userInfo['colg_reqID']; ?>"><?php echo $userInfo['userName']; ?></a></td>
          <td><a href="delete.php?xAction=deleteUser&userID=<?php echo $userInfo['userID']; ?>" class="confirmDelete">Delete</a></td>
          <td><?php echo $userInfo['colg_reqID']; ?></td>
          <td><?php echo $userInfo['instituteName']; ?></td>
          <td><?php echo $userInfo['collegeCode']; ?></td>
          <td><?php echo $userInfo['collegeAddress']; ?></td>
          <td><?php echo $userInfo['collegeContact']; ?></td>
          <td><?php echo $userInfo['collegeWebsite']; ?></td>
          <td><?php echo $userInfo['collegeDirector']; ?></td>
          
          <?php if($userInfo['acceptStatus']=='pending'){ ?>
          <td><i class="glyphicon glyphicon-exclamation-sign"></i> Pending</td>
          <?php } ?>
          <?php if($userInfo['acceptStatus']=='accepted'){ ?>
          <td><i class="glyphicon glyphicon-check" style="color:#0C0"></i> Accepted</td>
          <?php } ?>
          <?php if($userInfo['acceptStatus']=='rejected'){ ?>
          <td><i class="glyphicon glyphicon-ban-circle" style="color:#F000"></i> Rejected</td>
          <?php } ?>
          
          <td><?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $userInfo['requestTime'] ). " ago"; ?></td>
         
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
