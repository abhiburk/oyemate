<?php
session_start(); 

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'oyemate_db';

/// this should be always at the top of the line of the code
mysql_connect($host,$username,$password);
mysql_select_db($database);



$dbconfig = mysqli_connect($host,$username,$password,$database);
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "Connected successfully";
    }
catch(PDOException $e)
    {
   // echo "Connection failed: " . $e->getMessage();
    }
?>