<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
$start=0;
$limit=2;
if(isset($_GET['userID'])){
	$userID=$_GET['userID'];
	$start=($userID-1)*$limit;}
else{ $userID=1; }
?>
<div class="text_area_home inline">
          <?php $sql_mm=mysqli_query($dbconfig,"SELECT * FROM user LIMIT $start,$limit") or (mysqli_error($dbconfig));
		  		while($row_match=mysqli_fetch_assoc($sql_mm)){
				 ?>
          <div class=" matchImg">
          <a href="#" ><img src="<?php echo '../uploads/'.$row_match['userImg']; ?>" class="userImg img-responsive timelineImg" alt="" /></a>
          <p><?php echo $row_match['userName']; ?></p>
          </div>
          <?php } ?> 
          </div> 
          <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM user"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
            <?php if($userID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='#' class='popular_more hideHome clickMatch' rel='".($userID-1)."'> prev </a>";
}
if($userID!=$total)
if($rows >0){
{
	////Go to previous page to show next 10 items.
	echo "<a href='#' class='popular_more hideHome clickMatch' rel='".($userID+1)."'>more</a>";
}
}
?>
<script>
 $(document).ready(function(){
	 
	 $(".clickMatch").click(function(e) {
				 e.preventDefault();
			//var userID= $(this).attr('rel');
            $.ajax({
                type: "GET",
                url: "fetchMatch.php",
				data: { userID: this.rel },
 				success: function (response) {
  				document.getElementById("fetchmate").innerHTML=response; 
 		}
 		}); });
});
</script> 