<?php
require('../config.php');

//if( $vuser->is_logged_in() ){ header('Location: profile.php'); }
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


$userName = $_POST["userName"];
$userEmail = $_POST["userEmail"];
$userPass = md5($_POST["userPass"]);

$instituteName = $_POST["instituteName"];
$branchName = $_POST["branchName"];
$courseName = $_POST["courseName"];
$year = $_POST["year"];
$company = $_POST["company"];

$coachinstituteName = $_POST["coachinstituteName"];
$coachbranchName = $_POST["coachbranchName"];

$_SESSION['userName']=$userName;
$_SESSION['userEmail']=$userEmail;
$_SESSION['instituteName']=$instituteName;
$_SESSION['branchName']=$branchName;
$_SESSION['courseName']=$courseName;
$_SESSION['year']=$year;
$_SESSION['company']=$company;
$_SESSION['coachbranchName']=$coachbranchName;
$_SESSION['coachinstituteName']=$coachinstituteName;

$time =time();
 
$userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL) === true) {
	 
    header("location:../index.php?email='".$userEmail."'&emailnotValid=1"); exit;
}else {
 
$sql1 = $conn->prepare("SELECT * FROM user WHERE userEmail =:userEmail") ;
$res = $sql1->execute(array("userEmail" =>$userEmail));
$row=$sql1->fetch(PDO::FETCH_ASSOC);
$count=$sql1->rowCount();

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
	if($company == 'Coaching Staff') {
		$sql=$conn->prepare("INSERT INTO user (userName,userEmail,company,instituteName,branchName,userPass,signupDate) VALUES 
		(?,?,?,?,?,?,?)");
 		$sql->execute(array($userName,$userEmail,$company,$coachinstituteName,$coachbranchName,$userPass,$time));
		}
	else {
		$sql=$conn->prepare("INSERT INTO user (userName,userEmail,company,instituteName,courseName,branchName,eduYear,userPass,signupDate) VALUES 
		(?,?,?,?,?,?,?,?,?)");
 		$sql->execute(array($userName,$userEmail,$company,$instituteName,$courseName,$branchName,$year,$userPass,$time));
		
		}
	if($sql>0){
	unset($_SESSION['userName']);unset($_SESSION['userEmail']);unset($_SESSION['instituteName']);unset($_SESSION['courseName']);unset($_SESSION['branchName']);
	unset($_SESSION['coachinstituteName']);unset($_SESSION['coachbranchName']);unset($_SESSION['company']);unset($_SESSION['year']);	
	header("location:../index.php?createSuccess=1"); exit;
	}else{
	//header("location:../index.php?createFail=1"); 
	echo 'Failed to create account please try again'; exit;
	}
   }
 }
}


?>