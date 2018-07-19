<?php
require('../config.php');

//if( $vuser->is_logged_in() ){ header('Location: profile.php'); }
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
$userName = $_POST["userName"];
$userEmail = $_POST["userEmail"];
$userPass = $_POST["userPass"];
$time =time();
 
	
		if(!isset($_POST['userEmail']) || !filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)){
			echo ('<b>Please enter a valid email.');
			echo '<a href="register.php">Try Again</a></b>';
			 exit;
		}else

$sql = $conn->prepare("SELECT * FROM user WHERE userEmail =:userEmail") ;
$res = $sql->execute(array("userEmail" =>$userEmail));
$row=$sql->fetch(PDO::FETCH_ASSOC);
$count=$sql->rowCount();

if($count != 0){
	header("location:../index.php?alrdyReg=1"); exit;
}


	if(strlen($_POST['userName']) < 7){
		header("location:../index.php?nameShort=1"); exit;
		
	} else {
	
	if(strlen($_POST['userPass']) <= 7){
		header("location:../index.php?passShort=1"); exit;
	}
	
	if($_POST['userPass'] != $_POST['userPassConfirm']){
		header("location:../index.php?passnotMatch=1"); exit;
	}
	else { 
	if($_REQUEST['eduYear'] == '') {
$sql = ("INSERT INTO user (userName,userEmail,company,instituteName,branchName,userPass,signupDate) VALUES ('".($_REQUEST['userName'])."','".($_REQUEST['userEmail'])."', 
'".($_REQUEST['company'])."','".mysql_real_escape_string($_REQUEST['instituteName'])."', 
'".($_REQUEST['branchName'])."','".($_REQUEST['userPass'])."','".($time)."')");
		}
		else {
	
$sql = ("INSERT INTO user (userName,userEmail,company,instituteName,courseName,branchName,eduYear,day,month,year,userPass,signupDate) VALUES ('".($_REQUEST['userName'])."','".($_REQUEST['userEmail'])."', 
'".($_REQUEST['company'])."','".mysql_real_escape_string($_REQUEST['instituteName'])."','".($_REQUEST['courseName'])."', 
'".($_REQUEST['branchName'])."', '".($_REQUEST['eduYear'])."','".($_REQUEST['day'])."','".($_REQUEST['month'])."',
'".($_REQUEST['year'])."', '".($_REQUEST['userPass'])."','".($time)."')");

}
$res = mysql_query($sql) or die(mysql_error());
if($res){
	header("location:../index.php?createSuccess=1"); exit;
}else{
	//header("location:../index.php?createFail=1"); 
	echo 'Failed to create account please try again'; exit;
}
}
}		


?>