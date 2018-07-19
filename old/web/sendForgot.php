<?php
 session_start();
 ob_start();
include ('../config.php'); 
$userEmail = $_POST["userEmail"];
	
if (isset($_POST['userEmail'])){
	//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;

	$query=mysqli_query($dbconfig,"SELECT * FROM user WHERE userEmail='".$userEmail."'");
	$rows=mysqli_fetch_assoc($query);
	$count=mysqli_num_rows($query);
	// If the count is equal to one, we will send message other wise display an error message.
	if($count==1)
	
	{
		//$rows=mysqli_fetch_array($query);
		$userPass  =  $rows['userPass'];//FETCHING PASS
		$userName  =  $rows['userName'];
		//echo "your pass is :: '".$userPass."' " ; 
		$to = $rows['userEmail'];
		echo $sql; 
		//echo "your email is ::".($userEmail)."";exit;
		//Details for sending E-mail
		$body= '<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
    <tbody>
      <tr>
        <td><table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
            <tbody>
              <tr>
                <td><table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                    <tbody>
                      <tr>
                        <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0"><table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td width="30"></td>
                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://www.oyemate.com/" target="_blank"><img style="width:20%" src="http://www.oyemate.com/images/oyemate2.jpg" alt="clapdust" ></a></td>
                                <td width="30"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center"><table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                             
                                <td width="25"></td>
                                <td align="center"><h3 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:30px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Password Recovery</h3></td>
                                <td width="25"></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="40"></td>
                              </tr>
                              
                              <tr>
                                <td colspan="3" height="30"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                        <td width="30" bgcolor="#eeeeee"></td>
                        <td><table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td colspan="4" align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="4" align="center"><h2 style="font-size:24px">Here is Your Password</h2></td>
                              </tr>
                              <tr>
                                <td colspan="4">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="120" align="right" valign="top"></td>
                                <td width="30"></td>
                                <td align="left" valign="middle"><h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">About</h3>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                  <b>User Name: </b> '.$userName.' <br />
                                  <b>User Password: </b>'.$userPass.' <br />
                                  </div>
                                  <div style="line-height:10px;padding:0;margin:0">&nbsp;</div></td>
                                <td width="30"></td>
                              </tr>
                              <tr>
                                <td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>
                              </tr>
                              
                                <td colspan="4">&nbsp;</td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              
                              
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td width="30" bgcolor="#eeeeee"></td>
                      </tr>
                    </tbody>
                  </table>
                  <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                    <tbody>
                      <tr>
                        <td><table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                              <tr>
                                <td colspan="2" height="30"></td>
                              </tr>
                              <tr>
                                <td width="360" valign="top"><div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2017 oyemate. All rights reserved.</div>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                <td align="right" valign="top"><span style="line-height:20px;font-size:10px"><a href="https://www.facebook.com/oyemate" target="_blank"><img src="http://i.imgbox.com/BggPYqAh.png" alt="fb"></a>&nbsp;</span> </td>
                              </tr>
                              <tr>
                                <td colspan="2" height="5"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                    </tbody>
                  </table></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>';
//echo $body;exit;
		$from = "oyemate password recovery";
		$url = "http://www.oyemate.com/";
		
		$subject = "oyemate Password Recovery";
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
?>