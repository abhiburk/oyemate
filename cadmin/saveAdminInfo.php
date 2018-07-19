<?php
require('../config.php');
require_once('../ImageManipulator.php');
ob_start();

$adminid = intval($_SESSION['adminid']);
//$adminUname=$_REQUEST['adminUname'];



//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;


$adminPhoto = $_FILES['adminPhoto']['name'];

$sql=" SELECT * FROM admin WHERE  adminID = '".$_SESSION['adminid']."'";
$res = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($res);
	
	if($adminPhoto != '')
{
if ($_FILES['adminPhoto']['error'] > 0) 
	{
	echo "Error: " . $_FILES['adminPhoto']['error'] . "<br />";
	} else 
  {
	// array of valid extensions
	$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
	// get extension of the uploaded file
	$fileExtension = strrchr($_FILES['adminPhoto']['name'], ".");
	// check if file Extension is on the list of allowed ones
	if (in_array($fileExtension, $validExtensions))
	 {
		$newNamePrefix = time() . '_';
		$manipulator = new ImageManipulator($_FILES['adminPhoto']['tmp_name']);
		// resizing to 200x200
		$newImage = $manipulator->resample(600, 600);
		// saving file to uploads folder
		$manipulator->save('../uploads/'. $_FILES['adminPhoto']['name']);
		
		if(mysql_num_rows($res)>0)
		{
		$sql = "UPDATE admin SET adminID = '".$_SESSION['adminid']."', adminPhoto = '".$adminPhoto."' WHERE adminID = '".$adminid."'";
	    }
	  }
    }
}			else{
				$sql = "INSERT INTO admin (adminID,adminPhoto) values ('".$_SESSION['adminid']."','".$adminPhoto."')";		
				}
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
			header('location:home.php'); exit;
			}else		{
						echo "Sorry, Please try again";	
						}
	

?>