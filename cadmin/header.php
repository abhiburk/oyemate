<?php 
require "../config.php";
ob_start();
session_start();
if(!isset($_SESSION["adminid"]) && empty($_SESSION["adminid"]))
{ header('location:index.php?error=1'); exit;
}
$adminid = intval($_SESSION['adminid']);
?>

<!--header start here-->

<div class="header-main">
  <div class="logo-w3-agile">
    <h1><a href="index.html">Pooled</a></h1>
  </div>
  <div class="w3layouts-left"> 
    
    <!--search-box-->
    <div class="w3-search-box">
      <form action="#" method="post">
        <input type="text" placeholder="Search..." required="">
        <input type="submit" value="">
      </form>
    </div>
    <!--//end-search-box-->
    <div class="clearfix"> </div>
  </div>
  <div class="w3layouts-right">
    <div class="profile_details_left"><!--notifications of menu start -->
      <ul class="nofitications-dropdown">
        <li class="dropdown head-dpdn"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
          <ul class="dropdown-menu">
            <li>
              <div class="notification_header">
                <h3>You have 3 new messages</h3>
              </div>
            </li>
            <li><a href="#">
              <div class="user_img"><img src="images/in11.jpg" alt=""></div>
              <div class="notification_desc">
                <p>Lorem ipsum dolor</p>
                <p><span>1 hour ago</span></p>
              </div>
              <div class="clearfix"></div>
              </a></li>
           
            <li>
              <div class="notification_bottom"> <a href="#">See all messages</a> </div>
            </li>
          </ul>
        </li>
        <?php 	$sql_noti=mysqli_query($dbconfig,"SELECT * FROM college_request LEFT JOIN user ON college_request.userID=user.userID
				WHERE readStatus='unread'");
				$count_unread=mysqli_num_rows($sql_noti);
			?>
        <li class="dropdown head-dpdn"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"><?php echo $count_unread; ?></span></a>
          <ul class="dropdown-menu">
            <li>
              <div class="notification_header">
                <h6>You have <?php echo $count_unread; ?> unread notification</h6>
              </div>
            </li>
            <?php  if($count_unread > 0){
				   $sql_noti=mysqli_query($dbconfig,"SELECT readStatus,colg_reqID,userImg,userName,requestTime 
				   FROM ((SELECT readStatus,colg_reqID,userImg,userName,requestTime FROM college_request LEFT JOIN user ON college_request.userID=user.userID
				   WHERE readStatus='unread') UNION ALL 
				   (SELECT readStatus,colg_reqID,userImg,userName,requestTime FROM college_request LEFT JOIN user ON college_request.userID=user.userID
				   WHERE readStatus='read')) results  ORDER BY requestTime DESC ");
				   while($row_noti=mysqli_fetch_assoc($sql_noti)){
			?>
            <li <?php if($row_noti['readStatus']=='unread') {?> style="background-color: #EDECEC;margin-bottom: 2px;" <?php } ?>><a href="#" rel="<?php echo $row_noti['colg_reqID'];?>" class="unread">
              <div class="user_img">
                  <?php if($row_noti['userImg']=='') { 
                 		echo '<img src="../images/default.jpg" class="img-responsive" />'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$row_noti['userImg'];  ?>" class="img-responsive">
                  <?php } ?>
              </div>
              <div class="notification_desc">
                <p <?php if($row_noti['readStatus']=='unread') {?> style="font-weight:bold" <?php } ?>><?php echo $row_noti['userName']; ?></p>
                <p><span><?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $row_noti['requestTime'] ). " ago."; ?></span></p>
              </div>
              <div class="clearfix"></div>
              </a></li><?php }} ?>
           
           <!-- <li>
              <div class="notification_bottom"> <a href="#">See all notifications</a> </div>
            </li>-->
          </ul>
        </li>
 <script>
$('.unread').click(function() {
var colg_reqID= $(this).attr('rel');     
$.ajax({
    type: "POST",
    url: "insertData.php?xAction=readStatus",
    data: {'colg_reqID':colg_reqID},
    success: function(){
    window.location.replace("reqList.php?colg_reqID=" +colg_reqID);
	}	}); return false;           
});
</script>       
        
        
        
        <li class="dropdown head-dpdn"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
          <ul class="dropdown-menu">
            <li>
              <div class="notification_header">
                <h3>You have 8 pending task</h3>
              </div>
            </li>
            <li><a href="#">
              <div class="task-info"> <span class="task-desc">Database update</span><span class="percentage">40%</span>
                <div class="clearfix"></div>
              </div>
              <div class="progress progress-striped active">
                <div class="bar yellow" style="width:40%;"></div>
              </div>
              </a></li>
            <li><a href="#">
              <div class="task-info"> <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                <div class="clearfix"></div>
              </div>
              <div class="progress progress-striped active">
                <div class="bar green" style="width:90%;"></div>
              </div>
              </a></li>
            <li><a href="#">
              <div class="task-info"> <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                <div class="clearfix"></div>
              </div>
              <div class="progress progress-striped active">
                <div class="bar red" style="width: 33%;"></div>
              </div>
              </a></li>
            <li><a href="#">
              <div class="task-info"> <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                <div class="clearfix"></div>
              </div>
              <div class="progress progress-striped active">
                <div class="bar  blue" style="width: 80%;"></div>
              </div>
              </a></li>
            <li>
              <div class="notification_bottom"> <a href="#">See all pending tasks</a> </div>
            </li>
          </ul>
        </li>
        <div class="clearfix"> </div>
      </ul>
      <div class="clearfix"> </div>
    </div>
    <!--notification menu end -->
    
    <div class="clearfix"> </div>
  </div>
  <div class="profile_details w3l">
    <ul>
      <li class="dropdown profile_details_drop"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <div class="profile_img">
          <?php 
						$sql=mysqli_query($dbconfig,"SELECT * FROM admin WHERE adminID='".$adminid."'");
						$admin_info=mysqli_fetch_assoc($sql);
						?>
          <span class="prfil-img"> <img src="<?php echo '../uploads/'.$admin_info['adminPhoto'];  ?>" class=" img-responsive"> </span>
          <div class="user-name">
            <p><?php echo $admin_info['adminUname']; ?></p>
            <h5 style="color:#FFF;">
            Privileges:<?php echo $admin_info['privileges']; ?>
            </h6>
          </div>
          <i class="fa fa-angle-down"></i> <i class="fa fa-angle-up"></i>
          <div class="clearfix"></div>
        </div>
        </a>
        <ul class="dropdown-menu drp-mnu">
          <h6>
            <li> Email:<?php echo $admin_info['adminEmail']; ?> </li>
          </h6>
          <li> Password: <?php echo $admin_info['adminPassword']; ?> </li>
          <li> <!--<a href="editAdminProfile.php"><i class="fa fa-user"></i> Profile</a>-->
            <h6>Select Profile Photo</h6>
            <form action="saveAdminInfo.php" method="post" enctype="multipart/form-data">
              <input type="file" name="adminPhoto" >
              <input type="submit" class="btn btn-xs btn-primary" value="Save">
            </form>
          </li>
          <li> <a href="adminLogout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
          <br />
          <b>Active Admin: </b>
          <?php 
		  $session=session_id();
		  $sql=mysqli_query($dbconfig,"SELECT * FROM admin_visit LEFT JOIN admin ON admin_visit.adminID=admin.adminID ");
		  while($admin_active=mysqli_fetch_assoc($sql)){
		  ?>
          <li> <a href="#"><i style="border-radius:15px;height: 15px;" class="btn btn-success btn-xs btn-circle"></i> <?php echo $admin_active['adminUname']; ?>, (<?php echo ($countAdmin); ?>) Stories</a> </li>
          <?php } ?>
        </ul>
      </li>
    </ul>
  </div>
  <div class="clearfix"> </div>
</div>
<!--heder end here-->

<?php 
function humanTiming ($time)
{ 	$time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second' );
    	foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }}?>
