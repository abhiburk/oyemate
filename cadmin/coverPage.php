<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Cover Page | Admin :: clapdust</title>
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
                <li class="breadcrumb-item"><a href="home.php">Home</a><i class="fa fa-angle-right"></i>Add New Cover</li>
            </ol>
            <form action="addCover.php" method="post" enctype="multipart/form-data">
            <div class="col-md-6 form-group1">
              <label class="control-label">Cover Info 1</label>
              <input type="text" name="info1"  placeholder="Large Text" >
            </div>
            <div class="col-md-6 form-group1">
              <label class="control-label">Cover Info 2</label>
              <input type="text" name="info2"  placeholder="Smaller Text" >
            </div>
            <div class="clearfix"> </div>
            <br/>
            <hr>
            <!--Working Details End Here-->
            <div class="vali-form vali-form1">
              <div class="col-md-6 form-group1">
                <label for="exampleInputFile">Cover Photo</label>
                <input type="file" name="coverPhoto" id="exampleInputFile">
              </div>
             </br>
             <div class="col-md-4 form-group" style="float:right">
              <input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <div class="clearfix"> </div>
          </form>
            
<div class="agile-grids">	
				<!-- tables -->
				
				<div class="agile-tables">
					<div class="w3l-table-info">
				  <h3>Added Cover Photos</h3>
				  <table id="table-two-axis" class="two-axis">
					<thead>
					  <tr>
                      	<th>Admin Name</th>
						<th>Cover-ID</th>
						<th>Larger Text</th>
						<th>Smaller Text</th>
						<th>Cover Photo</th>
						<th>Added Time</th>
                        <th>Action</th>
                        
					  </tr>
					</thead>
					<tbody>
                     <?php 
						$sql=mysqli_query($dbconfig,"SELECT * FROM cover LEFT JOIN admin ON cover.adminID=admin.adminID");
						while($celebrityInfo=mysqli_fetch_assoc($sql)){
						?>
					  <tr>
                      <td><?php echo $celebrityInfo['adminUname']; ?></td>
						<td><?php echo $celebrityInfo['coverID']; ?></td>
                        <td><?php $str=$celebrityInfo['info1'];
								  if(strlen($str)>=100){
								  echo substr($str,0,40).'... "</td>';
           	    				  }else echo $str; ?>
               
						<td><?php $str=$celebrityInfo['info2'];
								  if(strlen($str)>=100){
								  echo substr($str,0,40).'... "</td>';
           	   					  }else echo $str; ?>
						<td><a href="<?php echo '../uploads/'.$celebrityInfo['coverPhoto'];?>"><img src="<?php echo '../uploads/'.$celebrityInfo['coverPhoto'];  ?>" style="display: block;height: 50px;max-width: 75%;object-fit: cover;" class=" img-responsive"></a></td>
						<td><?php date_default_timezone_set('Asia/Kolkata'); echo date('d / m / Y',$celebrityInfo['time']); ?></td>
                        <td><!--<a href="editCelebrity.php?editCelebrity&cID=<?php echo $celebrityInfo['cID']; ?>">Edit</a> | -->
                      	<a href="delete.php?xAction=deleteCover&coverID=<?php echo $celebrityInfo['coverID']; ?>" class="confirmDelete">Delete</a>
                      	</td>
						
					  </tr><?php } ?>
					  
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
<div class="inner-block">

</div>
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