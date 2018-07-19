<?php require '../config.php'; 
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
$searchVal=mysql_real_escape_string($_REQUEST['searchVal']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Search Result : Oyemate</title>
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
        
        
             <?php if($searchVal=='') {echo '<div class="text_area_home"><p align="center">Please enter you search keyword </p></div>';} else { ?>
       
        <!--Counting Search Results-->
        <?php  $sql_search_user=mysqli_query($dbconfig,"(SELECT * FROM user WHERE userName LIKE '%".$searchVal."%' OR instituteName LIKE '%".$searchVal."%' OR branchName LIKE '%".$searchVal."%')")  or die (mysqli_error($dbconfig));
				$check_search_user=mysqli_num_rows($sql_search_user);
				$sql_search_college=mysqli_query($dbconfig,"(SELECT * FROM colleges WHERE instituteName LIKE '%".$searchVal."%' OR collegeAddress LIKE '%".$searchVal."%')") or die (mysqli_error($dbconfig));
				$check_search_college=mysqli_num_rows($sql_search_college);
				$sql_search_coach=mysqli_query($dbconfig,"(SELECT * FROM coaching_institute WHERE instituteName LIKE '%".$searchVal."%' OR ci_Address LIKE '%".$searchVal."%' )") or die (mysqli_error($dbconfig));
				$check_search_coach=mysqli_num_rows($sql_search_coach);
				$sql_search_event=mysqli_query($dbconfig,"(SELECT * FROM events LEFT JOIN user ON events.userID=user.userID WHERE eventName LIKE '%".$searchVal."%' OR webName LIKE '%".$searchVal."%')") or die (mysqli_error($dbconfig));
				$check_search_event=mysqli_num_rows($sql_search_event);
				$sqlUpload=mysqli_query($dbconfig,"SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID WHERE uploadDoc LIKE '%".$searchVal."%' OR detail LIKE '%".$searchVal."%' ORDER BY uploadID DESC") or die (mysqli_error($dbconfig));
				$check_uploadDoc=mysqli_num_rows($sqlUpload);
		
		?>
        
        
          <div class="text_area_home">
            <p align="center"> Search Result for: <b>"<?php echo $searchVal; ?>"</b> |
            Total Results Found: <b>"<?php echo $check_search_user + $check_search_college + $check_search_coach + $check_search_event; ?>"</b>
            </p>
          </div>
          <?php $sql_user=$conn->prepare("SELECT * FROM user 
				WHERE userName LIKE :searchVal OR instituteName LIKE :searchVal OR branchName LIKE :searchVal ");
    		    $sql_user->bindValue(':searchVal','%'.$searchVal.'%'); 
   			    $sql_user->execute();
			    $check_search_user=$sql_user->rowCount();
				if($check_search_user!=''){
  				while($search1=$sql_user->fetch(PDO::FETCH_ASSOC)){ ?>
                
                <!--User Results-->
                <div class="single_cat_right_content text_area_home">
                  <?php if($search1['userImg']=='') { 
                  echo '<img src="../images/default.jpg" class="friendImg"/>'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$search1['userImg']; ?>" class="friendImg"/><?php } ?>
                   <h3 class="font-set"><a href="user/<?php echo $search1['userID']; ?>"><?php echo $search1['userName']; ?></a>
                   <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top: 3px;"><?php echo $search1['company']; ?></p>
                  <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top:3px;"> 
                  <?php if($search1['company']== 'Coaching Staff') { ?>
                   <a href="coaching.php?instituteName=<?php echo $search1['instituteName']; ?>"><?php echo $search1['instituteName']; ?></a>
                   <?php }else { ?>
                   <a href="collegeprofile/<?php echo $search1['instituteName']; ?>"><?php echo $search1['instituteName']; ?></a>
                   <?php } ?>
                  </p></h3>
                </div><?php }} ?>
                
                
                <?php 
				$sql_colg=$conn->prepare("SELECT * FROM colleges 
				WHERE instituteName LIKE :searchVal OR collegeAddress LIKE :searchVal ");
    		    $sql_colg->bindValue(':searchVal','%'.$searchVal.'%'); 
   			    $sql_colg->execute();
			    $check_search_colg=$sql_colg->rowCount();
				if($check_search_colg!=''){
  				while($search1=$sql_colg->fetch(PDO::FETCH_ASSOC)){
					
				 ?>
                
                <!--College Result-->
                <div class="single_cat_right_content text_area_home">
                  <?php if($search1['collegePhoto']=='') { 
                  echo '<img src="../images/default.jpg" class="friendImg"/>'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$search1['collegePhoto']; ?>" class="friendImg"/><?php } ?>
                   <h3 class="font-set"><a href="collegeprofile/<?php echo $search1['instituteName']; ?>"><?php echo $search1['instituteName']; ?></a>
                   <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top: 3px;"><?php echo $search1['collegeWebsite']; ?></p>
                  <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top:3px;"> 
                  <?php echo $search1['collegeAddress']; ?>
                  </p></h3>
                </div><?php }} ?>
                
                <?php 
				$sql_coach=$conn->prepare("SELECT * FROM coaching_institute LEFT JOIN coaching_fee ON coaching_institute.ci_ID=coaching_fee.ci_ID
				WHERE instituteName LIKE :searchVal OR ci_Address LIKE :searchVal OR courseName LIKE :searchVal "); 
				$sql_coach->bindValue(':searchVal','%'.$searchVal.'%'); 
   			    $sql_coach->execute();
			    $check_search_coach=$sql_coach->rowCount();
				if($check_search_coach!=''){
  				while($search1=$sql_coach->fetch(PDO::FETCH_ASSOC)){
				 ?>
                
                <!--Coaching Result-->
                <div class="single_cat_right_content text_area_home">
                 <?php if($search1['ci_Photo']=='') { 
                  echo '<img src="../images/default.jpg" class="friendImg"/>'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$search1['ci_Photo']; ?>" class="friendImg"/><?php } ?>
                   <h3 class="font-set"><a href="coaching/<?php echo $search1['ci_ID']; ?>"><?php echo $search1['instituteName']; ?></a>
                   <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top: 3px;"><?php echo $search1['ci_Contact']; ?></p>
                  <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top:3px;"> 
                  <?php echo $search1['instituteName']; ?>
                  </p></h3>
                </div><?php }} ?>
                
                <?php 
				$sql_event=$conn->prepare("SELECT * FROM events
				LEFT JOIN user ON events.userID=user.userID
				WHERE eventName LIKE :searchVal OR webName LIKE :searchVal "); 
				$sql_event->bindValue(':searchVal','%'.$searchVal.'%'); 
   			    $sql_event->execute();
			    $check_search_event=$sql_event->rowCount();
				if($check_search_event!=''){
  				while($search1=$sql_event->fetch(PDO::FETCH_ASSOC)){
				
				 ?>
                
                 <!--Event Result-->
                <?php if($search1['eventName']!='') { ?>
                <div class="single_cat_right_content text_area_home">
                 <?php if($search1['eventPhoto']=='') { 
                  echo '<img src="../images/default.jpg" class="friendImg"/>'; } else{ ?>
                  <img src="<?php echo '../uploads/'.$search1['eventPhoto']; ?>" class="friendImg"/><?php } ?>
                   <h3 class="font-set"><a href="../event/<?php echo $search1['webName']; ?>"><?php echo $search1['eventName']; ?></a>
                   <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top: 3px;"><?php echo $search1['eventContact']; ?></p>
                  <p class="single_cat_right_content_meta" style="margin-left: 0; margin-top:3px;"> 
                 <a href="collegeprofile/<?php echo $search1['instituteName']; ?>"><?php echo $search1['instituteName']; ?></a>
                  </p></h3>
                </div><?php }}} ?>
                
                
                <?php 
				$sql_upload=$conn->prepare("SELECT * FROM upload LEFT JOIN user ON upload.userID=user.userID 
				WHERE uploadDoc LIKE :searchVal OR detail LIKE :searchVal ORDER BY uploadID DESC "); 
				$sql_upload->bindValue(':searchVal','%'.$searchVal.'%'); 
   			    $sql_upload->execute();
			    $check_search_upload=$sql_upload->rowCount();
				if($check_search_upload!=''){
  				while($rowUpload=$sql_upload->fetch(PDO::FETCH_ASSOC)){	
			?>
            <!--Search For Upload-->
            <div class="text_area_home hideHome">
              <div class="left-margin">
                <h3 class="font-set"> <a class="content" href="user/<?php echo $rowUpload['userID']; ?>"> <?php echo $rowUpload['userName']; ?></a>
                  <div style="float:right; display:inline-block;font-weight: normal;" > 
				  <?php echo "" . humanTiming( $rowUpload['uploadTime'] ). " ago"; ?> </div>
                </h3>
                <img src="<?php echo '../uploads/'.$rowUpload['uploadDoc']; ?>" class="img-responsive timelineImg" onerror="this.style.display='none'" />
                <p><?php echo $rowUpload['detail'];?></p>
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
                <h3 class="content" >Downloaded: <?php echo $rowUpload['downloadCount']; ?> | &nbsp;</h3>
                <?php } ?>
                </span>
                <?php if($rowUpload['uploadDoc']!='') { ?>
                <h3><a class="content" title="<?php echo $rowUpload['uploadDoc']; ?>" href="download.php?fileDetail=<?php echo $rowUpload['uploadDoc']?> &uploadID=<?php echo $rowUpload['uploadID']?>"> Download
                 <?php echo $rowUpload['uploadDoc']; ?></a></h3>
                <?php } ?>
                </div>
            </div>
            <?php }} ?>
                
                
                <?php if($check_search_user.''.$check_search_college.''.$check_search_coach.''.$check_search_event.''.$check_uploadDoc == 0){ 
       					echo '<b>No Record Found For Your Search " '.$searchVal.' "</b>';} 
						
		}?>

        </div>
        <?php include 'midRightbar.php'; ?>
        </div>
      </div>
      <?php include 'rightbar.php'; ?>
    <?php include 'footer.php'; ?>
  </div>
</div>
</body>
</html>
