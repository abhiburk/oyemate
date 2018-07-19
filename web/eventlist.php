<?php require '../config.php'; 
session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Events : Oyemate</title>
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
          <?php if(isset($_GET['eventSuccess']) && $_GET['eventSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0c3;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Event Created Successfully </h3>
          </div>
          <?php } ?>
          <?php if(isset($_GET['eventUpdateSuccess']) && $_GET['eventUpdateSuccess'] == 1) { ?>
          <div id="fade" style="background-color:#0c3;">
            <h3 id="fade1" align="center" style="color:#FFF; font-size:12px">Event Updated Successfully </h3>
          </div>
          <?php } ?>
          <div class="text_area_home">
            <p align="center"><b> <b>Create Event</p>
          </div>
          <div class="text_area_home">
            <form action="insertEvent.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="xAction" value="createEvent" />
              <h3 style="display: flex;">
                <input type="text" class="form-control" name="eventName" placeholder="Enter Name of Event" style="width:100%" />
                <input type="submit" value="Create" class="createEvent floatright btn btn-primary btn-xs btn-rect"  />
              </h3>
              <input type="file" name="eventPhoto" />
            </form>
          </div>
          <?php $sql_created=mysqli_query($dbconfig,"SELECT DISTINCT events.* FROM events LEFT JOIN event_co ec ON ec.eventID = events.eventID
				WHERE events.userID  = {$_SESSION['userid']} OR ec.addedTo = {$_SESSION['userid']}")  or die(mysqli_error($dbconfig));
  				while($row_created=mysqli_fetch_assoc($sql_created)){ ?>
          <div class="text_area_home hideHome">
            <h3><a href="myevent.php?eventID=<?php echo $row_created['eventID']; ?>"> <?php echo $row_created['eventName']; ?></a>
              <div class="floatright"> <a class="showEventField" href="#" rel="<?php echo $row_created['eventID']; ?>" >Edit</a> | <a class="confirmDelete" href="delete.php?xAction=deleteEvent&eventID=<?php echo $row_created['eventID']; ?>" >Delete</a> </div>
            </h3>
            <form action="insertEvent.php" method="post" enctype="multipart/form-data">
              <h3 style="display: flex;">
                <input type="hidden" name="xAction" value="updateEvent" />
                <input type="hidden" name="eventID" value="<?php echo $row_created['eventID']; ?>" />
                <input type="text" class="form-control hideInputEvent<?php echo $row_created['eventID']; ?> hideEvent" name="eventName" value="<?php echo $row_created['eventName']; ?>" />
                <input type="submit" value="Update" class="updateAttend floatright btn btn-primary btn-xs btn-rect hideInputEvent<?php echo $row_created['eventID']; ?> hideEvent"  />
              </h3>
              <input type="file" name="eventPhoto" class=" hideInputEvent<?php echo $row_created['eventID']; ?> hideEvent" />
            </form>
          </div>
          <?php } ?>
          <script>
      $(document).ready(function(e) {
        $("input.hideEvent").hide();
			$("a.showEventField").click(function(){
			var eventID= $(this).attr('rel');
			$("input.hideInputEvent"+eventID).toggle(500);
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
