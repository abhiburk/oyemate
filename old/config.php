<?php
session_start(); 
/// this should be always at the top of the line of the code
mysql_connect('localhost','oyemate','9881123144');
mysql_select_db('oyemate_db');

$host = 'localhost';
$username = 'oyemate';
$password = '9881123144';
$database = 'oyemate_db';

$dbconfig = mysqli_connect($host,$username,$password,$database);
try {

    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "Connected successfully";
    }
catch(PDOException $e)
    {
   // echo "Connection failed: " . $e->getMessage();
    }
?>