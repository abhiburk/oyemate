<?php 
require 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Faq : Oyemate</title>
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
          <p class="grey_head">Your question here</p>
        </div>
        <div class="text_area_home">
          <form method="post" id="form" enctype="multipart/form-data">
            <input type="hidden" name="xAction" value="faq" />
            <input type="text" class="form-control" name="faqName" placeholder="Your Name" required/>
            <br />
            <input type="text" class="form-control" name="faqEmail" placeholder="Email-ID." required/>
            <br />
            <textarea class="form-control" name="question" placeholder="Your Question" required></textarea>
            <br/>
            <input type="submit" value="Send" class="askQuestion floatright  btn btn-primary btn-xs btn-rect"  />
          </form>
          <script>
		  $(document).ready(function(){
			$(".askQuestion").click(function(e) {
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
          <p class="grey_head">Frequently Ask Question</p>
        </div>
        <div class="scroll_hostel">
          <?php $sql_faq=mysqli_query($dbconfig,"SELECT * FROM faq WHERE answer!='' ");
			  while($row_faq=mysqli_fetch_assoc($sql_faq)){
		?>
          <div class="text_area_home">
            <div class="single_cat_left_content floatleft">
              <h3><?php echo $row_faq['question']; ?> </h3>
              <p><?php echo $row_faq['answer'];   ?></p>
              <p class="single_cat_left_content_meta"> <?php echo "" . humanTiming( $row_faq['faqTime'] ). " ago"; ?> | </p>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

  </div>
</div>
</body>
</html>