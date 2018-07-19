<?php 
?>
<div class="right_coloum floatright grey">
<?php
$start=0;
$limit=5;
if(isset($_GET['uID'])){?>


<?php	$userID=$_GET['uID'];
	$start=($userID-1)*$limit;}
else{ $userID=1; }
?>

		
          <div class="single_right_coloum" >
          <?php 
		  if($user['company']=='Coaching Staff'){
			  $coaching=mysql_query("SELECT * FROM coaching_institute WHERE userID='".$_SESSION['userid']."' ");
 			  $coachingRow=mysql_fetch_array($coaching);
			  
			  $friends_query=mysqli_query($dbconfig,"SELECT * FROM coaching_institute_students 
			  WHERE ci_ID='".$coachingRow['ci_ID']."'");
			  $count_add_students=mysqli_num_rows($friends_query);
			  }else{
		  		$friends_query=mysqli_query($dbconfig,"SELECT * FROM user WHERE
		   		company='Student' AND userID !='".$_SESSION['userid']."' AND branchName='".$branchName."' AND instituteName='".strip_tags($instituteName)."' ");
		 		$count_add_students=mysqli_num_rows($friends_query);  }
				?>
                <?php if($user['company']=='Coaching Staff'){ ?>
            <h2 class="title">Students <small style="font-size:14px">(<?php echo $count_add_students; ?>)</small></h2><?php }else { ?>
            <h2 class="title">Class Mates <small style="font-size:14px">(<?php echo $count_add_students; ?>)</small></h2> <?php } ?>
            <a class="more floatright toggleFrnd" href="#">click</a>
            <ul>
             <?php 
			 	if($user['company']=='Coaching Staff'){
					
					
					$friends_query=mysqli_query($dbconfig,"SELECT * FROM coaching_institute_students  LEFT JOIN user ON 
					coaching_institute_students.userID=user.userID  WHERE ci_ID='".$coachingRow['ci_ID']."' 
					ORDER BY coaching_institute_students.userID DESC LIMIT $start, $limit"); }else {
					
     	  		$friends_query=mysqli_query($dbconfig,"SELECT * FROM user WHERE company='Student' 
				AND userID!='".$_SESSION['userid']."' AND branchName='".$branchName."' 
				AND instituteName='".$instituteName."' ORDER BY userID DESC LIMIT $start, $limit"); }
				
				$count_download=mysqli_num_rows($friends_query);
				while($friends=mysqli_fetch_assoc($friends_query)){
				?>
              <li>
                <div class="single_cat_right_content text_area_home hideFrnd">
                  <?php if($friends['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="friendImg"/>'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$friends['userImg']; ?>" class="friendImg"/><?php } ?>
                  <h3><a href="user/<?php echo $friends['userID']; ?>"><?php echo $friends['userName']; ?></a>
                 <p class="single_cat_right_content_meta" style="margin-left:0;margin-top: 5px;">Join
                  <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $friends['signupDate'] ). " ago"; ?>
                  <?php 
				  $friends_query1=mysqli_query($dbconfig,"SELECT * FROM user_visit WHERE userID='".$friends['userID']."' ORDER BY u_visitID DESC LIMIT 1");
				  $friends1=mysqli_fetch_assoc($friends_query1)
				  ?>
                   <?php if($friends1['visitTime']!=''){echo 'Active &nbsp';date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $friends1['visitTime'] ). " ago"; }?>
                  </p></h3>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
<?php
//fetch all the data from database.
if($user['company']=='Coaching Staff'){
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM coaching_institute_students  LEFT JOIN user ON 
					coaching_institute_students.userID=user.userID
					ORDER BY coaching_institute_students.userID DESC"));

}else{
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM user WHERE company='Student' 
				AND userID!='".$_SESSION['userid']."' AND branchName='".$branchName."' 
				AND instituteName='".$instituteName."' ORDER BY userID DESC "));
}
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
        <?php if($userID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='home.php?uID=".($userID-1)."' class='popular_more hideFrnd'> prev </a>";
}
if($userID!=$total)
if($rows >0){
{
	////Go to previous page to show next 10 items.
	echo "<a href='home.php?uID=".($userID+1)."' class='popular_more hideFrnd' >more</a>";
}
}
?>
       <?php if(isset($_GET['uID'])==true){ ?>
<script>
	 		$(document).ready(function(){
			$(".hideFrnd").show();
			$("a.toggleFrnd").click(function(){
			$(".hideFrnd").toggle(500);	
			return false;	
			});});
     	</script>
        <?php }else { ?>  <script>
	 		$(document).ready(function(){
			$(".hideFrnd").hide();	
			$("a.toggleFrnd").click(function(){
			$(".hideFrnd").toggle(500);
			return false;	
			});});
     	</script>
        <?php } ?>
        <?php
		if($user['company']=='Coaching Staff'){}else {
$start=0;
$limit=5;
if(isset($_GET['staffID'])){
	$userID=$_GET['staffID'];
	$start=($userID-1)*$limit;}
else{ $userID=1; }
?>
		
          <div class="single_right_coloum">
          <?php $staff_query=mysqli_query($dbconfig,"SELECT * FROM user WHERE 
		   company='College Staff' AND userID !='".$_SESSION['userid']."' AND branchName='".$branchName."' AND instituteName='".$instituteName."' ");
				$count_download=mysqli_num_rows($staff_query); ?>
             
            <h2 class="title">Staff <small style="font-size:14px">(<?php echo $count_download; ?>)</small></h2>
            <a class="more floatright toggleStaff" href="#">click</a>
            
            <ul>
             <?php 
     	  		$staff_query=mysqli_query($dbconfig,"SELECT * FROM user WHERE 
			    company='College Staff' AND userID!='".$_SESSION['userid']."' AND branchName='".$branchName."' AND instituteName='".$instituteName."'
				 ORDER BY userID DESC LIMIT $start, $limit");
				$count_download=mysqli_num_rows($staff_query);
				while($staff=mysqli_fetch_assoc($staff_query)){
				?>
              <li>
                <div class="single_cat_right_content text_area_home hideStaff">
                  <?php if($staff['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="friendImg"/>'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$staff['userImg']; ?>" class="friendImg"/><?php } ?>
                   <h3><a href="user/<?php echo $staff['userID']; ?>"><?php echo $staff['userName']; ?></a>
                  <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top: 5px;"> Join 
                  <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $staff['signupDate'] ). " ago"; ?>
                  <?php 
				  $friends_query1=mysqli_query($dbconfig,"SELECT * FROM user_visit WHERE userID='".$staff['userID']."' ORDER BY u_visitID DESC LIMIT 1 ");
				  $friends1=mysqli_fetch_assoc($friends_query1)
				  ?>
                  <?php if($friends1['visitTime']!=''){echo 'Active &nbsp'; date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $friends1['visitTime'] ). " ago"; }?>
                  </p></h3>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
<?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM user WHERE branchName='".$branchName."' AND instituteName='".$instituteName."'
AND company='College Staff' AND userID!='".$_SESSION['userid']."'"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
        <?php if($userID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='?staffID=".($userID-1)."' class='popular_more hideStaff'> prev </a>";
}
if($userID!=$total)
if($rows >0){
{
	////Go to previous page to show next 10 items.
	echo "<a href='?staffID=".($userID+1)."' class='popular_more hideStaff' >more</a>";
}
}
}
?>  <script>
			$(document).ready(function(){
			//$(".hideStaff").hide();	
			$("a.toggleStaff").click(function(){
			$(".hideStaff").toggle(500);
			return false;	
			});});
     	</script>
         
                
            	