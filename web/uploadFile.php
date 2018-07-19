<?php
require('../config.php');
require_once('../ImageManipulator.php');
ob_start();

$sql=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
($user=mysqli_fetch_assoc($sql));
$branchName=$user['branchName'];
$instituteName=$user['instituteName'];
$eduYear=$user['eduYear'];
			
$time = time();
$xAction = $_REQUEST['xAction'];
$detail = $_REQUEST['detail'];
$uploadDoc = $_FILES['uploadDoc']['name'];
$downloadCount='0';
//echo "<Pre>"; print_r($_REQUEST); print_r($_FILES); die;

if($_REQUEST['xAction'] == 'uploadFile')
{
		if($uploadDoc != '')
	{
			if ($_FILES['uploadDoc']['error'] > 0) 
		{
			echo "Error: " . $_FILES['uploadDoc']['error'] . "<br />";
		} 			
		else {
				// array of valid extensions
				$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
				// get extension of the uploaded file
				$fileExtension = strrchr($_FILES['uploadDoc']['name'], ".");
				// check if file Extension is on the list of allowed ones
				if (in_array($fileExtension, $validExtensions)) 
				{
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($_FILES['uploadDoc']['tmp_name']);
				// resizing to 200x200
				$newImage = $manipulator->resample(700, 700);
				// saving file to uploads folder
				$manipulator->save('../uploads/'. $_FILES['uploadDoc']['name']);
				
				$sql_upload=$conn->prepare("INSERT INTO upload (userID,uploadDoc,detail,downloadCount,uploadTime) VALUES 
				(?,?,?,?,?)");
 				$sql_upload->execute(array($_SESSION['userid'],$uploadDoc,$detail,$downloadCount,$time));
				
		  		}	
				else if(move_uploaded_file($_FILES['uploadDoc']['tmp_name'], '../uploads/'.$_FILES['uploadDoc']['name'])){
				$sql_upload=$conn->prepare("INSERT INTO upload (userID,uploadDoc,detail,downloadCount,uploadTime) VALUES 
				(?,?,?,?,?)");
 				$sql_upload->execute(array($_SESSION['userid'],$uploadDoc,$detail,$downloadCount,$time));
						} 
		}
	  } 		
			else {
				$sql_upload=$conn->prepare("INSERT INTO upload (userID,detail,downloadCount,uploadTime) VALUES 
				(?,?,?,?)");
 				$sql_upload->execute(array($_SESSION['userid'],$detail,$downloadCount,$time));		
		 		}
				
				
				//Sending Email about Upload File to Subscribe users
		$detail=$_REQUEST['detail'];//FETCHING Email
		$uploadTime = $time;
		
		$sql1=mysqli_query($dbconfig,"SELECT * FROM user WHERE userID='".$_SESSION['userid']."'");
		($user=mysqli_fetch_assoc($sql1));
		$uploadby=$user['userName'];
				
		if($user['company']!='Coaching Staff'){
			$query=mysqli_query($dbconfig,"SELECT * FROM subscribes LEFT JOIN user ON subscribes.userID=user.userID 
			WHERE branchName='".$branchName."' AND instituteName='".$instituteName."'");
			}else {		
				$coaching=mysql_query("SELECT * FROM coaching_institute WHERE userID='".$_SESSION['userid']."' ");
 			  	while($coachingRow=mysql_fetch_array($coaching)){
			  
			    $query=mysqli_query($dbconfig,"SELECT * FROM coaching_institute_students  LEFT JOIN user ON coaching_institute_students.userID=user.userID
			  	WHERE ci_ID='".$coachingRow['ci_ID']."'");
			}}
		while($rows=mysqli_fetch_array($query)){
		
		$to = $rows['userEmail']; 
		}
		//$query="SELECT * FROM celebrity ORDER BY cID DESC";
		//$result= mysql_query($query);	
		//($rows=mysql_fetch_array($result));
	
$subject = "New upload on oyemate - ".$detail."";
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
                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://www.oyemate.com/" target="_blank"><img style="width:20%" src="http://www.oyemate.com/images/oyemate2.jpg" alt="clapdust" ></a></td>
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
                                <td align="center"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">New File Uploaded !!!</h1></td>
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
                                          <td align="center" style="margin:0;text-align:center"><a href="http://www.oyemate.com/" style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Visit website!</a></td>
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
                                <td colspan="4" align="center"><h2 style="font-size:24px">Uploaded File</h2></td>
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
								  
								'.(($uploadDoc!='')?'<b>File Name: </b> '.$uploadDoc.' <br />':"").'
								
                                  <b>About File: </b>'.$detail.' <br />
                                  <b>Uploaded by: </b>'.$uploadby.' <br />
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
                         </td>
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
                                  <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0"><a href="http://www.oyemate.com/web/delete.php?xAction=unsubscribe&email='.$to.' " target="_blank">Unsubscribed</a></div></td>
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
//echo $htmlContent;exit;
// Set content-type for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: oyemate<info@oyemate.com>' . "\r\n";
$headers .= 'Cc: info@oyemate.com' . "\r\n";

// Send email
if(mail($to,$subject,$htmlContent,$headers)):
	$successMsg = 'Email has sent successfully.';
else:
	$errorMsg = 'Some problem occurred, please try again.';
endif;
					
				

if($sql_upload==true){
	header('location:home.php?fileSuccess=1'); exit;
	}else{
	header('location:home.php?fileFailed=1'); exit;
	}
}

function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'min',
        1 => 'sec'
);
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
?>
