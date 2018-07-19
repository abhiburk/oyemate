<?php require '../config.php'; 
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
	
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
$rollNo=$_GET['rollNo'];
 $date = $_GET['dateFrom'];
 $date1 = $_GET['dateTo'];
 $subjectID = $_GET['subjectID'];
if($date.''.$date1 == '')
 			{echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Please Select Date Field </h3>
      		</div>';exit;}
if($rollNo == '')
 			{echo '<div style="background-color:#F00;">
        	<h3 align="center" style="color:#FFF; font-size:12px">Please Select Roll No Field </h3>
      		</div>'; 
exit;}
 
 $find=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON attend_records.attend_StudID=attend_students.attend_StudID 
 WHERE attendDate BETWEEN '".$date."' AND '".$date1."' AND subjectID='".$subjectID."' AND rollNo='".$rollNo."' GROUP BY attend_records.attend_StudID");
 $count=mysqli_num_rows($find);
 if($count ==''){ echo 'No Record Found';}else {
?>
<p align="right" class="font-set">
  <?php 
				$sql_time=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE subjectID='".$_REQUEST['subjectID']."' ORDER BY recordID DESC");
				$time=mysqli_fetch_assoc($sql_time);?>
  Updated: <?php echo "" . humanTiming( $time['attendTime'] ). " ago";?> </p>
<table class="table table-striped table-bordered table-hover">
  <tr>
    <th>Student Name</th>
    <th>RollNo</th>
    <th>Total</th>
    <th>%</th>
    <th>Status</th>
  </tr>
  <tr>
    <?php 
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
 $find=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON attend_records.attend_StudID=attend_students.attend_StudID 
 WHERE attendDate BETWEEN '".$date."' AND '".$date1."' AND subjectID='".$subjectID."' AND rollNo='".$rollNo."' GROUP BY attend_records.attend_StudID");
 $count=mysqli_num_rows($find);
 while($row_students=mysqli_fetch_array($find))
 
 { ?>
    <td><a href="singleStudent.php?subjectID=<?php echo $_REQUEST['subjectID'];?>&attend_StudID=<?php echo $row_students['attend_StudID']; ?>"><?php echo $row_students['studentName']; ?>
      </div></td>
    <td><?php echo $row_students['rollNo']; ?></td>
    <?php 
				//counting attended lectures
				$sql_count=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_records ON 
				attend_students.attend_StudID=attend_records.attend_StudID WHERE attend_students.attend_StudID='".$row_students['attend_StudID']."' 
				AND subjectID='".$row_students['subjectID']."' AND rollNo='".$rollNo."' AND attendStatus='present' AND attendDate BETWEEN '".$date."' 
				AND '".$date1."' ");
  				$totalAttended=mysqli_num_rows($sql_count);
				//counting total lectures
				$sql_count_total=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_records ON 
				attend_students.attend_StudID=attend_records.attend_StudID WHERE attend_students.attend_StudID='".$row_students['attend_StudID']."' 
				AND subjectID='".$row_students['subjectID']."' AND rollNo='".$rollNo."' AND attendDate BETWEEN '".$date."' 
				AND '".$date1."' ");
  				$totalLectures=mysqli_num_rows($sql_count_total);
				?>
    <td><?php echo $totalAttended; ?> of <?php echo $totalLectures; ?></td>
    <td><?php if ($totalLectures!=0) { echo round($totalAttended/$totalLectures*100); }else { echo '0';} ?>
      %</td>
    <td><?php if($totalAttended/$totalLectures*100 >=75){echo 'Safe';}else{echo'Defaulter';} ?></td>
  </tr>
  <?php  
 }}
?>
</table>
<?php 
function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'min',
        1 => 'sec'
);
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
?>
