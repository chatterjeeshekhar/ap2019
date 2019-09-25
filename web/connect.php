<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
//$servername1 = "127.0.0.1";
//$servername1 = "myorivindb.c6sfsnaqalji.ap-south-1.rds.amazonaws.com";
$servername1 = "mydbserver.hostdude.org";
$username1 = "univcart";
$password1 = "0c675rdhcgj8e73de4897ea1876511c1";
$dbname1 = "univcart";
$con=mysqli_connect($servername1, $username1, $password1, $dbname1);if (!$con) {    die('Could not connect: ' . mysqli_error());}
$tz = "330";
$_SERVER['REMOTE_ADDR'] = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];
$ipadd = $_SERVER['REMOTE_ADDR'];
$timestamp = mysqli_fetch_assoc(mysqli_query($con, "select (NOW() + INTERVAL '$tz' MINUTE) AS time"))['time'];
?>