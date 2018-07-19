<!DOCTYPE HTML>
<html>
<head>
<title>List Of Frequently Asked Question | Faq :: Oyemate</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head>
<body>
<div class="page-container"> 
  <!--/content-inner-->
  <div class="left-content">
    <div class="mother-grid-inner"> 
      <!--header start here-->
      <?php include 'header.php'; ?>
      <!--heder end here-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a> <i class="fa fa-angle-right"></i>Faq</li>
      </ol>
      <!-- faq -->
      
      <div class="asked">
        <?php 
				$sql=mysqli_query($dbconfig,"SELECT * FROM faq ORDER BY faqID DESC");
				while($faqList=mysqli_fetch_assoc($sql)){
				?>
        <div class="questions">
          <h2><?php echo $faqList['question']; ?> </h2>
          <h6> Asked by: <b><?php echo $faqList['faqName']; ?></b>
          <?php if($faqList['userID']!='0'){ ?>(Member)<?php } ?>,
          <?php date_default_timezone_set('Asia/Kolkata');echo "" . humanTiming( $faqList['faqTime'] ). " ago"; ?>, 
          <a href="#" rel="<?php echo $faqList['faqID']; ?>" class="answer" >Answer this</a>
          </h6>
          <div class="hideArea<?php echo $faqList['faqID']; ?> hideAll">
            <form id="myForm"  method="post" enctype="multipart/form-data">
              <input type="hidden" class="xAction1" name="xAction" value="answerQ">
              <input type="hidden" class="faqID1" name="faqID" value="<?php echo $faqList['faqID']; ?>">
              <textarea class="form-control" class="answer1" name="answer" placeholder="Answer to this question" ></textarea>
              <input id="submit" type="submit" value="Answer" class="submit btn btn-success btn-sm btn-rect">
            </form>
          </div>
          <p><?php echo $faqList['answer']; ?></p>
        </div>
        <script>
			$(".submit").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
                success: function(result) {
                   window.location = "faqList.php";
                } });});
</script>
        <?php } ?>
      </div>
      <!-- //faq --> 
      <script>
			$(document).ready(function(){
			$("div.hideAll").hide();
			$("a.answer").click(function(){
			var faqID= $(this).attr('rel');
			$("div.hideArea"+faqID).toggle(1000);
			return false;	
			});});
        </script> 

      <!-- script-for sticky-nav --> 
      <script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script> 
      <!-- /script-for sticky-nav --> 
      <!--inner block start here-->
      <div class="inner-block"> </div>
      <!--inner block end here--> 
      <!--copy rights start here-->
      <?php include 'copyright.php'; ?>
      <!--COPY rights end here--> 
    </div>
  </div>
  <!--//content-inner--> 
  <!--/sidebar-menu-->
  <?php include 'sidebar-left.php'; ?>
<!--js --> 
<script src="js/jquery.nicescroll.js"></script> 
<script src="js/scripts.js"></script> 
<!-- Bootstrap Core JavaScript --> 
<script src="js/bootstrap.min.js"></script> 
<!-- /Bootstrap Core JavaScript -->

</body>
</html>