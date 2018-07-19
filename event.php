<?php require 'config.php';
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
 
$eventName_query=mysqli_query($dbconfig,"SELECT * FROM events WHERE eventID='".$_REQUEST['eventID']."' 
OR webName='".$_REQUEST['webName']."'");
$row_web_name=mysqli_fetch_assoc($eventName_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'web/basehref.php'; ?>
<title>Events : Skymate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<?php include 'web/assetsLinks.php'; ?>
</head>
<body class="body">
<div class="body_wrapper">
  <?php include 'web/header.php'; ?>
  <div class="center">
    <div class="content_area">
      <div class="main_content floatleft">
        <?php include 'web/left-menu.php'; ?>
        <div class="left_coloum floatleft" >
          <?php if(isset($_GET['addSuccess']) && $_GET['addSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0C0;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student Added Successfully </h3>
          </div>
          <?php } ?>
          <?php $event_query=mysqli_query($dbconfig,"SELECT * FROM events LEFT JOIN user ON 
		  		events.userID=user.userID 
		  		WHERE events.eventID='".$_REQUEST['eventID']."' OR events.webName='".$row_web_name['webName']."' ");
				$count_event=mysqli_num_rows($event_query);
				$row_event=mysqli_fetch_assoc($event_query);
		  ?>
          <div class="text_area_home">
            <div class="content-right">
              <?php if($row_event['eventPhoto']=='') { 
                  echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)">'; } else{ ?>
              <div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$row_event['eventPhoto']; ?>)">
                <?php } ?>
              </div>
              <div class="bnr-img">
                <?php if($user['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="userImg"/>'; } else{ ?>
                <img src="<?php echo '../uploads/'.$user['userImg']; ?>" class="userImg"/>
                <?php } ?>
              </div>
              <div class="bnr-text">
                <h1><?php echo $row_event['eventName']; ?></h1>
                <?php if($row_event['instituteName']=='') { echo '<p>Institute:Not Available</p>'; } else {?>
                <p><b>Institute:</b> <?php echo $row_event['instituteName']; ?></p>
                <h3>
                  <p><b>Department:</b> <?php echo $row_event['branchName']; ?></p>
                </h3>
                <?php } ?>
              </div>
              
              <div class="btm-num hideStar">
                <ul>
                  <li> 
                    <!--<h4><?php echo $row_event['ci_ratingCount']; ?></h4>
                    <h5>Rating</h5>--> 
                  </li>
                  <li>
                    <h4><?php echo $row_event['eventViews']; ?></h4>
                    <h3>Views</h3>
                  </li>
                </ul>
              </div>
              
            </div>
            <div class="clearfix"></div>
          </div>
          
          
          <a href="registerE.php?eventid=<?php echo $row_event['eventID'];?>">
          <div class="text_area_home" id="eventRegister"> 
          <p align="center">Register for this Event</p>
          </div></a>
          
          <div class="text_area_home "> 
          <a href="#" class="clickViewCo">View Co-ordinators</a> 
          </div>
          
          
          <div class="text_area_home viewCo">
            <?php 
		  $sql = mysqli_query($dbconfig,"SELECT * FROM event_co RIGHT JOIN user ON event_co.addedTo=user.userID
		  WHERE `eventID`='".$row_web_name['eventID']."'");
    	  while($rowCO = mysqli_fetch_assoc($sql)) {
		  ?>
            <p><b><a href="userProfile/<?php echo $rowCO['userID'];?>"><?php echo $rowCO['userName']; ?></a></b></p>
           <?php } ?>
          </div>
          
          <script>
	 		$(document).ready(function(){
  			$("div.hideComp").hide();
			$("a.clickAddComp").click(function(){
			$(".hideInfo").toggle(500);
			$("div.hideComp").toggle(500);
			return false;	
			});});
				 
			$(document).ready(function(){
  			$("div.hideFee").hide();
			$("a.clickFee").click(function(){
			$("div.hideFee").toggle(500);
			return false;	
			});});
     </script>
     
          <div class="single_left_coloum_wrapper ">
            <h2 class="title">Event Info</h2>
            <a class="more toggleOne" href="#">Toggle</a>
            
                <div id="saveEvent"></div>
                <div class="text_area_home hideHome hideInfo">
                <div class="left-margin ">
                  <h3> Contact Info: <small class="font"><?php echo $row_event['eventContact']; ?></small></h3>
                </div></div>
                
                <div class="text_area_home hideHome hideInfo">
                <div class="left-margin">
                  <h3> Event Web Name: <b><small class="font"><?php echo $row_event['webName']; ?></small></b></h3>
                </div></div>
                
              
                <?php 
				$fee_query=mysqli_query($dbconfig,"SELECT * FROM comp_fee LEFT JOIN events ON comp_fee.eventID=events.eventID
				WHERE events.eventID='".$row_event['eventID']."'");
				$count_fee_data=mysqli_num_rows($fee_query);
				if ($count_fee_data == 0) { echo 'Data Not Available';}else {
				while($fee_row=mysqli_fetch_assoc($fee_query)){
		  		?>
                 
               <div class="text_area_home hideHome">
                <div class="left-margin"><h3>
                	<?php echo $fee_row['compName']; ?>: <small class="font"> &#8377 <?php echo $fee_row['compFee']; ?></small>
                  <div class="floatright">
                  <small class="feeTime">
                    <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $fee_row['compAddTime'] ). " ago"; ?>
                  </small> 
                  </div>
                </h3></div>
               </div>
                <?php  }} ?>
                
              <?php
$start=0;
$limit=8;
if(isset($_GET['epID'])){
	$epID=$_GET['epID'];
	$start=($epID-1)*$limit;}
else{ $epID=1; }
?>
               <?php 
			$sqlUpload=mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN event_posts ON user.userID=event_posts.userID 
			LEFT JOIN events ON event_posts.eventID=events.eventID
			WHERE events.webName='".$_REQUEST['webName']."' ORDER BY epID DESC LIMIT $start,$limit");
			$countUpload=mysqli_num_rows($sqlUpload);
			
			if($countUpload ==0){ echo '<div class="text_area_home hideHome">
			<div class="left-margin">
			<h3>No Post Available </h3></div></div>'; }else {
			while($rowUpload=mysqli_fetch_assoc($sqlUpload)){
			?>
         <div class="text_area_home hideHome">
            <div class="left-margin">
                   <h3><a class="content" href="../event/<?php echo $rowUpload['webName']; ?>"> <?php echo $rowUpload['eventName']; ?></a>
                <div style="float:right; display:inline-block; font-size:11px;font-weight: normal;"> <?php echo "" . humanTiming( $rowUpload['eventPostTime'] ). " ago"; ?> by <a href="user/<?php echo $rowUpload['userID']; ?>"><?php echo $rowUpload['userName']; ?></a></div>
              	   </h3>
                   <img src="<?php echo '../uploads/'.$rowUpload['eventPostPhoto']; ?>" class="img-responsive timelineImg" onerror="this.style.display='none'" />
                   <p class="hideDetail<?php echo $rowUpload['epID']; ?> hideAll">
                 		<?php $str=$rowUpload['eventTextPost']; if(strlen($str)>=101){echo substr($str,0,100).'...';}else echo $str; ?>
             	   </p>
                 
            	 <span class="more_text<?php echo $rowUpload['epID']; ?> hideAll">
                   <p><?php echo $rowUpload['eventTextPost']; ?></p>
                 </span> 
              </div>
                 <a class="readmore showMore content" rel="<?php echo $rowUpload['epID']; ?>" href="#" style="float:right">read more</a> <a class="readmore hideMore" rel="<?php echo $rowUpload['epID']; ?>" href="#" style="float:right">hide more</a> </div>
               <?php }} ?>
         
       
 <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN event_posts ON user.userID=event_posts.userID 
			LEFT JOIN events ON event_posts.eventID=events.eventID
			WHERE events.webName='".$_REQUEST['webName']."' ORDER BY epID DESC"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
<div style='display:flex;'>
<?php if($epID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='../event/".($_REQUEST['webName'])."&epID=".($epID-1)."' class='popular_more hideHome'> prev </a>";
}
if($epID!=$total)
{
if($rows >0)
{
	////Go to previous page to show next 10 items.
	echo "<a href='../event/".($_REQUEST['webName'])."&epID=".($epID+1)."' class='popular_more hideHome' >more</a>";
}

}
?>        
</div></div>

<!--For Broken Image-->
            <script>
                   document.addEventListener("DOMContentLoaded", function(event) {
   document.querySelectorAll('img').forEach(function(img){
  	img.onerror = function(){this.style.display='none';};
   })
});
                   </script>
          <script>
		  $(document).ready(function(){
			 $("span.hideAll").hide();
			$("a.hideMore").hide();
		    $("a.showMore").click(function(){
			$("a.hideMore").show();	
			$("a.showMore").hide();
			var epID= $(this).attr('rel');
			$("p.hideDetail"+epID).toggle(500);
			$("span.more_text" +epID).toggle(1000);
			return false;	
		});
		    $("a.hideMore").click(function(){
			$("a.hideMore").hide();	
			$("a.showMore").show();
			var epID= $(this).attr('rel');
			$("p.hideDetail"+epID).toggle(500);
			$("span.more_text" +epID).toggle(1000);
			return false;	
		}); 
			  
  			$("div.viewCo").hide();
			$("a.clickViewCo").click(function(){
			$("div.viewCo").toggle(500);
			return false;	
			});});
$(document).ready(function(){
			$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			$(".hideFee").toggle();
			return false;	
			});
			
});
        </script> 
        </div>
        <?php include 'web/midRightbar.php'; ?>
        </div>
      </div>
      <?php include 'web/rightbar.php'; ?>
    <?php include 'web/footer.php'; ?>
  </div>
</div>
<?php 
$time=time();
$eventID=$row_event['eventID'];
$sqlCheck=mysqli_query($dbconfig,"SELECT * FROM event_view WHERE eventID ='".$eventID."' AND userID='".$_SESSION['userid']."'");
$count=mysqli_num_rows($sqlCheck);
if($count == 0){
$sql=mysqli_query($dbconfig,"INSERT INTO event_view (eventID,userID,eventViewTime) VALUES ('".$eventID."','".$_SESSION['userid']."','".$time."')");
$sql_count=mysqli_query($dbconfig,"UPDATE events SET eventViews=eventViews+1 WHERE eventID='".$eventID."'");
}
?>
</body>
</html>
