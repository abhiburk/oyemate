<?php
ob_start();
session_start();
require('../config.php');


$time=time();

$uploadID=$_REQUEST['uploadID'];


//Inserting the values of the person who downloaded the file along with the time
$sql="INSERT INTO download (uploadID,userID,downTime) VALUES ('".$uploadID."','".$_SESSION['userid']."','".$time."')";
$res = mysql_query($sql) or die(mysql_error());

  // Updating requested file count by 1+ and storing it into the database
  $sql_count=mysql_query("UPDATE upload SET downloadCount=downloadCount+1 WHERE uploadID='".$uploadID."'");
  //selecting the requested file and then putting that into the header for auto download after update count is completed
  
$sql="SELECT * FROM user LEFT JOIN upload ON user.userID=upload.userID WHERE upload.uploadID='".$_REQUEST['uploadID']."'";
$result=mysql_query($sql);
while($row=mysql_fetch_assoc($result)){

		
 header('location: ../uploads/'.$row['uploadDoc']); 

}
?>

</body>
</html>