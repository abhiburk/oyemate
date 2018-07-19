<?php require '../config.php'; 
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
		$query=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID ='".$_SESSION['userid']."' ");
		($uploadBy=mysqli_fetch_array($query));
		//$uploadby=$uploadby['userName'];
		echo $uploadby['userName']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Home : Oyemate</title>
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
        <div class="left_coloum floatleft">
          <?php 	
			if(isset($_GET['fileSuccess']) && $_GET['fileSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0C0;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">File Uploaded Successfully </h3>
          </div>
          <?php } ?>
          <?php 	
			if(isset($_GET['fileFailed']) && $_GET['fileFailed'] == 1) { ?>
          <div id="fade" style="background-color:#F00;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Failed to Upload file </h3>
          </div>
          <?php } ?>
          <div id="updateupload"></div>
          
          <div class="text_area_home" id="hide ">
            <form action="uploadFile.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="uploadFile" />
              <textarea class="form-control" name="detail" placeholder="Upload File" required ></textarea>
              <div class="text_area_button" id="hide1">
                <div class="fileupload fileupload-new" data-provides="fileupload" id="hide2"> <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"> </span> <span class="btn btn-file btn btn-xs btn-primary" >  <span class="fileupload-new">Select File</span> <span class="fileupload-exists" >Change</span>
                  <input type="file" name="uploadDoc"/>
                  </span>
                  <input class="btn btn-file btn btn-xs btn-primary"  type="submit" value="Post">
                </div>
              </div>
              <!--<select name="uploadTag" class='form-control' style="width:25%; margin-right:10px; margin-top:5px" required >
                <option value="" >Tag</option>
                <?php $sqlTag=mysqli_query($dbconfig,"SELECT * FROM upload_catagory ORDER BY uploadTag ASC "); 
				 while($rowTag=mysqli_fetch_assoc($sqlTag)) {?>
                <option><?php echo $rowTag['uploadTag']; ?></option><?php } ?>
              </select>-->
            </form>
          </div>
          <script>
     		$(document).ready(function(){
  			$(".form-control").focus(function(){
   			$("div").addClass("blur");
   			$('#hide').parents().removeClass("blur");
    		$('#hide').removeClass("blur");
			$('#hide1').parents().removeClass("blur");
    		$('#hide1').removeClass("blur");
			$('#hide2').removeClass("blur");
 			}).blur(function(){
     		$("div").not('#hide').removeClass("blur");
  			});
			});
     </script>
<?php
$start=0;
$limit=5;
if(isset($_GET['uid'])){
	$uploadID=$_GET['uid'];
	$start=($uploadID-1)*$limit;}
else{ $uploadID=1; }
?>		
		
        <div class="text_area_home" style="background-color:#0C0;">
        		<p class="grey_head" style="color:#FFF">Welcome to oyemate <?php echo $user['userName']; ?>, Once everybody gets involved to this small community 
                it will explore much more than this.Till then one can upload anything here for permanent use.</p>
        </div>
        
          <div class="single_left_coloum_wrapper ">
            <h2 class="title">Content upload</h2>
            <a class="more toggleOne" href="#">Toggle</a>
            
            <?php 
			$sqlUpload=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
			WHERE branchName='".$branchName."' AND instituteName='".stripslashes(mysql_real_escape_string($instituteName))."' 
			ORDER BY uploadID DESC LIMIT $start,$limit");
			$countUpload=mysqli_num_rows($sqlUpload);
			if($countUpload ==0){ echo '<div class="text_area_home hideHome">
			<div class="left-margin">
			<h3>No Uploaded Content Available </h3></div></div>'; }else {
			while($rowUpload=mysqli_fetch_assoc($sqlUpload)){
			?>
            <div class="text_area_home hideHome">
              <div class="left-margin">
                <h3> <a class="content" href="user/<?php echo $rowUpload['userID']; ?>"> <?php echo $rowUpload['userName']; ?></a>
                  <div style="float:right; display:inline-block; font-size:11px;font-weight: normal;"> <?php echo "" . humanTiming( $rowUpload['uploadTime'] ). " ago"; ?> </div>
                </h3>
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <a href="<?php echo '../uploads/'.$rowUpload['uploadDoc']; ?>"><img src="<?php echo '../uploads/'.$rowUpload['uploadDoc']; ?>" class="img-responsive timelineImg" onerror="this.style.display='none'"/></a>
                <?php } ?>
                <p class="hideDetail<?php echo $rowUpload['uploadID']; ?> hideAll">
                  <?php $str=htmlspecialchars($rowUpload['detail']); if(strlen($str)>=101){ echo substr($str,0,100).'...';}else {echo $str; }?>
                   </p>
                   
                  <p><form class="updateForm hideFormName<?php echo $rowUpload['uploadID']; ?> hideName" method="post" enctype="multipart/form-data"/>
                  <input type="hidden" name="uploadID" value="<?php echo $rowUpload['uploadID']; ?>" />
                  <input type="hidden" name="xAction" value="updateupload" />
                  <div style="display:flex;">
                	<textarea class="form-control1" name="detail" style="height:50px;"> <?php echo $rowUpload['detail']; ?></textarea>
                	<input type="submit" value="Update" class=" updateupload btn btn-file btn btn-xs btn-primary" /></div>
                  </form></p>
               
                <span class="more_text<?php echo $rowUpload['uploadID']; ?> hideAll">
                <p><?php echo htmlspecialchars($rowUpload['detail']); ?></p>
                <span class="miscs">
                <?php $download_query=mysqli_query($dbconfig,"SELECT * FROM download LEFT JOIN user ON download.userID=user.userID 
					  WHERE uploadID=$rowUpload[uploadID] ORDER BY downloadID DESC");
					  $count_download=mysqli_num_rows($download_query);
					  $downloadby=mysqli_fetch_assoc($download_query);
					  if($count_download !=0){ 
                	  if($rowUpload['uploadDoc']!='') { ?>
                <h3>Last Downloaded: <?php echo $downloadby['userName']; ?> | &nbsp;</h3>
                <?php }}?>
                </span><br/>
                </span> <span class="miscs">
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <h3 class="content" > Downloaded: <?php if($rowUpload['downloadCount']==''){echo '0';}else {echo $rowUpload['downloadCount'];} ?> | &nbsp;</h3>
                <?php } ?>
                </span>
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <h3><a class="content" title="<?php echo $rowUpload['uploadDoc']; ?>" href="download.php?fileDetail=<?php echo $rowUpload['uploadDoc']?> &uploadID=<?php echo $rowUpload['uploadID']?>"> Download
                  <?php $str=htmlspecialchars($rowUpload['uploadDoc']); if(strlen($str)>=25){ echo substr($str,0,30).'...';}else{echo $str; }?></a>
                 </h3>
                <?php } ?>
                 <?php if(($_SESSION["userid"]==$rowUpload['userID']) ) {?>
                <div class="floatright ">
                <a href="#" class="content font-set editUpload" rel="<?php echo $rowUpload['uploadID']; ?>" >Edit</a> | <a href="delete.php?xAction=deleteupload&uID=<?php echo $rowUpload['uploadID']; ?>" class=" confirmDelete content font-set deleteUpload" >Delete</a>
                </div><?php } ?>
                <a class="readmore showMore font-set content floatright" rel="<?php echo $rowUpload['uploadID']; ?>" href="#" >read more</a> <a class="readmore hideMore" rel="<?php echo $rowUpload['uploadID']; ?>" href="#" style="float:right">hide more</a> 
                
                </div>
                
            </div>
            <?php } ?>
            
            <script>
            $(".updateupload").click(function(e) {
            e.preventDefault();
			 var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php?xAction=updateupload",
				data:formData,
 				success: function (response) {
  				document.getElementById("updateupload").innerHTML=response; 
 		}
 		}); });
            </script>
            <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
WHERE branchName='".$branchName."' AND instituteName='".$instituteName."' ORDER BY uploadID DESC"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
            <?php if($uploadID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='?uid=".($uploadID-1)."' class='popular_more hideHome'> prev </a>";
}
if($uploadID!=$total)
if($rows >0){
{
	////Go to previous page to show next 10 items.
	echo "<a href='?uid=".($uploadID+1)."' class='popular_more hideHome' >more</a>";
}
}
			}
?>
</div>
          <script>
$(document).ready(function(){
	$("form.updateForm").hide();
			$("a.editUpload").click(function(){
			var uploadID= $(this).attr('rel');
			$("form.hideFormName"+uploadID).toggle(500);
			$("p.hideDetail"+uploadID).toggle(500);
			return false;	
			});
			$("span.hideAll").hide();
			$("a.hideMore").hide();
		$("a.showMore").click(function(){
			$("a.hideMore").show();	
			$("a.showMore").hide();
			var uploadID= $(this).attr('rel');
			$("p.hideDetail"+uploadID).toggle(500);
			$("span.more_text" +uploadID).toggle(1000);
			return false;	
		});
		$("a.hideMore").click(function(){
			$("a.hideMore").hide();	
			$("a.showMore").show();
			var uploadID= $(this).attr('rel');
			$("p.hideDetail"+uploadID).toggle(500);
			$("span.more_text" +uploadID).toggle(1000);
			return false;	
		});
		$("a.toggleOne").click(function(){
			$(".hideHome").toggle(500);
			return false;	
		});
});
        </script> 
        </div>
        <?php include 'midRightbar.php'; ?>
        </div>
      </div>
      <?php include 'rightbar.php'; ?>
    <?php include 'footer.php'; ?>
  </div>
</div>
<script type="text/javascript">
selectnav('nav', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
selectnav('f_menu', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
$('.bxslider').bxSlider({
    mode: 'fade',
    captions: true
});
</script>
</body>
</html>
<!--<script type="text/javascript">
$(document).ready(function() {
	$("#results" ).load( "fetchData.php"); //load initial records
	
	//executes code below when user click on pagination links
	$("#results").on( "click", ".pagination a", function (e){
		e.preventDefault();
		$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
		$("#results").load("fetchData.php",{"page":page}, function(){ //get content from PHP page
			$(".loading-div").hide(); //once done, hide loading element
		});
		
	});
});
</script>
         <div class="loading-div"><img src="paging/ajax-loader.gif" ></div>
<div id="results"><!-- content will be loaded here </div>-->