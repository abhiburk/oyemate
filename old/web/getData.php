<?php
if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
    
    //Include database configuration file
    include('../config.php');
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 2;
    
    //get number of rows
    $queryNum = $dbconfig->query("SELECT COUNT(*) as postNum FROM matchmate");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
    
    //initialize pagination class
    $pagConfig = array('baseURL'=>'getData.php', 'totalRows'=>$rowCount, 'currentPage'=>$start, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = $dbconfig->query("SELECT * FROM matchmate LEFT JOIN user ON matchmate.userID=user.userID ORDER BY matchmate.userID ASC LIMIT $start,$limit");
    
    if($query->num_rows > 0){ ?>
    <div id="hified"></div>
        <div class="text_area_home inline" style="display: block;">
        <?php
            while($row = $query->fetch_assoc()){ 
			$Mixed[]=($row['userID']);
			$Text = json_encode($Mixed);
			$RequestText = urlencode($Text);
        ?>
       
        <form action="insertData.php" id="myform" method="post" enctype="multipart/form-data" style="display: flex;">
                <input type="hidden" name="xAction" value="hifi" >
                <input type="hidden" name="hifiWith[]" value="<?php echo $row['userID']; ?>" >
                <div class="matchImg box">
                  <div class="overlay">
                  <?php $match=mysqli_query($dbconfig,"SELECT * FROM user RIGHT JOIN hifi_user ON user.userID=hifi_user.hifiBy 
				  WHERE user.userID='".$_SESSION['userid']."' AND hifiTo='".$row['userID']."' ");
				  $matchCount=mysqli_num_rows($match);
				  $rowMatch=mysqli_fetch_assoc($match);
				  if($matchCount==true){ echo '<p style="color:#333;">Click Image to <b>NoHifi</b> this</p>'; }
				  else { echo '<p style="color:#333;">Click Image to <b>Hifi</b> this</p>';}
			?>
                  </div>
                  <div class="opacity">
                    <?php if($row['userImg']=='') {echo '<img src="../images/default.jpg" class="">';}else { ?>
                    <a href="#"<?php if($matchCount!=true) {echo'class="clickHifi"';}else {echo 'class="clickNoHifi"';}?> rel="<?php echo $row['userID']; ?>">
            <img src="<?php echo '../uploads/'.$row['userImg']; ?>" /></a>
                    <?php } ?>
                  </div>
                  <p><a href="userProfile/<?php echo $row['userID']; ?>"><?php echo $row['userName']; ?></a></p>
                </div>
                <?php } ?>
              </div>
              <?php echo $pagination->createLinks(); ?>
	<?php }} ?>
     
         <input type="submit" class="clickHifi" style="visibility:hidden;">
         </form>
           <script>
		
			$(document).on("click", ".clickHifi", function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
			var hifiTo = this.rel;
			var data_string = 'formData='+ formData +'&hifiTo='+ hifiTo;
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data:data_string ,
 				success: function (response) {
  				document.getElementById("hified").innerHTML=response; 
 		}
 		 });});
        </script> 
       
         <script>
			$(".clickNoHifi").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "insertData.php?xAction=unhifi",
				data:{hifiTo:this.rel},
 				success: function (response) {
  				document.getElementById("hified").innerHTML=response; 
 		}
 		}); });
		</script>
