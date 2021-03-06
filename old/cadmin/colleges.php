<?php 
	

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Colleges | Admin :: clapdust</title>
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
   				 
    <div class="grid-form hideReqForm">
 	<div class="grid-form1">
    <form action="insertData.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="xAction" value="updateCollege">
    				<?php 
						$sql_colleges=mysqli_query($dbconfig,"SELECT * FROM colleges WHERE collegeID='".$_REQUEST['collegeID']."' ");
						$count=mysqli_num_rows($sql_colleges);
						($colleges=mysqli_fetch_assoc($sql_colleges));
					?>
 
    <input type="hidden" name="collegeID" value="<?php echo $colleges['collegeID']; ?>">
    
  <div class="form-group inline">
  <h4>Institute Name</h4>
    <textarea name="instituteName" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll form-control"><?php echo $colleges['instituteName']; ?></textarea>
  </div>
  
  <div class="form-group inline">
  <h4>Institute Code</h4>
    <input type="text" name="collegeCode" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll form-control" value="<?php echo $colleges['collegeCode']; ?>">
  </div>
  
  <div class="form-group inline">
  <h4>Institute Address</h4>
    <input type="text" name="collegeAddress" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll form-control" value="<?php echo $colleges['collegeAddress']; ?>">
  </div>
  
  <div class="form-group inline">
  <h4>Contact</h4>
    <input type="text" name="collegeContact" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll form-control" value="<?php echo $colleges['collegeContact']; ?>">
  </div>
 
  <div class="form-group inline">
   <h4>Website</h4>
    <input type="text" name="collegeWebsite" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll form-control" value="<?php echo $colleges['collegeWebsite']; ?>">
  </div>
  
  <div class="form-group inline">
  <h4>Director</h4>
    <input type="text" name="collegeDirector" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll form-control" value="<?php echo $colleges['collegeDirector']; ?>">
  </div>
  
 <div class="form-group">
 <h4>Upload College Photo</h4>
    <input type="file" name="collegePhoto" class="hideInputAll<?php echo $colleges['collegeID']; ?> hideAll" >
  </div>
   
<input type="submit" value="Update" class=" btn btn-primary btn-xs btn-rect hideInputAll<?php echo $colleges['collegeID']; ?> hideAll"/> 
</form>
	</div>
</div>
    
    <div class="agile-grids"> 
      <!-- tables -->
      
      
      <div class="agile-tables">
        <div class="w3l-table-info">
          <h3>Colleges</h3>
          <table id="table-two-axis" class="two-axis">
            <thead>
              <tr>
                <th>Institute Name</th>
                <th>Action</th>
                <th>Photo</th>
                <th>Institute Code</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Website</th>
                <th>Director</th>
                <th>Views</th>
                <th>Ratings</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
           
              		<?php 
						$sql_colleges=mysqli_query($dbconfig,"SELECT * FROM colleges ORDER BY collegeID DESC ");
						$count=mysqli_num_rows($sql_colleges);
						while($colleges=mysqli_fetch_assoc($sql_colleges)) {
					?>
             
              <tr>
                <td><?php echo $colleges['instituteName']; ?>
                </td>
                
                <td><a class="showAllField" href="colleges.php?collegeID=<?php echo $colleges['collegeID']; ?>" rel="">Edit</a> | 
                      <a href="delete.php?xAction=deleteCollege&collegeID=<?php echo $colleges['collegeID']; ?>" class="confirmDelete">Delete</a>
                      </td>
                      
                <td><a href="<?php echo '../uploads/'.$colleges['collegePhoto'];?>">
                  <?php if($colleges['collegePhoto']=='') { 
                 		echo '<img src="../images/default.jpg" class="img-responsive" />'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$colleges['collegePhoto'];  ?>" style="display: block;height: 50px;max-width: 75%;object-fit: cover;" class="img-responsive"></a>
                <?php } ?></td>
                  
                <td><?php echo $colleges['collegeCode']; ?>
                </td>
                <td><?php echo $colleges['collegeAddress']; ?>
                </td>
                <td><?php echo $colleges['collegeContact']; ?>
                </td>
                <td><?php echo $colleges['collegeWebsite']; ?>
                </td>
                <td><?php echo $colleges['collegeDirector']; ?>
                </td>
                <td><?php echo $colleges['views']; ?></td>
                <td><?php echo $colleges['ratingCount']; ?></td>
                <td><?php if($colleges['collegeUpdateTime']=='') {}else {date_default_timezone_set('Asia/Kolkata'); echo date('d / m / Y',$colleges['collegeUpdateTime']); }?></td>
              
              </tr>
              
              <?php } ?>
              
            </tbody>
          </table>
           <script>
			$(document).ready(function() {
    		$("div.hideReqForm").hide();
			return false;	
			});</script>
            <?php if(isset($_GET['collegeID']) && $_GET['collegeID'] == $_REQUEST['collegeID'] ) { ?>
            <script>
			$(document).ready(function() {
    		$("div.hideReqForm").show();
			return false;	
			});</script>
            <?php } ?>
          
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
      <div class="inner-block"> </div>
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