<!--<base href="//localhost/skymate/web/" />-->
    		<?php 
//if(!defined('MyConst')) {
   //die('Direct access not permitted');
//}
			$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
			($user=mysqli_fetch_assoc($sql));
			$branchName=$user['branchName'];
			$instituteName=(mysql_real_escape_string($user['instituteName']));
			$eduYear=$user['eduYear'];
			?>
<div class="header_area">
      <div class="logo floatleft"><a href="home.php"><img src="../images/oyemate2.jpg" alt="" /></a></div>
      <div class="social floatleft">
        <div class="search">
          <form action="search_result.php" method="get" id="search_form">
            <input type="text" placeholder="Search oyemate" name="searchVal" id="s" />
            <input type="submit"  id="search" class="btn btn-default btn-xs btn-rect" value="search" />
            <input type="hidden" value="post" name="post_type" />
          </form>
        </div>
      </div>
      <div class="top_menu floatleft">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="myprofile.php">Edit Profile</a></li>
          <?php if($user['company']=='Coaching Staff') {?>
          <li><a href="mycoaching.php">Coaching Class</a></li> <?php }else { ?>
          <li><a href="mycollege.php">My College</a></li><?php } ?>
          <li><a href="logout.php">Logout (<?php echo $user['userName']; ?>)</a></li>
        </ul>
      </div>
      
    </div>
    <!--<div class="main_menu_area">
      <ul id="nav">
        <li><a href="#">world news</a>
          <ul>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a>
              <ul>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
              </ul>
            </li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
          </ul>
        </li>
        <li><a href="#">sports</a></li>
        <li><a href="#">tech</a>
          <ul>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
          </ul>
        </li>
        <li><a href="#">business</a></li>
        <li><a href="#">Movies</a>
          <ul>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a>
              <ul>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
                <li><a href="#">Single item</a></li>
              </ul>
            </li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
          </ul>
        </li>
        <li><a href="#">entertainment</a></li>
        <li><a href="#">culture</a></li>
        <li><a href="#">Books</a>
          <ul>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
            <li><a href="#">Single item</a></li>
          </ul>
        </li>
        <li><a href="#">classifieds</a></li>
        <li><a href="#">blogs</a></li>
      </ul>
    </div>-->
    <script>
 $(document).ready(function(){
	 $("#fade").hide(0);
	setInterval(function(){
        $("#fade").fadeIn(1000);
    }, 0);
		return false;	
	});
		
		$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			return false;	
		});
 </script>
  
 <?php 
				function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'min',
        1 => 'sec'
);
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
	?>
	<script>
  $(document).ready(function() {
    $(".datepicker").datepicker();
  });
  $(document).ready(function() {
    $(".datepicker1").datepicker();
  });
  
  </script>
<!--For Broken Image-->
            <script>
                   document.addEventListener("DOMContentLoaded", function(event) {
   document.querySelectorAll('img').forEach(function(img){
  	img.onerror = function(){this.style.display='none';};
   })
});
                   </script>