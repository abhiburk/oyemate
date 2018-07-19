<?php 
//			$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
//			($user=mysqli_fetch_assoc($sql));
//			$branchName=$user['branchName'];
//			$instituteName=$user['instituteName'];
//			$eduYear=$user['eduYear'];
			?>

<div class="left-menu floatleft">
  <ul>
    <li>
    <div id="subSuccess"></div>
    <div id="unsubSuccess"></div>
      <div class="text_area_home">
        <div class="left-menu-margin">
          <?php if($user['company']!='Student') { ?>
          <p class="sub-menu"> <b ><a href="createAttendance.php">Attendance</a></p>
          <?php 
			$noti=mysqli_query($dbconfig,"SELECT * FROM send_records 
			WHERE readStatus='unread' AND sendTo='".$_SESSION['userid']."'");
			$count_noti=mysqli_num_rows($noti);
			?>
          <p class="sub-menu"> <b ><a href="notification.php">Notification
            <?php if($count_noti>0){ ?>
            (<?php echo $count_noti;?>)
            <?php } ?>
            </a></b></p>
          <?php }else { ?>
          <p class="sub-menu"> <b ><a href="notification.php">Notification</a></b></p>
          <p class="sub-menu"> <b ><a href="myattendance.php">Attendance</a></b></p>
          <?php } ?>
          <p class="sub-menu"><b> <b><a href="eventlist.php">Events</a></p>
          <?php if($user['company']=='Student') { ?>
          <p class="sub-menu"><b> <b><a href="matchmate.php">Matchmate</a></p>
          <?php } ?>
          <p class="sub-menu"><b> <b><a href="hostel.php">Hostel</a></p>
			<?php $sub=mysqli_query($dbconfig,"SELECT * FROM subscribes 
			WHERE userID='".$_SESSION['userid']."'");
			$count_sub=mysqli_num_rows($sub);
			if($count_sub==''){
			?>
          <p class="sub-menu"><b> <b><a class="clickSubscribe" href="#">Subscribe</a></p>
          <?php }else { ?>
           <p class="sub-menu"><b> <b><a class="clickUnsubscribe" href="#">Unsubscribe</a></p> <?php } ?>
          <p class="sub-menu"><b> <b><a href="contactUs.php">Contact us</a></p>
          
        </div>
      </div>
    </li>
  </ul>
</div>
<script>
			$(".clickUnsubscribe").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "insertSubscribe.php?xAction=unsubscribe",
 				success: function (response) {
					console.log(response);
  				document.getElementById("unsubSuccess").innerHTML=response; 
 		}
 		}); });
		</script>
<script>
			$(".clickSubscribe").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "insertSubscribe.php?xAction=subscribe",
 				success: function (response) {
					console.log(response);
  				document.getElementById("subSuccess").innerHTML=response; 
 		}
 		}); });
		</script> 
