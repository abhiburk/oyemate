<?php
session_start();
ob_start();
$time=time();

require('../config.php');
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

$adminUname = $_POST["adminUname"];
$adminPassword = $_POST['adminPassword'];

//$sql = "SELECT * FROM user WHERE userEmail = '".mysql_real_escape_string($userEmail)."' AND userPass = '".mysql_real_escape_string($userPass)."'" ;
//$res = mysql_query($sql) or die(mysql_error());


$sql = $conn->prepare("SELECT * FROM admin WHERE adminUname =:adminUname AND adminPassword =:adminPassword") ;
$res = $sql->execute(array("adminUname" =>$adminUname,"adminPassword"=>$adminPassword));
$row=$sql->fetch(PDO::FETCH_ASSOC);
$count=$sql->rowCount();

?>
<div class="incorrect" style="font-family: Arial; font-size: x-large; padding: 200px 540px;">
  <?php
if($count != 1){ 
	echo "Incorrect Email or Password!";	
	echo '<a href="../index.php">Try Again</a>';
	//echo '<img src="../../images/unlike.png" width="200px" height="200px"/>';
}else {

	$_SESSION['login'] =true;
	$_SESSION['adminid'] = $row['adminID'];
	$_SESSION['adminUname'] = $row['adminUname'];
	
$time=time();
$session=session_id();	
$adminid=intval($_SESSION['adminid']);
$sql="SELECT * FROM admin_visit WHERE session='$session'"; 
$result=mysql_query($sql);
$count=mysql_num_rows($result); 


//If count is 0 , then enter the values
if($count=="0"){ 
$sql1="INSERT INTO admin_visit(adminID,session,time)VALUES('".$adminid."','$session', '$time')"; 
$result1=mysql_query($sql1);
}
 // else update the values 
 else {
$sql2="UPDATE admin_visit SET time='$time' WHERE session = '$session and adminID=$adminid'"; 
$result2=mysql_query($sql2); 
}
	
	header("location: home.php?adminID= ".($_SESSION['adminid']));

	

}
?>