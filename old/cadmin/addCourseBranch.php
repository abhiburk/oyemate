<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Add Course & Branch Page | Admin :: skymate</title>
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
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            </ol>
            <form action="insertData.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="addCourseBranch">
           <div class="col-md-6 form-group1">
              <label class="control-label">Branch Name</label>
              <input type="text" name="branchName"  placeholder="Type Branch Name..." >
              
              <label class="control-label">Courses Dropdown</label>
              <select name="courseID">
              <?php 
				$sql=mysqli_query($dbconfig,"SELECT * FROM courses ORDER BY courseID DESC ");
				while($courses=mysqli_fetch_assoc($sql)){
			  ?>
               <option value="<?php echo $courses['courseID']; ?>"><?php echo $courses['courseName']; ?></option>
               <?php } ?>
               </select>
               </div> 
            <div class="col-md-6 form-group1">
              <label class="control-label">Course Name</label>
              <input type="text" name="courseName"  placeholder="Type Course Name..." >
            </div>
             
             <div class="col-md-6 form-group1" style="margin-top:20px">
              <input type="submit" class="btn btn-primary" value="Add">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <div class="clearfix"> </div>
          </form>
            
<div class="agile-grids">	
				<!-- tables -->
				
				<div class="agile-tables">
					<div class="w3l-table-info">
				  <h3>Course & Branch List</h3>
				  <table id="table-two-axis" class="two-axis">
					<thead>
					  <tr>
                      	<th>Course Name</th>
                        <th>Action</th>
						<th>Branch Names</th>
                        <th>Action</th>
					  </tr>
					</thead>
					<tbody>
                     <?php 
						$sql=mysqli_query($dbconfig,"SELECT * FROM courses RIGHT JOIN branch ON courses.courseID=branch.courseID  ");
						while($courses=mysqli_fetch_assoc($sql)){
			  		?>
					  <tr>
                      <td><?php echo $courses['courseName']; ?>
                      <form action="insertData.php" method="post" enctype="multipart/form-data">
                     	<input type="hidden" name="xAction" value="courseUpdate" >
                        <input type="hidden" name="courseID" value="<?php echo $courses['courseID']; ?>" >  
           				<input type="text" value="<?php echo $courses['courseName']; ?>" class="form-control hideInputCourse<?php echo $courses['courseID']; ?> hideCourse" name="courseName">
                   		<input type="submit" class="btn btn-primary btn-xs btn-rect hideInputCourse<?php echo $courses['courseID']; ?> hideCourse" value="Update">
                    </form> 
                      </td>
                      <td><a class="showCourseField" href="#" rel="<?php echo $courses['courseID']; ?>" >Edit</a>  | 
                      	  <a href="delete.php?xAction=deleteCourse&courseID=<?php echo $courses['courseID']; ?>" class="confirmDelete">Delete</a>
                        </td>
						<td><?php echo $courses['branchName']; ?>
                    <form action="insertData.php" method="post" enctype="multipart/form-data">
                     	<input type="hidden" name="xAction" value="branchUpdate" >
                        <input type="hidden" name="branchID" value="<?php echo $courses['branchID']; ?>" >  
           				<input type="text" value="<?php echo $courses['branchName']; ?>" class="form-control hideInputBranch<?php echo $courses['branchID']; ?> hideBranch" name="branchName">
                   		<input type="submit" class="btn btn-primary btn-xs btn-rect hideInputBranch<?php echo $courses['branchID']; ?> hideBranch" value="Update">
                    </form>   
                        </td>
                        <td><a class="showBranchField" href="#" rel="<?php echo $courses['branchID']; ?>" >Edit</a>  | 
                      		<a href="delete.php?xAction=deleteBranch&branchID=<?php echo $courses['branchID']; ?>" class="confirmDelete">Delete</a>
                        </td>
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
	$(document).ready(function() {
    		$("input.hideBranch").hide();
			$("a.showBranchField").click(function(){
			var branchID= $(this).attr('rel');
			$("input.hideInputBranch"+branchID).toggle(500);
			return false;	
			});
			$("input.hideCourse").hide();
			$("a.showCourseField").click(function(){
			var courseID= $(this).attr('rel');
			$("input.hideInputCourse"+courseID).toggle(500);
			return false;	
			});
});
</script>            
            
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