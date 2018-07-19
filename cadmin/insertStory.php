<?php
require('../config.php');
require_once('../ImageManipulator.php');
ob_start();
$time=time();

$cID = ($_REQUEST['cID']);
$adminid = intval($_SESSION['adminid']);
$cName = ($_REQUEST['cName']);
$cEmail = ($_REQUEST['cEmail']);
$cInfo = ($_REQUEST['cInfo']);
$gender = ($_REQUEST['gender']);

$workInfo = ($_REQUEST['workInfo']);
$tag = ($_REQUEST['tag']);
$day = ($_REQUEST['day']);
$month = ($_REQUEST['month']);
$year = ($_REQUEST['year']);
$recommend = ($_REQUEST['recommend']);
$workPhoto = $_FILES['workPhoto']['name'];
$cPhoto = $_FILES['cPhoto']['name'];
$cpPhoto = $_FILES['cpPhoto']['name'];

//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
if($_REQUEST['xAction'] == 'cpPhoto'){
	
	if($cpPhoto != ''){

			if ($_FILES['cpPhoto']['error'] > 0) {
			echo "Error: " . $_FILES['cpPhoto']['error'] . "<br />";
			} else {
			// array of valid extensions
			$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
			// get extension of the uploaded file
			$fileExtension = strrchr($_FILES['cpPhoto']['name'], ".");
			// check if file Extension is on the list of allowed ones
			if (in_array($fileExtension, $validExtensions)) {
			$newNamePrefix = time() . '_';
			$manipulator = new ImageManipulator($_FILES['cpPhoto']['tmp_name']);
			// resizing to 200x200
			$newImage = $manipulator->resample(700, 700);
			// saving file to uploads folder
			$manipulator->save('../uploads/'. $_FILES['cpPhoto']['name']);
		}
			$sql = "INSERT INTO celebrityphotos (adminID,cID,cpPhoto,cpTime) values
			('".$_SESSION['adminid']."','".($cID)."','".$cpPhoto."','".$time."')";		
			$res = mysql_query($sql) or die(mysql_error());	
		}
	if($res){
		header('location:celebrityList.php?addSuccess=1'); exit;
	}else{
		echo "Sorry, Please try again";	
	}
}
}


if($workPhoto and $cPhoto != '') 
{
if ($_FILES['workPhoto']['error']> 0) 
		echo "Error: " . $_FILES['workPhoto']['error']. "<br />";
 		else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['workPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['workPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(1000, 1000);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['workPhoto']['name']);
				}
		}
		
		if ($_FILES['cPhoto']['error']> 0) 
		echo "Error: " . $_FILES['cPhoto']['error']. "<br />";
 		else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['cPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['cPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(500, 500);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['cPhoto']['name']);
				}
		}  
		
		{
		$sql = "INSERT INTO celebrity (adminID,cPhoto,workPhoto,cName,gender,cEmail,cInfo,workInfo,tag,day,month,year,recommend,time) values 
		('".$_SESSION['adminid']."','".($cPhoto)."','".($workPhoto)."','".mysql_real_escape_string($cName)."','".mysql_real_escape_string($gender)."','".mysql_real_escape_string($cEmail)."','".mysql_real_escape_string($cInfo)."',
		'".mysql_real_escape_string($workInfo)."','".mysql_real_escape_string($tag)."','".mysql_real_escape_string($day)."',
		'".mysql_real_escape_string($month)."','".mysql_real_escape_string($year)."','".mysql_real_escape_string($recommend)."','".$time."')";		
		}
				}

else if($workPhoto != '')
{
		if ($_FILES['workPhoto']['error'] > 0) 
		echo "Error: " . $_FILES['workPhoto']['error'] . "<br />";
 		else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['workPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['workPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(1000, 1000);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['workPhoto']['name']);
		
		$sql = "INSERT INTO celebrity (adminID,workPhoto,cName,gender,cEmail,cInfo,workInfo,tag,day,month,year,recommend,time) values 
		('".$_SESSION['adminid']."','".($workPhoto)."','".mysql_real_escape_string($cName)."','".mysql_real_escape_string($gender)."','".mysql_real_escape_string($cEmail)."','".mysql_real_escape_string($cInfo)."',
		'".mysql_real_escape_string($workInfo)."','".mysql_real_escape_string($tag)."','".mysql_real_escape_string($day)."',
		'".mysql_real_escape_string($month)."','".mysql_real_escape_string($year)."','".mysql_real_escape_string($recommend)."','".$time."')";		
				}
		 }
}	
else  if($cPhoto != '')
	{
 	if ($_FILES['cPhoto']['error'] > 0) 
	echo "Error: " . $_FILES['cPhoto']['error'] . "<br />";
	 	else 
		{
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['cPhoto']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
			{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['cPhoto']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(500, 500);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['cPhoto']['name']);
				
		$sql = "INSERT INTO celebrity (adminID,cPhoto,cName,gender,cEmail,cInfo,workInfo,tag,day,month,year,recommend,time) values 
		('".$_SESSION['adminid']."','".($cPhoto)."','".mysql_real_escape_string($cName)."','".mysql_real_escape_string($gender)."','".mysql_real_escape_string($cEmail)."','".mysql_real_escape_string($cInfo)."',
		'".mysql_real_escape_string($workInfo)."','".mysql_real_escape_string($tag)."','".mysql_real_escape_string($day)."',
		'".mysql_real_escape_string($month)."','".mysql_real_escape_string($year)."','".mysql_real_escape_string($recommend)."','".$time."')";		
	 		}
	 	}
	}
	  else
	{
		$sql = "INSERT INTO celebrity (adminID,cName,gender,cEmail,cInfo,workInfo,tag,day,month,year,recommend,time) values 
		('".$_SESSION['adminid']."','".mysql_real_escape_string($cName)."','".mysql_real_escape_string($gender)."','".mysql_real_escape_string($cEmail)."','".mysql_real_escape_string($cInfo)."',
		'".mysql_real_escape_string($workInfo)."','".mysql_real_escape_string($tag)."','".mysql_real_escape_string($day)."',
		'".mysql_real_escape_string($month)."','".mysql_real_escape_string($year)."','".mysql_real_escape_string($recommend)."','".$time."')";		
	}
	$res = mysql_query($sql) or die(mysql_error());
	
	if (($_REQUEST['cName'])!=''){
		$cName =$_REQUEST['cName'];//FETCHING Email
		$tag = ($_REQUEST['tag']);
		$gender = ($_REQUEST['gender']);
		
		
		$query="SELECT * FROM subscribers ";
		$result= mysql_query($query);	
		while($rows=mysql_fetch_array($result)){
		
		$to = $rows['subEmail']; }
		$query="SELECT * FROM celebrity ORDER BY cID DESC";
		$result= mysql_query($query);	
		($rows=mysql_fetch_array($result));
	
$subject = "Welcome to clapdust Stories";
// Get HTML contents from file
//$htmlContent = file_get_contents('email_template.php?cName='.$cName.'&cInfo='.$cInfo.'&gender='.$gender.' ');
 $htmlContent='<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
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
                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://www.clapdust.com/" target="_blank"><img style="width:35%" src="http://www.clapdust.com/images/clapdust.jpg" alt="clapdust" ></a></td>
                                <td width="30"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center"><table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td colspan="3" height="60"></td>
                              </tr>
                              <tr>
                                <td width="25"></td>
                                <td align="center"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Welcome to Clapdust Blog</h1></td>
                                <td width="25"></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="40"></td>
                              </tr>
                              <tr>
                                <td colspan="4"><div style="width:100%;text-align:center;margin:30px 0">
                                    <table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0">
                                      <tbody>
                                        <tr>
                                          <td align="center" style="margin:0;text-align:center"><a href="http://www.clapdust.com/" style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Visit website!</a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div></td>
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
                                <td colspan="4" align="center"><h2 style="font-size:24px">New Story Added</h2></td>
                              </tr>
                              <tr>
                                <td colspan="4">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="120" align="right" valign="top"><img src="http://clapdust.com/images/default.jpg" alt="Person Image" width="120" height="120"></td>
                                <td width="30"></td>
                                <td align="left" valign="middle"><h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">About</h3>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                  <b>Celebrity Name: </b>'.$cName.' <br />
                                  <b>Celebrity Info: </b>'.$tag.' <br />
                                  <b>Celebrity Gender/Type: </b>'.$gender.' 
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
                                <td><h2 style="color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">&nbsp;</h2>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Create a request to us to add your inspiration/idol person on our blog </div></td>
                              </tr>
                              <tr>
                                <td align="center"><div style="text-align:center;width:100%;padding:40px 0">
                                    <table align="center" cellpadding="0" cellspacing="0" style="margin:0 auto;padding:0">
                                      <tbody>
                                        <tr>
                                          <td align="center" style="margin:0;text-align:center"><a href="http://www.clapdust.com/web/createRequest.php" style="font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block" target="_blank">Create Request Now!</a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div></td>
                              </tr>
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
                                <td width="360" valign="top"><div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2016 clapdust. All rights reserved.</div>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0"><a href="http://www.clapdust.com/web/delete.php?xAction=unsubscribe&subEmail='.$to.' " target="_blank">Unsubscribed</a></div></td>
                                <td align="right" valign="top"><span style="line-height:20px;font-size:10px"><a href="https://www.facebook.com/clapdust" target="_blank"><img src="http://i.imgbox.com/BggPYqAh.png" alt="fb"></a>&nbsp;</span> </td>
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

// Set content-type for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: Clapdust<info@clapdust.com>' . "\r\n";
$headers .= 'Cc: info@clapdust.com' . "\r\n";

// Send email
if(mail($to,$subject,$htmlContent,$headers)):
	$successMsg = 'Email has sent successfully.';
else:
	$errorMsg = 'Some problem occurred, please try again.';
endif;
		
		
	if($res){
				header('location:home.php?addSuccess=1'); exit;
			}else
			{
			echo "Sorry, Please try again";	
			}
}

?>