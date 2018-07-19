<?php
require '../config.php';
$time=time(); // here I am taking IP as UniqueID but you can have user_id from Database or SESSION
session_start();
ob_start();
$non_userID = $_SERVER['REMOTE_ADDR'];
 
//echo '<pre>'; print_r($_REQUEST); print_r($_FILES); die;
if($_REQUEST['xAction']=='hostelRate'){

    $rating = $dbconfig->real_escape_string($_POST['rating']);
	$hostelID = $dbconfig->real_escape_string($_POST['hostelID']);
// check if user has already rated
    $sql = "SELECT * FROM hostel_rating WHERE `non_userID`='".$non_userID."' AND hostelID='".$hostelID."'";
    $result = $dbconfig->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        echo $row['hrID'];
    } else {
 		$sql=mysqli_query($dbconfig,"UPDATE hostel SET ratingCount=ratingCount+1 WHERE hostelID='".$hostelID."'");
        $sql = "INSERT INTO `hostel_rating` (non_userID,hostelID,rating,ratingTime) VALUES ('".$non_userID."','".$hostelID."','".$rating."','".$time."'); ";
		if (mysqli_query($dbconfig, $sql)) {
            echo "0";
		

        }
    }
}


if($_REQUEST['xAction']=='collegeRate'){

if (isset($_POST['rating']) && !empty($_POST['rating'])) {
 
    $rating = $dbconfig->real_escape_string($_POST['rating']);
	$collegeID = $dbconfig->real_escape_string($_POST['collegeID']);
// check if user has already rated
    $sql = "SELECT * FROM college_rating WHERE `userID`='".$_SESSION['userid']."' AND collegeID='".$collegeID."'";
    $result = $dbconfig->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        echo $row['crID'];
    } else {
 		$sql=mysqli_query($dbconfig,"UPDATE colleges SET ratingCount=ratingCount+1 WHERE collegeID='".$collegeID."'");
        $sql = "INSERT INTO `college_rating` (userID,collegeID,rating,ratingTime) VALUES ('".$_SESSION['userid']."','".$collegeID."','".$rating."','".$time."'); ";
		if (mysqli_query($dbconfig, $sql)) {
            echo "0";
		

        }
    }
}
}


if($_REQUEST['xAction']=='coachingRate'){
if (isset($_POST['rating']) && !empty($_POST['rating'])) {
 
    $rating = $dbconfig->real_escape_string($_POST['rating']);
	$ci_ID = $dbconfig->real_escape_string($_POST['ci_ID']);
// check if user has already rated
    $sql = "SELECT * FROM coaching_institute_rating WHERE `userID`='".$_SESSION['userid']."' AND ci_ID='".$ci_ID."'";
    $result = $dbconfig->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        echo $row['ci_ratingID'];
    } else {
 		$sql=mysqli_query($dbconfig,"UPDATE coaching_institute SET ci_ratingCount = ci_ratingCount+1 WHERE ci_ID='".$ci_ID."'");
        $sql = "INSERT INTO `coaching_institute_rating` (userID,ci_ID,ci_rating,ci_ratingTime) VALUES 
		('".$_SESSION['userid']."','".$ci_ID."','".$rating."','".$time."'); ";
		if (mysqli_query($dbconfig, $sql)) {
            echo "0";
		

        }
    }
}
}
$dbconfig->close();
?>