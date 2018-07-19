<?php require '../config.php';
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
} 

$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON 
attend_records.attend_StudID=attend_students.attend_StudID
WHERE attend_students.attend_StudID='".$_REQUEST['attend_StudID']."' ");
($student=mysqli_fetch_assoc($sql_created)); 

$sql_attend=mysqli_query($dbconfig,"SELECT * FROM attend_sheets 
WHERE userID='".$_SESSION['userid']."' ");
($attend_user=mysqli_fetch_assoc($sql_attend)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Single Student : Oyemate</title>
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
        <div id="updateCheck"></div>
        <?php 
				//counting attended lectures
				$sql_count=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_records ON 
				attend_students.attend_StudID=attend_records.attend_StudID WHERE attend_students.attend_StudID='".$_REQUEST['attend_StudID']."' 
				AND subjectID='".$_REQUEST['subjectID']."' AND attendStatus='present'");
  				$totalAttended=mysqli_num_rows($sql_count);
				//counting total lectures
				$sql_count_total=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE subjectID='".$_REQUEST['subjectID']."' AND attend_StudID='".$_REQUEST['attend_StudID']."'");
  				$totalLectures=mysqli_num_rows($sql_count_total);
				?>
        <div class="text_area_home">
          <p><b>Student Name: </b> <?php echo $student['studentName']; ?> |
            Total (<?php echo $totalAttended; ?> of <?php echo $totalLectures; ?>) | <b>
            <?php if ($totalLectures!=0) { echo round($totalAttended/$totalLectures*100); }else { echo '0';} ?>
            %</b> </p>
        </div>
        <table class="table table-striped table-bordered table-hover">
          <tr>
            <th>Attendence</th>
            <th>Date</th>
            <?php if($attend_user['userID']==''){ ?>
            <?php }else { ?>
            <th>Action</th>
            <?php } ?>
          </tr>
          <?php 
				$sql_created=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON 
				attend_records.attend_StudID=attend_students.attend_StudID
 				WHERE attend_students.attend_StudID='".$_REQUEST['attend_StudID']."' AND subjectID='".$_REQUEST['subjectID']."' ");
				while($row_students=mysqli_fetch_assoc($sql_created)){ ?>
          <tr>
            <form action="insertData.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="updateCheck" />
              <input type="hidden" name="recordID" value="<?php echo $row_students['recordID'];?>" />
              <input type="hidden" name="subjectID" value="<?php echo $row_students['subjectID']; ?>" />
              <td><?php if($attend_user['userID']==''){ ?>
                <?php if($row_students['attendStatus'] == 'present'){ echo 'Present';}?>
                <?php if($row_students['attendStatus'] == 'absent'){ echo 'Absent';}?>
                <?php }else{ ?>
                Present:
                <input type="radio" name="attendStatus<?php echo $row_students['recordID']; ?>" value="present"<?php if($row_students['attendStatus'] == 'present'){ echo 'checked';}?>/>
                | Absent:
                <input type="radio" name="attendStatus<?php echo $row_students['recordID']; ?>" value="absent" <?php if($row_students['attendStatus'] == 'absent'){ echo 'checked';}?>/>
                <?php } ?></td>
              <?php 
			$conv1= strtotime($row_students['attendDate']);
    		$attendDate=date('d-M-Y', $conv1);
			?>
              <td><?php echo $attendDate; ?>
                <div style="display:flex;"> <i style="font-size: 20px;" class="icon-calendar hideInputCheck<?php echo $row_students['recordID']; ?> hideCheck"></i> &nbsp;
                  <input onblur="checkTextField(this);" type="text" name="attendDate" value="<?php echo $row_students['attendDate']; ?>" class="datepicker form-control hideInputCheck<?php echo $row_students['recordID']; ?> hideCheck " placeholder="Click Here to Select Date" style="width:50%" />
                  <input type="submit" value="Update" class=" submit-btn floatright btn btn-primary btn-xs btn-rect hideInputCheck<?php echo $row_students['recordID']; ?> hideCheck" />
                </div>
            </form>
              </td>
            <?php if($attend_user['userID']==''){ ?>
            <?php }else { ?>
            <td><a class="showCheckField" href="#" rel="<?php echo $row_students['recordID']; ?>" >Edit</a> | <a class="confirmDelete" href="delete.php?xAction=deleteRecord&recordID=<?php echo $row_students['recordID']; ?>" >Delete</a></td>
            <?php } ?>
            </div>
            </tr>
          <?php } ?>
        </table>
        
        <script>
			$(".updateCheck").click(function(e) {
            e.preventDefault();
            var formData= $(this).closest('form').serialize();
            $.ajax({
                type: "POST",
                url: "insertData.php",
                data: formData,
 				success: function (response) {
  				document.getElementById("updateCheck").innerHTML=response; 
 		}
 		}); });
		</script> 
        <script>
      $(document).ready(function(e) {
        $(".hideCheck").hide();
			$("a.showCheckField").click(function(){
			var recordID= $(this).attr('rel');
			$(".hideInputCheck"+recordID).toggle(500);
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
