<?php
require '../config.php'; 

session_start();
ob_start();
if(!isset($_SESSION['userid'])){
  header('LOCATION:../index.php?notLogin=1');
}
$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));
$branchName=$user['branchName'];
$instituteName=(mysql_real_escape_string($user['instituteName']));
$eduYear=$user['eduYear'];   
    //get search term
    $searchTerm = $_GET['term'];
	
if($_REQUEST['xAction']=='searchCo') {	

    $query = $dbconfig->query("SELECT * FROM user
	WHERE userName LIKE '%".$searchTerm."%' AND userID!='".$_SESSION['userid']."' ");
    while ($row = $query->fetch_assoc()) {
		 //echo '<input type="hidden" value="'.$row['userID'].'">'; 
         $data[]=$row['userName'];
		 }
    //return json data
    echo json_encode($data);
}	
    
	if($_REQUEST['xAction']=='searchStudent') {	

    $query = $dbconfig->query("SELECT * FROM user
	WHERE userName LIKE '%".$searchTerm."%' AND company='Student' AND 
	branchName='".$branchName."' AND instituteName='".$instituteName."' ");
    while ($row = $query->fetch_assoc()) {
		
		$query1 = $dbconfig->query("SELECT * FROM attend_students WHERE studentName ='".$row['userName']."' AND sheetID='".$_REQUEST['sheetID']."'");
		$count_check=mysqli_num_rows($query1);
		if($count_check =='') {
        $data[] = $row['userName']; }
    }
    //return json data
    echo json_encode($data);
	}
	
if($_REQUEST['xAction']=='searchUser') {	
//get matched data from skills table
    $query = $dbconfig->query("SELECT * FROM user
	WHERE userName LIKE '%".$searchTerm."%' AND company='College Staff' AND 
	branchName='".$branchName."' AND instituteName='".$instituteName."' AND userID!='".$_SESSION['userid']."' ");
    while ($row = $query->fetch_assoc()) {
		 //echo '<input type="hidden" value="'.$row['userID'].'">'; 
         $data[]=$row['userName'];
		 }
    //return json data
    echo json_encode($data);
}


if($_REQUEST['xAction']=='searchDate') {	
//get matched data from skills table
    $searchTerm = $_GET['matchvalue'];
 $find=mysql_query("SELECT * FROM attend_records WHERE attendDate LIKE '%".$searchTerm."%' ");
 while($row=mysql_fetch_array($find))
 {
  echo "<h3>".$row['attendStatus']."</h3>";
 }
}
?>