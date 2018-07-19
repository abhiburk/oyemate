<?php
 session_start();
 ob_start();
include ('../config.php'); 



	
if (isset($_POST['adminEmail'])){
	
	$query="SELECT * FROM subscribers";
	$result= mysql_query($query);
	// If the count is equal to one, we will send message other wise display an error message.
	
	
		while($rows=mysql_fetch_array($result)){
		$subEmail  =  $rows['subEmail'];//FETCHING Email
		$subName  =  $rows['subName'];//FETCHING Email
		echo "your Email is ::".($subEmail).""; 
		echo "your Name is ::".($subName).""; 
		$to = $rows['subEmail'];
		echo $sql; }
		//echo "your email is ::".($userEmail)."";
		//Details for sending E-mail
		
		$from = "clapdust";
		$url = "http://www.clapdust,in/";
		$body  =  "Forgot Password
		
		Url : $url;
		Email Details is : $to;
		Here is your password  : $adminPassword;
		Sincerely,
		clapdust";
		$from = "clapdust";
		$subject = "Admin Password Recovered";
		$headers1 = "From: $from\n";
		$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers1 .= "X-Priority: 1\r\n";
		$headers1 .= "X-MSMail-Priority: High\r\n";
		$headers1 .= "X-Mailer: Just My Server\r\n";
		
		$sentmail = mail( $to, $subject, $body, $headers1 );
	} else {
	if ($_POST ['adminEmail'] != "") {
	echo " Your Email ID Not Found In Our System Database";
		}
		}
	//If the message is sent successfully, display sucess message otherwise display an error message.
	if($sentmail==1)
	{
		echo "<span style='color:#2EE834;'> Your Password Has Been Sent To Your Email Address.</span>";
	}
		else
		{
		if($_POST['userEmail']!="")
		echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
	}

?>