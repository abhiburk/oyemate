<?php require '../config.php'; 
session_start();
ob_start();

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
if(($user['company']!='College Staff') and ($user['company']!='Coaching Staff')){
  header('LOCATION:home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Attendance : Oyemate</title>
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
          <div id="createResult"> </div>
          <div id="updateResult"> </div>
          <div class="text_area_home">
            <p align="center"><b> <b>Create Attendance</p>
          </div>
          <div class="text_area_home">
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="createAttendance" />
              <h3 style="display: flex;">
              <input type="text" class="form-control" name="sheetName" placeholder="Name of Attendance Sheet or Class" style="width:100%" />
              <input type="submit" value="Create" class="createAttend floatright btn btn-primary btn-xs btn-rect"  />
            </form>
            </h3>
          </div>
          <?php $sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_sheets 
				WHERE userID='".$_SESSION['userid']."' ");
  				while($row_created=mysqli_fetch_assoc($sql_created)){ ?>
          <div class="text_area_home hideHome">
            <h3><a href="singleSheet.php?sheetID=<?php echo $row_created['sheetID']; ?>"><?php echo $row_created['sheetName']; ?></a>
              <div class="floatright"> <a class="showSheetField" href="#" rel="<?php echo $row_created['sheetID']; ?>" >Edit</a> | <a class="confirmDelete" href="delete.php?xAction=deleteSheet&sheetID=<?php echo $row_created['sheetID']; ?>" >Delete</a> </div>
            </h3>
            <form method="post" enctype="multipart/form-data">
              <h3 style="display: flex;">
              <input type="hidden" name="xAction" value="updateAttendance" />
              <input type="hidden" name="sheetID" value="<?php echo $row_created['sheetID']; ?>" />
              <input type="text" class="form-control hideInputSheet<?php echo $row_created['sheetID']; ?> hideSheet" name="sheetName" value="<?php echo $row_created['sheetName']; ?>" />
              <input type="submit" value="Update" class="updateAttend floatright btn btn-primary btn-xs btn-rect hideInputSheet<?php echo $row_created['sheetID']; ?> hideSheet"  />
            </form>
            </h3>
          </div>
          <?php } ?>
          <script>
			$(".createAttend").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("createResult").innerHTML=response; 
 		}
 		}); });
		</script> 
          <script>
			$(".updateAttend").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("updateResult").innerHTML=response; 
 		}
 		}); });
		</script> 
          <script>
      $(document).ready(function(e) {
        $("input.hideSheet").hide();
			$("a.showSheetField").click(function(){
			var sheetID= $(this).attr('rel');
			$("input.hideInputSheet"+sheetID).toggle(500);
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
</body>
</html>
