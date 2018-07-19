<?php require '../config.php'; 

 $date = $_GET['dateFrom'];
 $date1 = $_GET['dateTo'];
 $subjectID = $_GET['subjectID'];
 
 $find=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON attend_records.attend_StudID=attend_students.attend_StudID 
 WHERE attendDate BETWEEN '".$date."' AND '".$date1."' AND subjectID='".$subjectID."' GROUP BY attend_records.attend_StudID");
 $count=mysqli_num_rows($find);
 if($count ==''){ echo 'No Record Found';}else {
?>
<table class="table table-striped table-bordered table-hover">
              <tr>
                <th>Student Name</th>
                <th>RollNo</th>
                <th>Attendence</th>
                <th>Total</th>
                <th>%</th>
              </tr>
              <tr>
<?php 
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

 
 $find=mysqli_query($dbconfig,"SELECT * FROM attend_records LEFT JOIN attend_students ON attend_records.attend_StudID=attend_students.attend_StudID 
 WHERE attendDate BETWEEN '".$date."' AND '".$date1."' AND subjectID='".$subjectID."' GROUP BY attend_records.attend_StudID");
 $count=mysqli_num_rows($find);
 
 while($row_students=mysqli_fetch_array($find))
 
 { ?>
 
                <td>
                <a href="singleStudent.php?subjectID=<?php echo $_REQUEST['subjectID'];?>&attend_StudID=<?php echo $row_students['attend_StudID']; ?>"><?php echo $row_students['studentName']; ?></div>
                </td>
                <td><?php echo $row_students['rollNo']; ?></td>
                <td><?php if($row_students['attendStatus']=='present') echo 'Present'; else{ echo 'Absent';}?></td>
                <?php 
				//counting attended lectures
				$sql_count=mysqli_query($dbconfig,"SELECT * FROM attend_students LEFT JOIN attend_records ON 
				attend_students.attend_StudID=attend_records.attend_StudID WHERE attend_students.attend_StudID='".$row_students['attend_StudID']."' 
				AND subjectID='".$row_students['subjectID']."' AND attendStatus='present' AND attendDate BETWEEN '".$date."' AND '".$date1."' ");
  				$totalAttended=mysqli_num_rows($sql_count);
				//counting total lectures
				$sql_count_total=mysqli_query($dbconfig,"SELECT * FROM attend_records 
				WHERE subjectID='".$row_students['subjectID']."' AND attend_StudID='".$row_students['attend_StudID']."'  AND attendDate BETWEEN '".$date."' AND '".$date1."' ");
  				$totalLectures=mysqli_num_rows($sql_count_total);
				?>
                <td><?php echo $totalAttended; ?> of <?php echo $totalLectures; ?></td>
                <td><?php if ($totalLectures!=0) { echo round($totalAttended/$totalLectures*100); }else { echo '0';} ?>
                  %</td>
              </tr>
            
<?php  
 }}
?>
</table>
