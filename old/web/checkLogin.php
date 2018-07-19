<?php
session_start();
ob_start();
$time=time();
require('../config.php');
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

$userEmail = $_POST["userEmail"];
$userPass = $_POST['userPass'];

//$sql = "SELECT * FROM user WHERE userEmail = '".mysql_real_escape_string($userEmail)."' AND userPass = '".mysql_real_escape_string($userPass)."'" ;
//$res = mysql_query($sql) or die(mysql_error());


$sql = $conn->prepare("SELECT * FROM user WHERE userEmail =:userEmail AND userPass =:userPass") ;
$res = $sql->execute(array("userEmail" =>$userEmail,"userPass"=>$userPass));
$row=$sql->fetch(PDO::FETCH_ASSOC);
$count=$sql->rowCount();

if($count != 1){ 
	header("location:../index.php?loginFailed=1");
}else {

	$_SESSION['login'] =true;
	$_SESSION['userid'] = $row['userID'];
	$_SESSION['userEmail'] = $row['userEmail'];
	$instituteName=$row['instituteName'];

$time=time();
$session=session_id();	
$sql="SELECT * FROM user_session WHERE userID='".$_SESSION['userid']."'"; 
$result=mysql_query($sql);
$count=mysql_num_rows($result); 

//If count is 0 , then enter the values
if($count==0){ 
$sql1="INSERT INTO user_session(userID,session,sessionTime)VALUES('".$_SESSION['userid']."','$session', '$time')"; 
$result1=mysql_query($sql1);
}
 // else update the values 
 //else {
//$sql2="UPDATE user_session SET time='$time' WHERE session = '$session and userID='".$_SESSION['userid']."''"; 
//$result2=mysql_query($sql2); 
//}


$sql1="INSERT INTO user_visit(userID,visitTime)VALUES('".$_SESSION['userid']."','$time')"; 
$result1=mysql_query($sql1);


$sql = $conn->prepare("SELECT * FROM coaching_institute WHERE userID =:userID") ;
$res = $sql->execute(array("userID" =>$_SESSION['userid']));
$row1=$sql->fetch(PDO::FETCH_ASSOC);

		if($row['company']=='Coaching Staff'){
		if($row1['instituteName'] == '') {
		$sql = mysql_query("INSERT INTO coaching_institute (userID,instituteName,ci_updateTime) VALUES 
		('".($_SESSION['userid'] )."','".($instituteName)."','".($time)."')");
		}
		}
	if($row['instituteName']=='Other'){
		header("location:mycollege.php?reqCollege=1");
		}else {	
	header("location:home.php");
		}
}
?>