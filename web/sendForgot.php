<?php
 session_start();
 ob_start();
include ('../config.php'); 
$userEmail = $_POST["userEmail"];
	
if (isset($_POST['userEmail'])){
	//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
	
	// Validate email address
 	$userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);

	if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL) === true) {
	 
    header("location:../index.php?email='".$userEmail."'&emailnotValid=1"); exit;
	}else {
		
	$query=mysqli_query($dbconfig,"SELECT * FROM user WHERE userEmail='".$userEmail."'");
	$rows=mysqli_fetch_assoc($query);
	$count=mysqli_num_rows($query);
	// If the count is equal to one, we will send message other wise display an error message.
	if($count==1)
	
	{
		//$rows=mysqli_fetch_array($query);
		$userPass  =  $rows['userPass']; 
		$userName  =  $rows['userName'];
		$to = $rows['userEmail'];
		echo $sql; 
		//generating random password with length 5
		$randpass = substr(md5(uniqid(rand(),1)),3,10);  
		
		$encypass = md5($randpass); //encrypted version for database entry
		
		
		  
		
		$userRealPass='0';
		//Updating Password with ency before sending randompass
		$sql_update=$conn->prepare("UPDATE user SET userPass=:userPass,userRealPass=:userRealPass WHERE userEmail='".$to."'");
		$sql_update->execute(array(':userPass'=>$encypass,':userRealPass'=>$userRealPass));
		
		
		$body= '<p>Hello, <b>'.$userName.'</b> Here is your temparory password <b> '.$randpass.' </b>. <br/>You can login using this password and changed password to something more rememberable
		<a href="http://www.oyemate.com/">Login Here</a></p>';
		echo $body;exit;
		
		$from = "oyemate";
		$url = "http://www.oyemate.com/";
		
		$subject = "oyemate password recovery";
		$headers1 = "From: $from\n";
		$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers1 .= "X-Priority: 1\r\n";
		$headers1 .= "X-MSMail-Priority: High\r\n";
		$headers1 .= "X-Mailer: Just My Server\r\n";
		
		$sentmail = mail( $to, $subject, $body, $headers1 );
	} else {
	if ($_POST ['userEmail'] != "") {
	//echo " Your Email ID Not Found In Our System Database";
	header('LOCATION:../index.php?emailNotfound=1'); exit;
		}
		}
	//If the message is sent successfully, display sucess message otherwise display an error message.
	if($sentmail==1)
	{
			header('LOCATION:../index.php?emailSuccess=1');exit;
		//echo "<span style='color:#2EE834;'> Your Password Has Been Sent To Your Email Address.</span>";
	}
		else
		{
		if($_POST['userEmail']!="")
		header('LOCATION:../index.php?emailFail=1');exit;
		//echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
	}
}
}
?>