<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}

$uid=$_SESSION['userid'];
$eventID=$_GET['eventID'];

$sql=mysqli_query($dbconfig, "SELECT * FROM event_co RIGHT JOIN events ON event_co.eventID=events.eventID
WHERE events.eventID='".$_REQUEST['eventID']."' AND (addedTo='{$uid}' OR addBy='{$uid}'  OR (events.userID='{$uid}'))");

if(mysqli_num_rows($sql)) {
   //User has access to this event
   $sql_check=mysqli_query($dbconfig,"SELECT * FROM events LEFT JOIN user ON events.userID=user.userID WHERE eventID='".$_REQUEST['eventID']."' ");
   $row_event=mysqli_fetch_assoc($sql_check);

} else  {
   //User couldn't be found, therefore no access to this event.
   header('LOCATION:home.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
     <head>
     <title>Events : Oyemate</title>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
     <link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
     <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
     <?php include 'assetsLinks.php'; ?>
     </head>
     <body class="body">
<div class="body_wrapper">
       <?php include 'header.php'; ?>
       <div class="center">
    <div class="content_area">
           <div class="main_content floatleft">
        <?php include 'left-menu.php'; ?>
        <div class="left_coloum floatleft" >
        
               <?php if(isset($_GET['addSuccess']) && $_GET['addSuccess'] == 1) { ?>
               <div id="fade" style="background-color:#0C0;">
            	 <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Student Added Successfully </h3>
          	   </div>
               <?php } ?>

          <div class="text_area_home">
            <div class="content-right">
                   <?php if($row_event['eventPhoto']=='') { 
                  		echo '<div class="cntnt-img" style="background-image:url(../images/institute.jpg)"></div>'; } else{ ?>
                   <a href="<?php echo '../uploads/'.$row_event['eventPhoto']; ?>"><div class="cntnt-img" style="background-image:url(<?php echo '../uploads/'.$row_event['eventPhoto']; ?>)"></div></a>
				   <?php } ?>
               
             
             
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
                <h3><p><b>Department:</b> <?php echo $row_event['branchName']; ?></p></h3>
                <?php } ?>
              </div>
                   
              <p><a class="floatright photo" href="#">Edit</a></p>     
              <div class="btm-num hideStar">
                <ul>
                  <li> 
                    <!--<h4><?php echo $row_event['ci_ratingCount']; ?></h4>
                    <h5>Rating</h5>--> 
                  </li>
                  <li>
                    <h4><?php echo $row_event['eventViews']; ?></h4>
                    <h3><small class="font-set">Views</small></h3>
                  </li>
                </ul>
              </div>
           </div>
           	
              <form method="post" enctype="multipart/form-data" action="insertEvent.php">
              	<input type="hidden" name="xAction" value="updateEventPhoto"/>
                <input type="hidden" name="eventID" value="<?php echo $row_event['eventID']; ?>"/>
              <div id="hide_img_btn">
              	<input type="text" class="form-control" name="eventName" value="<?php echo $row_event['eventName']; ?>" />
              </div> <br/>
              
              <div class="floatleft"  id="hide_img_btn">
                <div class="fileupload fileupload-new" data-provides="fileupload"> <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"> </span> <span class="btn btn-file btn btn-xs btn-primary" > <span class="fileupload-new">Select Photo</span> <span class="fileupload-exists" >Change</span>
                  <input type="file" name="eventPhoto" />
                  </span>
                </div>
              </div>
              
             <div id="hide_img_btn">
              	<input class="btn btn-file btn btn-xs btn-primary "  type="submit" value="Update">
             </div>
             </form>  
        <div class="clearfix"></div>
      </div>
        
        <div id="coAddSuccess"></div>
           <div class="text_area_home" id="unblur">
           		 <form action="insertEvent.php" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="xAction" value="eventPost" />
                   <input type="hidden" name="eventID" value="<?php echo $row_event['eventID']; ?>" />
                   <h3 style="display: flex;">
                   <textarea name="eventTextPost" class="form-control" id="blutThis" placeholder="Post your activity"></textarea>
                   <input type="submit" value="Post" class="floatright btn btn-primary btn-xs btn-rect"  />
              	   </h3>
                   <input type="file" name="eventPostPhoto" />
                 </form>
          </div>
          
             <div class="text_area_home "> <a href="#" class="clickAddStud">Add Co-ordinator</a> | <a href="#" class="clickAddComp">Add Competitions</a> | <a href="#" class="clickEInfo">Edit Event Info</a> | <a href="eventregisters.php?eventID=<?php echo $row_event['eventID']; ?>" >View Register Users</a></div>
               <div class="text_area_home searchStud">
            	<form method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="xAction" value="searchCo"/>
                   <input type="hidden" name="eventID" value="<?php echo $row_event['eventID']; ?>" />
                   <p>Adding person as Co-ordinator to <b><?php echo $row_event['eventName']; ?></b> will also have full control over this event</p>
                   <h3 style="display: flex;">
                   <input id="userName" type="text" class="form-control hideSearchStud" name="userName" placeholder="Search Student to Add as Co-ordinate" style="width:100%" />
                   <input type="submit" value="Add" class="addCo floatright btn btn-primary btn-xs btn-rect"  />
              	   </h3>
                 </form>
          	   </div>
               
             <div class="text_area_home searchStud">
            	<?php $sql = mysqli_query($dbconfig,"SELECT * FROM event_co RIGHT JOIN user ON event_co.addedTo=user.userID
		  		  WHERE `eventID`='".$row_event['eventID']."'");
				  $count=mysqli_num_rows($sql);
				  if($count ==0){ echo 'No Person Added';}else {
    	  		  while($rowCO = mysqli_fetch_assoc($sql)) {
		    	?>
            	<p><b><a href="user/<?php echo $rowCO['userID'];?>"><?php echo $rowCO['userName']; ?></b> <a class="floatright confirmDelete" href="delete.php?eID=<?php echo $_REQUEST['eventID']; ?>&coordinateID=<?php echo $rowCO['coID']; ?>&xAction=removeCo" rel="<?php echo $rowCO['coID']; ?>">Remove</a> </p>
            	<?php }} ?>
            </div>
<script>
	$(function() {
    $( "#userName" ).autocomplete({
     source: 'searchStudent.php?xAction=<?php echo 'searchCo'; ?>'
    });
	});
</script> 
         <script>
			$(".addCo").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("coAddSuccess").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
		</script>
     <div id="searchResult"> </div>
        <script>
		$(document).ready(function(){
  			$("div#hide_img_btn").hide();
			$("a.photo").click(function(){
			$("div#hide_img_btn").toggle(500);
			return false;	
			});});
	 		$(document).ready(function(){
  			$("div.hideInfo").hide();
			$("a.clickEInfo").click(function(){
			$(".hideInfo").toggle(500);
			return false;	
			});});
			$(document).ready(function(){
  			$("div.hideComp").hide();
			$("a.clickAddComp").click(function(){
			$(".hideInfo").toggle(500);
			$("div.hideComp").toggle(500);
			return false;	
			});});
			
	 		$(document).ready(function(){
  			$("div.searchStud").hide();
			$("a.clickAddStud").click(function(){
			$("div.searchStud").toggle(500);
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
            <div id="saveEvent"></div>
            	<form method="post" enctype="multipart/form-data">
                   <input type="hidden" name="xAction" value="eventInfo" />
                   <input type="hidden" name="eventID" value="<?php echo $row_event['eventID']; ?>" />
               <div class="text_area_home hideHome hideInfo">
                  <div class="left-margin ">
                    <h3> Contact Info: <small class="font-set"><?php echo $row_event['eventContact']; ?></small> <a class="showBtn floatright showContactField" href="#" rel="<?php echo $row_event['userID']; ?>" >Edit</a>
                    <input type="text" class="form-control hideInputContact<?php echo $row_event['userID']; ?> hideContact" name="eventContact" placeholder="Enter You Contact Info for Event" value="<?php echo $row_event['eventContact']; ?>" />
                 	 </h3>
                   </div>
               </div>
               
             <div class="text_area_home hideHome hideInfo">
                <div class="left-margin ">
                       <h3> Event Web Name: <b><small class="font-set"><?php echo $row_event['webName']; ?></small></b> <a class="showBtn floatright showWebnameField" href="#" rel="<?php echo $row_event['userID']; ?>" >Edit</a> </h3>
                       <p class="font hideInputWebname<?php echo $row_event['userID']; ?> hideWebname">Eg.www.oyemate/event/eventname</p>
                       <input type="text" class="form-control hideInputWebname<?php echo $row_event['userID']; ?> hideWebname" name="webName" placeholder="Enter You Web Name Eg.www.skymate/event/eventname" value="<?php echo $row_event['webName']; ?>" />
                </div>
              </div>
              
              <div class="text_area_home hideHome hideInfo">
                <div class="left-margin ">
                       <h3>Text Message: <b><small class="font-set"><?php echo $row_event['textMessage']; ?></small></b></h3>
                       <a class="showBtn floatright showMessageField" href="#" rel="<?php echo $row_event['userID']; ?>" >Edit</a>
                       <textarea class="form-control hideInputMessage<?php echo $row_event['userID']; ?> hideMessage" name="textMessage" placeholder="Enter the text message or Instruction you want to show to the user who regeisterd successfully to your event. Eg: Thankyou for Registering, we will contact you soon for next details" /><?php echo $row_event['textMessage']; ?></textarea>
                 </div>
               </div>
               
               <div class="hideInfo hideHome" id="onfoBtn">
                   <input type="submit" value="Save" class="eventSubmit  form-control floatright btn btn-primary btn-xs btn-rect "  />
                 </form>
          	   </div>
               &nbsp;
               <div id="saveEvent"></div>
               
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="compInfo" />
            <input type="hidden" name="eventID" value="<?php echo $row_event['eventID']; ?>" />
            <div class="text_area_home hideComp">
               <div class="left-margin ">
                <h3>Add Competition: <small class="font">Add competitions that will be available in your event</small>
                       <div class="floatright"><a href="#" class="clickFee">View </a> | <a class="showCompField" href="#" rel="<?php echo $row_event['userID']; ?>">Add</a></div>
                </h3>
                <h3 style="display:flex; text-align:right">
                       <input type="text" class="form-control hideInputComp<?php echo $row_event['userID']; ?> hideComp" name="compName" placeholder="Competition Name" value="<?php echo $row_event['compName']; ?>" style="width:49%; display:inline-table" />
                       <input type="text" class="form-control hideInputCompFee<?php echo $row_event['userID']; ?> hideCompFee" name="compFee" placeholder="Competition Fee" value="<?php echo $row_event['compFee']; ?>" style="width:49%;display:inline-table"/>
                       <input type="submit" value="Save" class="eventSubmit floatright btn btn-primary btn-xs btn-rect hideInputCompFee<?php echo $row_event['userID']; ?> hideCompFee"/>
                </h3>
                </div>
            </div>
           </form>
           
         <div class="text_area_home hideHome hideFee">
            <div class="left-margin ">
                   <?php 
				$fee_query=mysqli_query($dbconfig,"SELECT * FROM comp_fee WHERE userID='".$_SESSION['userid']."'");
				$count_fee_data=mysqli_num_rows($fee_query);
				if ($count_fee_data == 0) { echo 'Data Not Available';}else {
				while($fee_row=mysqli_fetch_assoc($fee_query)){
		  		?>
               <div class="hideFee"> <?php echo $fee_row['compName']; ?>: <small class="font"> &#8377 <?php echo $fee_row['compFee']; ?></small>
                <div class="floatright"><small class="feeTime">
                  <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $fee_row['compAddTime'] ). " ago"; ?>
                  </small> | <a class="editFee showCourseFee" href="#" rel="<?php echo $fee_row['compEID']; ?>">Edit</a> | <a class="editFee confirmDelete" href="delete.php?xAction=deleteFee&deleteItem=<?php echo $fee_row['cf_ID']; ?>">Delete</a> </div>
                </div>
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="xAction" value="updateEventFee" />
                <input type="hidden" name="compEID" value="<?php echo $fee_row['compEID']; ?>" />
                <input type="text" class="form-control hideInputCourseName1<?php echo $fee_row['compEID']; ?> hideCourseName1" name="compName" value="<?php echo $fee_row['compName']; ?>" style="width:35%; display:inline-table" />
                <input type="text" class="form-control hideInputCourseFee1<?php echo $fee_row['compEID']; ?> hideCourseFee1" name="compFee" value="<?php echo $fee_row['compFee']; ?>" style="width:35%;display:inline-table"/>
                <input type="submit" value="Save" class="eventSubmit hideInputCourseFee1<?php echo $fee_row['compEID']; ?> hideCourseFee1  floatright btn btn-primary btn-xs btn-rect"  />
              </form>
                   <?php  }} ?>
              </div>
          </div>
          
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
			WHERE events.eventID='".$_REQUEST['eventID']."' ORDER BY epID DESC LIMIT $start,$limit");
			$countUpload=mysqli_num_rows($sqlUpload);
			
			if($countUpload ==0){ 
			echo '<div class="text_area_home hideHome">
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
                	<?php $str=$rowUpload['eventTextPost']; if(strlen($str)>=101){echo substr($str,0,100).'...';}else echo $str; ?></p>
                   <span class="more_text<?php echo $rowUpload['epID']; ?> hideAll">
              		<p><?php echo $rowUpload['eventTextPost']; ?></p>
             	   </span> 
           </div>
            <a class="readmore showMore content" rel="<?php echo $rowUpload['epID']; ?>" href="#" style="float:right">read more</a> <a class="readmore hideMore" rel="<?php echo $rowUpload['epID']; ?>" href="#" style="float:right">hide more</a> 
            </div>
			   <?php }} ?>
             
        <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM user LEFT JOIN event_posts ON user.userID=event_posts.userID 
			LEFT JOIN events ON event_posts.eventID=events.eventID
			WHERE events.eventID='".$_REQUEST['eventID']."' ORDER BY epID DESC"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
<div style="display:flex;">
<?php if($epID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='myEvent.php?epID=".($epID-1)."&eventID=".($_REQUEST['eventID'])."' class='popular_more hideHome'> prev </a>";
}
if($epID!=$total){
if($rows >0)
{
	////Go to previous page to show next 10 items.
	echo "<a href='myEvent.php?epID=".($epID+1)."&eventID=".($_REQUEST['eventID'])."' class='popular_more hideHome' >more</a>";
}

}
?>
</div> 
             </div>
      		</div>
           <?php include 'midRightbar.php'; ?>
     		</div>
         </div>
    	<?php include 'rightbar.php'; ?>
        <?php include 'footer.php'; ?>
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
<script>
			$(".eventSubmit").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertEvent.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("saveEvent").innerHTML=response; 
				<?php include 'autoload.php'; ?>
 		}
 		}); });
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
							
			$("input.hideContact").hide();
			$("a.showContactField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputContact"+userID).toggle(500);
			return false;	
			});
			$(".hideWebname").hide();
			$("a.showWebnameField").click(function(){
			var userID= $(this).attr('rel');
			$(".hideInputWebname"+userID).toggle(500);
			return false;	
			});
			$(".hideMessage").hide();
			$("a.showMessageField").click(function(){
			var userID= $(this).attr('rel');
			$(".hideInputMessage"+userID).toggle(500);
			return false;	
			});
			
			$("input.hideComp,input.hideCompFee").hide();
			$("a.showCompField").click(function(){
			var userID= $(this).attr('rel');
			$("input.hideInputComp"+userID).toggle(500);
			$("input.hideInputCompFee"+userID).toggle(500);
			
			return false;	
			});
			
			$("input.hideCourseName1,input.hideCourseFee1").hide();
			$("a.showCourseFee").click(function(){
			var compEID= $(this).attr('rel');
			$("input.hideInputCourseName1"+compEID).toggle(500);
			$("input.hideInputCourseFee1"+compEID).toggle(500);
			return false;	
			});
			
});
        </script>
<script>
     		$(document).ready(function(){
  			$("#blutThis").focus(function(){
   			$("div").addClass("blur");
   			$('#hide').parents().removeClass("blur");
    		$('#unblur').removeClass("blur");
			$('#unblur').parents().removeClass("blur");
    		$('#unblur').removeClass("blur");
			$('#unblur').removeClass("blur");
 			}).blur(function(){
     		$("div").not('#unblur').removeClass("blur");
  			});
			});
     </script>
     