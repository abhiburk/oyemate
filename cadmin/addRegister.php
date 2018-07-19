<?php
require('../config.php');

//if( $vuser->is_logged_in() ){ header('Location: profile.php'); }
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
$adminUname = $_POST["adminUname"];
$adminEmail = $_POST["adminEmail"];
$adminPass = $_POST["adminPass"];
$time =time();
 
	
		if(!isset($_POST['adminEmail']) || !filter_var($_POST['adminEmail'], FILTER_VALIDATE_EMAIL)){
			echo ('<b>Please enter a valid email.');
			echo '<a href="register.php">Try Again</a></b>';
			 exit;
		}else

$sql = $conn->prepare("SELECT * FROM admin WHERE adminEmail =:adminEmail") ;
$res = $sql->execute(array("adminEmail" =>$adminEmail));
$row=$sql->fetch(PDO::FETCH_ASSOC);
$count=$sql->rowCount();

if($count != 0){
	die("Email-ID is Already Register Here ! or Please Try To Login");
}


	if(strlen($_POST['adminUname']) < 7){
		echo '<h3>Username is too short,Require more then 7 characters.</h3>';
	} else {
	
	if(strlen($_POST['adminPassword']) < 7){
		echo  '<h4>Your  Password Must Be More Then 7 Characters Please Try Again.<br/>
		
		</h4>'; exit;
	}
	//if(strlen($_POST['userPassConfirm']) <= 8){
//		echo  '<h4>Your  Password Must Be More Then 7 Characters Please Try Again.<br/>
//		</h4>'; exit;
//	}
//	if($_POST['userPass'] != $_POST['userPassConfirm']){
//		echo '<h3>Your Passwords do not match. Please Try Again</h3>';  exit;
//	}
	else {		
$sql = ("INSERT INTO admin (adminUname,adminEmail,adminPassword,privileges,signupDate) VALUES  
('".($_REQUEST['adminUname'])."', '".($_REQUEST['adminEmail'])."','".($_REQUEST['adminPassword'])."','".($_REQUEST['privileges'])."','".$time."')");
$res = mysql_query($sql) or die(mysql_error());
	
if($res){
	echo 'Account Succesfully Created
	<a href="index.php">Login To Account</a>'; exit;	
}else{
	echo "Sorry, Please try again";
}
}
}		


?>