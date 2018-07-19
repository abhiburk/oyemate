<?php 
require 'config.php';
$searchVal=$_REQUEST['searchVal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Hostel : Oyemate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="web/assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="web/assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="web/assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="web/assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="web/assets/css/jquery.bxslider.css" media="screen" />
<script type="text/javascript" src="web/assets/js/jquery-min.js"></script>
<script type="text/javascript" src="web/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="web/assets/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="web/assets/js/selectnav.min.js"></script>
</head>
<body>
<div class="body_wrapper">
  <?php include 'homeheader.php'; ?>
  <div class="center">
    <div class="content_area">
      <div class="main_content floatright "> </div>
      <?php include 'loginRegister.php'; ?>
      <!--Hostel-->
      
     
     <div class="col_home_25 floatleft  ">
       <div id="registersuccess"></div>
        <div class="text_area_home" id="grey_head">
          <p class="grey_head">Add a Hostel</p>
        </div>
        <div class="text_area_home">
          <form method="post" id="form" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="addHostel" />
            <input type="text" class="form-control" name="hostelName" placeholder="Hostel Name/Your Name" required/><br />
            <input type="text" class="form-control" name="hostelContact" placeholder="Mobile No." required/><br />
            <input type="text" class="form-control" name="hostelEmail" placeholder="Email-ID." required/><br />
            <select name="nearCollege" class="form-control" required>
              <option value="">Select Near College</option>
              <?php $sql_college=mysqli_query($dbconfig,"SELECT * FROM colleges");
  				while($row_college=mysqli_fetch_assoc($sql_college)){ ?>
              <option value="<?php echo $row_college['collegeID']; ?>"><?php echo $row_college['instituteName']; ?></option>
              <?php } ?>
            </select>
            <br/>
            <select name="hostelFor" class="form-control" required>
              <option value="">Select Hostel For</option>
              <option value="boys">Boys</option>
              <option value="girls">Girls</option>
              <option value="both">Both</option>
            </select>
            <br />
            <select name="hostelType" class="form-control" required>
              <option value="">Select Type of Hostel</option>
              <option value="appartment">Appartment</option>
              <option value="singleroom">Single Room</option>
              <option value="other">Other</option>
            </select>
            <br />
            <textarea class="form-control" name="hostelAddress" placeholder="Address of your Hostel" required></textarea><br/>
            <input type="submit" value="Register Hostel" class="registerHostel floatright  btn btn-primary btn-xs btn-rect"  />
          </form>
          <script>
		  $(document).ready(function(){
			$(".registerHostel").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "web/insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("registersuccess").innerHTML=response; 
				<?php include 'web/autoload.php'; ?> 
 		}
 		}); }); });  
		</script> 
        </div>
      </div>
      <div class="col_home_50 floatleft">
      
        <div class="text_area_home" id="grey_head">
          <p class="grey_head">Hostels</p>
        </div>
        <div class="scroll_hostel">
        <?php 
			  			 
			  $sql_hostel=$conn->prepare("SELECT * FROM hostel LEFT JOIN colleges ON hostel.nearCollege=colleges.collegeID
			  WHERE (hostelName LIKE :searchVal OR nearCollege LIKE :searchVal OR hostelFor LIKE :searchVal
			  OR hostelType LIKE :searchVal OR hostelAddress LIKE :searchVal) ORDER BY hostelID DESC ");
    		  $sql_hostel->bindValue(':searchVal','%'.$searchVal.'%'); 
   			  $sql_hostel->execute();
			  $countSearch=$sql_hostel->rowCount();
			  if($countSearch==0)  {echo 'No Record Found'; }else {
    		  while($row_hostel =$sql_hostel->fetch(PDO::FETCH_ASSOC)) { 	  
		?>
        <div class="text_area_home"> 
        	<div class="single_cat_left_content floatleft">
              <h3><?php echo $row_hostel['hostelName']; ?> </h3>
              <p><b>Address: </b><?php echo $row_hostel['hostelAddress'];   ?></p>
             <div class="flex"> 
              <p><b>Hostel Type: </b><?php echo $row_hostel['hostelType'];   ?></p> &nbsp;
              <p><b>Hostel For: </b><?php echo $row_hostel['hostelFor'];   ?></p>
             </div> 
             <p><b>Nearest College: </b><?php echo $row_hostel['instituteName'];   ?></p>
              <p class="single_cat_left_content_meta">Mobile: <span> <?php echo $row_hostel['hostelContact'];   ?></span> |  
               <?php echo "" . humanTiming( $row_hostel['hostelAddTime'] ). " ago"; ?> |
               <!--<ul> 
                 <li>
                    <?php 
						  //$sql = mysqli_query($dbconfig,"SELECT * FROM hostel_rating
						  //WHERE hostelID ='".$row_hostel['hostelID']."' AND non_userID = '".$_SERVER['REMOTE_ADDR']."'");
    					  //$row = mysqli_fetch_assoc($sql);
					?>
                    <h4>
                      <fieldset id='demo1' class="rating" style=" margin-top: -25px;" >
                        <input type="hidden" name="xAction" id="xAction" value="hostelRate" />
                        <input  type="hidden" name="hostelID" value="<?php echo $row_hostel['hostelID']; ?>" />
                        <input class="stars" type="radio" id="star5" name="rating" value="5"<?php if($row['rating'] == '5'){ echo 'checked';}?> />
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4"<?php if($row['rating'] == '4'){ echo 'checked';}?> />
                        <label class = "full" for="star4" title="Pretty Good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3"<?php if($row['rating'] == '3'){ echo 'checked';}?>/>
                        <label class = "full" for="star3" title="Average - 3 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2"<?php if($row['rating'] == '2'){ echo 'checked';}?> />
                        <label class = "full" for="star2" title="Kinda Bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1"<?php if($row['rating'] == '1'){ echo 'checked';}?> />
                        <label class = "full" for="star1" title="Very Bad time - 1 star"></label>
                      </fieldset>
                    </h4>
                  </li>
                </ul>-->
              </p>
            </div>
        </div>
        <?php }} ?>
        		   <script>          
					  		$(document).ready(function () {
                             $(".rating").on('click','input[type="radio"]', function (){
                                var val1 = $(this).siblings('input[name="hostelID"]').val();
                                var val2 = $(this).siblings('input[name="xAction"]').val();
								console.log(val1); 
                                $.post('web/rating.php',{rating:$(this).val(),hostelID:val1,xAction:val2},function(d){
									
                                    if(d>0)
                                    {
                                        alert('You Already Rated');
                                    }else{
                                        alert('Thanks For Rating');
                                    }
                                });
                                $(this).attr("checked");
                            });
                        });
                    </script>
      </div>
     </div>
    </div>


  </div>
</div>
						
</body>
</html>