<?php 
session_start();
ob_start();

require "../config.php";
if(!isset($_SESSION["adminid"]) && empty($_SESSION["adminid"]))
{ header('location:../index.php'); exit;
}else

$searchVal = $_REQUEST['searchVal'];
$adminid = intval($_SESSION['adminid']);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Search Results | Admin :: clapdust</title>
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
      <li class="breadcrumb-item"><a href="home.php">Home</a><i class="fa fa-angle-right"></i><a href="addStory.php">Add New Story</a></li>
    </ol>
    <div class="agile-grids"> 
      <!-- tables -->
      		<?php if($searchVal == ""){
			echo "OPPS!! ,Please Enter Your Search"; exit;	
			}else {?>
      		Search Result For "<b><?php echo $searchVal ?></b>"
      		<?php } ?><br>
    
     					<?php 
						$sql1=mysqli_query($dbconfig,"SELECT * FROM celebrity LEFT JOIN admin ON celebrity.adminID=admin.adminID
						WHERE cName LIKE '%".mysql_real_escape_string($searchVal)."%' OR cInfo LIKE '%".mysql_real_escape_string($searchVal)."%' OR
						workInfo LIKE '%".mysql_real_escape_string($searchVal)."%' OR tag LIKE '%".mysql_real_escape_string($searchVal)."%' ");
						$searchVal1 = mysqli_num_rows($sql1);
						if($searchVal1 !=0){ 
						
						?>
      <div class="agile-tables">
        <div class="w3l-table-info">
          <h3>Added Stories</h3>
          <table id="table-two-axis" class="two-axis">
            <thead>
              <tr>
                <th>Name</th>
                <th>Action</th>
                <th>ID</th>
                <th>Admin</th>
                <th>Email</th>
                <th>Info</th>
                <th>Photo</th>
                <th>WorkInfo</th>
                <th>WorkPhoto</th>
                <th>Views</th>
                <th>Catagory</th>
                <th>Date</th>
                <th>Recommendation</th>
                <th>Added Time</th>
              </tr>
            </thead>
            <tbody>
              			<?php 
						$sql=mysqli_query($dbconfig,"SELECT * FROM celebrity LEFT JOIN admin ON celebrity.adminID=admin.adminID
						WHERE cName LIKE '%".mysql_real_escape_string($searchVal)."%' OR cInfo LIKE '%".mysql_real_escape_string($searchVal)."%' OR
						workInfo LIKE '%".mysql_real_escape_string($searchVal)."%' OR tag LIKE '%".mysql_real_escape_string($searchVal)."%' ");
						while($celebrityInfo=mysqli_fetch_assoc($sql)){
						?>
              <tr>
                <td><?php echo $celebrityInfo['cName']; ?></td>
                <td><a href="editCelebrity.php?editCelebrity&cID=<?php echo $celebrityInfo['cID']; ?>">Edit</a> | <a href="delete.php?xAction=deleteCelebrity&cID=<?php echo $celebrityInfo['cID']; ?>" class="confirmDelete">Delete</a></td>
                <td><?php echo $celebrityInfo['cID']; ?></td>
                <td><?php echo $celebrityInfo['adminUname']; ?></td>
                <td><?php echo $celebrityInfo['cEmail']; ?></td>
                <td><?php $str=$celebrityInfo['cInfo'];
				if(strlen($str)>=100){
				echo substr($str,0,40).'... "</td>';
           	   }else echo $str; ?>
                <td><a href="<?php echo '../uploads/'.$celebrityInfo['cPhoto'];?>"><img src="<?php echo '../uploads/'.$celebrityInfo['cPhoto'];  ?>" style="display: block;height: 50px;max-width: 75%;object-fit: cover;" class="img-responsive"></a></td>
                <td><?php $str=$celebrityInfo['workInfo'];
				if(strlen($str)>=100){
				echo substr($str,0,40).'... "</td>';
           	   }else echo $str; ?>
                <td><a href="<?php echo '../uploads/'.$celebrityInfo['workPhoto'];?>"><img src="<?php echo '../uploads/'.$celebrityInfo['workPhoto'];  ?>" style="display: block;height: 50px;max-width: 75%;object-fit: cover;" class=" img-responsive"></a></td>
                <td><?php echo $celebrityInfo['views']; ?></td>
                <td><?php echo $celebrityInfo['tag']; ?></td>
                <td><?php echo $celebrityInfo['day']; ?>-<?php echo $celebrityInfo['month']; ?>-<?php echo $celebrityInfo['year']; ?></td>
                <td><?php echo $celebrityInfo['recommend']; ?></td>
                <td><?php date_default_timezone_set('Asia/Kolkata'); echo date('d / m / Y',$celebrityInfo['time']); ?></td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
          </div> 
        </div> 
          <!-- <code class="css w3agile-css">
					
				  </code>--> 
          
        				<?php 
						$sql2=mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN request ON user.userID=request.userID 
						WHERE reqName LIKE '%".mysql_real_escape_string($searchVal)."%' OR reqContact LIKE '%".mysql_real_escape_string($searchVal)."%' OR
						why LIKE '%".mysql_real_escape_string($searchVal)."%' OR request LIKE '%".mysql_real_escape_string($searchVal)."%' OR 
						userName LIKE '%".mysql_real_escape_string($searchVal)."%' ORDER BY request.reqID DESC ");
						$searchVal2 = mysqli_num_rows($sql2);
						if($searchVal2 != 0){ 
						?>
 <div class="agile-tables">                    
  <div class="w3l-table-info">
    <h3>Request Recieved</h3>
    <table id="table-two-axis" class="two-axis">
      <thead>
        <tr>
          <th>Request By</th>
          <!--<th>Action</th>-->
          <th>ID</th>
          <th>Request For</th>
          <th>Contact</th>
          <th>Why</th>
          <th>Request Status</th>
          <th>Cancellation Status</th>
          <th>Request Time</th>
        </tr>
      </thead>
      <tbody>
       					<?php 
						$sql=mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN request ON user.userID=request.userID 
						WHERE reqName LIKE '%".mysql_real_escape_string($searchVal)."%' OR reqContact LIKE '%".mysql_real_escape_string($searchVal)."%' OR
						why LIKE '%".mysql_real_escape_string($searchVal)."%' OR request LIKE '%".mysql_real_escape_string($searchVal)."%' OR 
						userName LIKE '%".mysql_real_escape_string($searchVal)."%' ORDER BY request.reqID DESC ");
						while($userInfo=mysqli_fetch_assoc($sql)){
						?>
        <tr>
          <td><a href="reqList.php?request&reqID=<?php echo $userInfo['reqID']; ?>"><?php echo $userInfo['userName']; ?></td>
          </a>
          <!--<td><a href="delete.php?xAction=deleteUser&userID=<?php echo $userInfo['userID']; ?>" class="confirmDelete">Delete</a></td>-->
          <td><?php echo $userInfo['reqID']; ?></td>
          <td><?php echo $userInfo['reqName']; ?></td>
          <td><?php echo $userInfo['reqContact']; ?></td>
          <td><?php $str=$userInfo['why'];
							if(strlen($str)>=100){
							echo substr($str,0,50).'... "</td>';
           	   				}else echo $str; ?></td>
          <?php if($userInfo['request']=='pending'){ ?>
          <td><i class="glyphicon glyphicon-exclamation-sign"></i> Pending</td>
          <?php } ?>
          <?php if($userInfo['request']=='accepted'){ ?>
          <td><i class="glyphicon glyphicon-check" style="color:#0C0"></i> Accepted</td>
          <?php } ?>
          <?php if($userInfo['request']=='rejected'){ ?>
          <td><i class="glyphicon glyphicon-ban-circle" style="color:#F000"></i> Rejected</td>
          <?php } ?>
          <td><?php if($userInfo['deleteReq']=='yes' OR $userInfo['deleteReq']== 'yes(read)'){ ?>
            <?php 		$time=time();
		  				$time_out=$time-60*24; 
						if($userInfo['deleteTime'] < $time_out){ 
						$countTime=$userInfo['deleteTime'] - $time_out
						?>
            <small class="showExpire"><i class="glyphicon glyphicon-time" style="color:#F00"></i>Timeout</small><br>| <a href="#" rel="<?php echo $userInfo['reqID']; ?>" class="reject"> Reject Request</a> |
            <a href="#" rel="<?php echo $userInfo['reqID']; ?>" class="confirmDelete">Delete</a> |
            <?php }else { ?>
            <i class="glyphicon glyphicon-remove-sign" style="color:#F00"></i>Recieved
            <?php } } ?></td>
          <td><?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $userInfo['time'] ). " ago"; ?>
            ,<br>
            <?php date_default_timezone_set('Asia/Kolkata'); echo date('d / m / Y',$userInfo['time']); ?></td>
        </tr>
        <?php } }?>
      </tbody>
    </table>
  </div>
</div>
        
     <!--FAQ-->
     			<?php 
				$sql3=mysqli_query($dbconfig,"SELECT * FROM faq 
				WHERE question LIKE '%".mysql_real_escape_string($searchVal)."%' OR 
				faqName LIKE '%".mysql_real_escape_string($searchVal)."%' OR 
				answer LIKE '%".mysql_real_escape_string($searchVal)."%' ORDER BY faqID DESC");
				$searchVal3 = mysqli_num_rows($sql3);
						if($searchVal3 != 0){ 
				?>
     <div class="asked">
        		<?php 
				$sql=mysqli_query($dbconfig,"SELECT * FROM faq 
				WHERE question LIKE '%".mysql_real_escape_string($searchVal)."%' OR 
				faqName LIKE '%".mysql_real_escape_string($searchVal)."%' OR 
				answer LIKE '%".mysql_real_escape_string($searchVal)."%' ORDER BY faqID DESC");
				while($faqList=mysqli_fetch_assoc($sql)){
				?>
        <div class="questions">
          <h2><?php echo $faqList['question']; ?> </h2>
          <h6> Asked by: <b><?php echo $faqList['faqName']; ?></b>
          <?php if($faqList['userID']!='0'){ ?>(Member)<?php } ?>,
          <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $faqList['time'] ). " ago"; ?>, 
          <a href="#" rel="<?php echo $faqList['faqID']; ?>" class="answer" >Answer this</a>
          </h6>
          <div class="hideArea<?php echo $faqList['faqID']; ?> hideAll">
            <form id="myForm"  method="post" enctype="multipart/form-data">
              <input type="hidden" class="xAction1" name="xAction" value="answerQ">
              <input type="hidden" class="faqID1" name="faqID" value="<?php echo $faqList['faqID']; ?>">
              <textarea class="form-control" class="answer1" name="answer" placeholder="Answer to this question" ></textarea>
              <input id="submit" type="submit" value="Answer" class="btn btn-success btn-sm btn-rect">
            </form>
          </div>
          <p><?php echo $faqList['answer']; ?></p>
        </div>
        <?php } ?>
      </div> 	
     	
	  <script>
			$("input[type='submit']").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
                success: function(result) {
                   window.location = "faqList.php";
                }});});
	 </script>
	  <?php } ?>
      <!-- //faq --> 
      <script>
			$(document).ready(function(){
			$("div.hideAll").hide();
			$("a.answer").click(function(){
			var faqID= $(this).attr('rel');
			$("div.hideArea"+faqID).toggle(1000);
			return false;	
			});});
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
 <?php if($searchVal1.''.$searchVal2.''.$searchVal3 == 0){ 
     echo '<b>No Record Found For Your Search " '.$searchVal.' "</b>';} ?>

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
		</script> </div> 	
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