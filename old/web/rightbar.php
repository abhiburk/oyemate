<?php
$start=0;
$limit=5;
if(isset($_GET['cID'])){
	$collegeID=$_GET['cID'];
	$start=($collegeID-1)*$limit;}
else{ $collegeID=1; }
?>

<div class="sidebar floatright grey">
  <div class="single_right_coloum ">
    <div class="popular">
      <h2 class="title">Popular Colleges</h2>
      <a class="more togglePopular" href="#">Toggle</a>
      <ul>
        <?php 
			$sql_popular=mysqli_query($dbconfig,"SELECT * FROM colleges
			ORDER BY views DESC,ratingCount DESC LIMIT $start, $limit");
			while($rowPopular=mysqli_fetch_assoc($sql_popular)){
			?>
       
        <script>          
					  		$(document).ready(function () {
							$("a.colgID").click(function(){
                            var value = $("#colgID").val();
							url:'collegeprofile.php?instituteName='+value 
                        }); });
						
                    </script>
        <div class="text_area_home popularColg">
            <li>
              <h3>
              <a class="colgID" href="collegeprofile/<?php echo $rowPopular['instituteName']; ?>"><?php echo $rowPopular['instituteName'] ?></a>
              <?php if($rowPopular['collegeWebsite']=='') { echo '<h5>Website:Not Available</h5>'; } else {?>
              <h5><a class="lower" href="http://<?php echo $rowPopular['collegeWebsite']; ?>" ><?php echo $rowPopular['collegeWebsite']; ?></a></h5>
              <?php } ?>
              <p>
                <?php 
					   $sql = mysqli_query($dbconfig,"SELECT AVG(rating) as rating_avg FROM college_rating WHERE collegeID='".$rowPopular['collegeID']."'");
						while($row = mysqli_fetch_assoc($sql)){
					?>
              <div class="star" style="margin-top:5px;">
                <h3>
                  <?php if($rowPopular['views']=='') { echo ''; } else {?>
                  <i class="glyphicon glyphicon-eye-open"></i> <?php echo $rowPopular['views']; ?>
                  <?php } ?>
                  <?php if($rowPopular['collegeCode']=='') { echo ''; } else {?>
                  | Code: <?php echo $rowPopular['collegeCode']; ?>
                  <?php } ?>
                </h3>
              </div>
              <h3>
                <fieldset id='demo2' class="rating1">
                  <input class="stars" type="radio" id="star55" value="5"<?php if(round($row['rating_avg']) == '5'){ echo 'checked';}?> />
                  <span class = "full1" for="star5" title="Awesome - 5 stars"></span>
                  <input class="stars" type="radio" id="star44" value="4"<?php if(round($row['rating_avg']) == '4'){ echo 'checked';}?> />
                  <span class = "full1" for="star4" title="Pretty Good - 4 stars"></span>
                  <input class="stars" type="radio" id="star33" value="3"<?php if(round($row['rating_avg']) == '3'){ echo 'checked';}?>/>
                  <span class = "full1" for="star3" title="Average - 3 stars"></span>
                  <input class="stars" type="radio" id="star22" value="2"<?php if(round($row['rating_avg']) == '2'){ echo 'checked';}?> />
                  <span class = "full1" for="star2" title="Kinda Bad - 2 stars"></span>
                  <input class="stars" type="radio" id="star11" value="1"<?php if(round($row['rating_avg']) == '1'){ echo 'checked';}?> />
                  <span class = "full1" for="star1" title="Very Bad time - 1 star"></span>
                </fieldset>
              </h3>
              <?php } ?>
              </p>
              <!--<a href="#" class="readmore">Read More</a>--> 
            </li>
          </div>
        <?php } ?>
      </ul>
      <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM colleges "));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
      <?php if($collegeID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='home.php?cID=".($collegeID-1)."' class='popular_more popularColg '> prev </a>";
}
if($collegeID!=$total)
if($rows!=''){
{
	////Go to previous page to show next 10 items.
	echo "<a href='home.php?cID=".($collegeID+1)."' class='popular_more popularColg' >more</a>";
}
}
?>
    </div>
  </div>
  <?php
$start=0;
$limit=5;
if(isset($_GET['coachID'])){
	$ci_ID=$_GET['coachID'];
	$start=($ci_ID-1)*$limit;}
else{ $ci_ID=1; }
?>
  <div class="single_right_coloum ">
    <div class="popular">
      <h2 class="title">Popular Coachings</h2>
      <a class="more toggleCoaching" href="#">Toggle</a>
      <ul>
        <?php 
			$sql_popular=mysqli_query($dbconfig,"SELECT * FROM coaching_institute LEFT JOIN user ON coaching_institute.userID=user.userID
			WHERE branchName='".$branchName."' AND user.branchName='".$branchName."' OR user.branchName='Mathematics'
			ORDER BY ci_views DESC,ci_ratingCount DESC LIMIT $start, $limit");
			while($rowPopular=mysqli_fetch_assoc($sql_popular)){
			?>
        <div class="text_area_home popularCoach">
            <li>
              <h3><a class="colgID" href="coaching/<?php echo $rowPopular['ci_ID']; ?>"><?php echo $rowPopular['instituteName'] ?></a> </h3>
              <?php if($rowPopular['ci_Address']=='') { echo '<h5><small>Address:Not Available</small></h5>'; } else {?>
              <h5><small><?php echo $rowPopular['ci_Address']; ?></small></h5>
              <?php } ?>
              <p>
                <?php 
					   $sql = mysqli_query($dbconfig,"SELECT AVG(ci_rating) as rating_avg FROM coaching_institute_rating WHERE ci_ID='".$rowPopular['ci_ID']."'");
						while($row = mysqli_fetch_assoc($sql)){
					?>
              <div class="star" style="margin-top:5px;">
                <h3> <small>
                  <?php if($rowPopular['ci_Contact']=='') { echo ''; } else {?>
                  Contact: <?php echo $rowPopular['ci_Contact']; ?> |
                  <?php } ?>
                  <?php if($rowPopular['ci_views']=='') { echo ''; } else {?>
                  <i class="glyphicon glyphicon-eye-open"></i> <?php echo $rowPopular['ci_views']; ?> </small></h3>
                <?php } ?>
              </div>
              <h3>
                <fieldset id='demo2' class="rating1">
                  <input class="stars" type="radio" id="star55" value="5"<?php if(round($row['rating_avg']) == '5'){ echo 'checked';}?> />
                  <span class = "full1" for="star5" title="Awesome - 5 stars"></span>
                  <input class="stars" type="radio" id="star44" value="4"<?php if(round($row['rating_avg']) == '4'){ echo 'checked';}?> />
                  <span class = "full1" for="star4" title="Pretty Good - 4 stars"></span>
                  <input class="stars" type="radio" id="star33" value="3"<?php if(round($row['rating_avg']) == '3'){ echo 'checked';}?>/>
                  <span class = "full1" for="star3" title="Average - 3 stars"></span>
                  <input class="stars" type="radio" id="star22" value="2"<?php if(round($row['rating_avg']) == '2'){ echo 'checked';}?> />
                  <span class = "full1" for="star2" title="Kinda Bad - 2 stars"></span>
                  <input class="stars" type="radio" id="star11" value="1"<?php if(round($row['rating_avg']) == '1'){ echo 'checked';}?> />
                  <span class = "full1" for="star1" title="Very Bad time - 1 star"></span>
                </fieldset>
              </h3>
              <?php } ?>
              </p>
              <!--<a href="#" class="readmore">Read More</a>--> 
            </li>
          </div>
       
        <?php } ?>
      </ul>
      <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM coaching_institute LEFT JOIN user ON coaching_institute.userID=user.userID
			WHERE branchName='".$branchName."' "));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
      <?php if($ci_ID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='home.php?coachID=".($ci_ID-1)."' class='popular_more popularCoach'> prev </a>";
}
if($ci_ID!=$total)
if($rows!=''){
{
	////Go to previous page to show next 10 items.
	echo "<a href='home.php?coachID=".($ci_ID+1)."' class='popular_more popularCoach' >more</a>";
}
}
?>
    </div>
  </div>
 <!-- <div class="single_sidebar"> <a href="ad"><img src="../images/ad.jpg" alt="" /></a> </div>-->
 
  <div class="single_sidebar">
  <div id="improvesuccess"></div>
    <div class="news-letter">
      <h2>Improve Us</h2>
      <p>Help us to improve in our community</p>
      <form action="insertData.php" method="post">
      <input type="hidden" name="xAction" value="improveus" />
      <input type="text" disabled="disabled" class="form-control" id="name" placeholder="<?php echo $user['userName']; ?>" style="text-transform:capitalize;" />
        <textarea name="improveMessage" id="improve" placeholder="Your Message Here" ></textarea>
        <input type="submit" value="SUBMIT" class="improve btn btn-file btn btn-xs btn-primary" />
      </form>
      <p class="news-letter-privacy"> We value your words!</p>
    </div>
  </div>
  <!--<div class="single_sidebar"> <img src="images/add1.png" alt="" /> </div>
  <div class="single_sidebar">
    <h2 class="title">ADD</h2>
    <img src="images/add2.png" alt="" /> </div>-->
</div>
</div>
<script>
			$(".improve").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
					console.log(response);
  				document.getElementById("improvesuccess").innerHTML=response; 
 		}
 		}); });
		</script> 
        <?php if(isset($_GET['cID'])==true){ ?>
<script>
	 		$(document).ready(function(){
			$(".popularColg").show();
			$("a.togglePopular").click(function(){
			$(".popularColg").toggle(500);
			return false;	
			});});
     	</script>
        <?php }else { ?>  <script>
	 		$(document).ready(function(){
			$(".popularColg").hide();
			$("a.togglePopular").click(function(){
			$(".popularColg").toggle(500);
			return false;	
			});});
     	</script>
        <?php } ?>
				<script>			
    					
						$("a.toggleCoaching").click(function(){
						$(".popularCoach").toggle(500);
						return false;	
						});
    		   </script> 
