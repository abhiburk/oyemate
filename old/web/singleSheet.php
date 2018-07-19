<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}

$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_sheets WHERE sheetID='".$_REQUEST['sheetID']."' ");
($sheetName=mysqli_fetch_assoc($sql_created)); 

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));

if(($user['company']!='College Staff') and ($user['company']!='Coaching Staff')){
  header('LOCATION:home.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Single Sheet : Oyemate</title>
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
          <div id="studAdd"> </div>
          <div id="studUpdate"> </div>
          <div class="text_area_home">
            <p align=""><b><a class="clickStud" href="#">Add Students</a> to <?php echo $sheetName['sheetName']; ?></b></p>
          </div>
          <script>
$(function() {
    $( "#studentName" ).autocomplete({
        source: 'searchStudent.php?sheetID=<?php echo $_REQUEST['sheetID']; ?>&xAction=<?php echo 'searchStudent'; ?>'
    });
});
</script>
          <div class="addedStud">
            <div class="text_area_home">
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="xAction" value="addAttendStudent" />
                <input type="hidden" name="sheetID" value="<?php echo $_REQUEST['sheetID']; ?>" />
                <h3 style="display: flex;">
                <input id="studentName" type="text" class="form-control" name="studentName" placeholder="Enter Name of the Student" style="width:50%" />
                <input type="text" class="form-control" name="rollNo" placeholder="Enter Roll No of the Student" style="width:50%" />
                <input type="submit" value="Add" class="addStud floatright btn btn-primary btn-xs btn-rect"  />
              </form>
              </h3>
            </div>
            <?php
$start=0;
$limit=5;
if(isset($_GET['studID'])){
	$studID=$_GET['studID'];
	$start=($studID-1)*$limit;}
else{ $studID=1; }
?>
            <table class="table table-striped table-bordered table-hover">
              <tr>
                <th>Student Name</th>
                <th>Roll No</th>
                <th>Attendence</th>
                <th>Action</th>
              </tr>
              <?php 
				$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_students 
				WHERE sheetID='".$_REQUEST['sheetID']."' LIMIT $start,$limit ");
  				while($row_students=mysqli_fetch_assoc($sql_created)){ ?>
              <tr>
                  <td>
                <form  method="post" enctype="multipart/form-data">
                  <input type="hidden" name="xAction" value="updateAttendStudent" />
                  <input type="hidden" name="attend_StudID" value="<?php echo $row_students['attend_StudID']; ?>" />
                  <div class="hideAfterClick<?php echo $row_students['attend_StudID']; ?>"><?php echo $row_students['studentName']; ?></div>
                  <h3 style="display: flex;">
                    <input type="text" class="form-control hideInputStudent<?php echo $row_students['attend_StudID']; ?> hideStudent" name="studentName" value="<?php echo $row_students['studentName']; ?>" />
                  </h3>
                    </td>
                  <td><div class="hideAfterClick<?php echo $row_students['attend_StudID']; ?>"><?php echo $row_students['rollNo']; ?></div>
                    <h3 style="display: flex;">
                    <input style="width:38%" type="text" class="form-control hideInputStudent<?php echo $row_students['attend_StudID']; ?> hideStudent" name="rollNo" value="<?php echo $row_students['rollNo']; ?>" />
                    <input type="submit" value="Update" class="updateStud submit-btn floatright btn btn-primary btn-xs btn-rect hideInputStudent<?php echo $row_students['attend_StudID']; ?> hideStudent"  />
                </form>
                  </h3>
                  </td>
                <td><?php echo $row_students['rollNo']; ?></td>
                <td><div class=""> <a class="showStudentField" href="#" rel="<?php echo $row_students['attend_StudID']; ?>" >Edit</a> | <a class="confirmDelete" href="delete.php?xAction=deleteStudent&attend_StudID=<?php echo $row_students['attend_StudID']; ?>" >Delete</a> </div></td>
              </tr>
              <?php } ?>
            </table>
            <?php
//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($dbconfig,"SELECT * FROM attend_students 
WHERE sheetID='".$_REQUEST['sheetID']."'"));
//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);?>
            <?php if($studID>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<a href='?studID=".($studID-1)."&sheetID=".($_REQUEST['sheetID'])." ' class='popular_more'> prev </a>";
}
if($studID!=$total)
if($rows!=''){
{
	////Go to previous page to show next 10 items.
	echo "<a href='?studID=".($studID+1)." &sheetID=".($_REQUEST['sheetID'])."' class='popular_more'>more</a>";
}
}
?>
            <br/>
          </div>
          <script>
			$(".updateStud").click(function(e) {
            e.preventDefault();
			console.log(formData)
            var formData= $(this).closest('form').serialize();
			//var formData= $(this).closest('td').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
					console.log(response);
  				document.getElementById("studUpdate").innerHTML=response; 
 		}
 		}); });
		</script> 
          <script>
			$(".addStud").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("studAdd").innerHTML=response; 
 		}
 		}); });
		</script>
          <div class="text_area_home">
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="addSubject" />
              <input type="hidden" name="sheetID" value="<?php echo $_REQUEST['sheetID']; ?>" />
              <h3 style="display: flex;">
              <input type="text" class="form-control" name="subjectName" placeholder="Name of Subject" style="width:100%" />
              <input type="submit" value="Add" class="addSub floatright btn btn-primary btn-xs btn-rect"  />
            </form>
            </h3>
          </div>
          <?php 
				$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_subjects 
				WHERE sheetID='".$_REQUEST['sheetID']."' ");
  				while($row_created=mysqli_fetch_assoc($sql_created)){ ?>
          <div class="text_area_home hideHome">
            <h3><a href="singleSubject.php?sheetID=<?php echo $row_created['sheetID']; ?>&subjectID=<?php echo $row_created['subjectID']; ?>"><?php echo $row_created['subjectName']; ?></a>
              <div class="floatright"> <a class="showSheetField" href="#" rel="<?php echo $row_created['subjectID']; ?>" >Edit</a> | <a class="confirmDelete" href="delete.php?xAction=deleteSubject&sheetID=<?php echo $row_created['sheetID']; ?>&subjectID=<?php echo $row_created['subjectID']; ?>" >Delete</a> </div>
            </h3>
            <form method="post" enctype="multipart/form-data">
              <h3 style="display: flex;">
              <input type="hidden" name="xAction" value="updateSubject" />
              <input type="hidden" name="subjectID" value="<?php echo $row_created['subjectID']; ?>" />
              <input type="text" class="form-control hideInputSheet<?php echo $row_created['subjectID']; ?> hideSheet" name="subjectName" value="<?php echo $row_created['subjectName']; ?>" />
              <input type="submit" value="Update" class="updateSub floatright btn btn-primary btn-xs btn-rect hideInputSheet<?php echo $row_created['subjectID']; ?> hideSheet"  />
            </form>
            </h3>
          </div>
          <?php } ?>
          <script>
			$(".addSub").click(function(e) {
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
			$(".updateSub").click(function(e) {
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
			$("input.hideStudent").hide();
			$("a.showStudentField").click(function(){
			var attend_StudID= $(this).attr('rel');
			$("div.hideAfterClick"+attend_StudID).toggle();
			$("input.hideInputStudent"+attend_StudID).toggle(500);
			return false;	
			});
			
			$("div.addedStud").hide();
			$("a.clickStud").click(function(){
			$("div.addedStud").toggle(500);
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
