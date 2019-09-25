<?php
error_reporting(0);
include 'web/connect.php';

//debug_backtrace() || die (header("location: logout.php"));
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

  if(!isset($_SESSION)) 
    { 
        session_start();
        
    } 
// Storing Session
//Inactivity timeout
if (!isset($_SESSION['lastupdate'])) {
    $_SESSION['lastupdate'] = time();
} else if (time() - $_SESSION['lastupdate'] >= ($sessiontimeout+2)) {
    //session_destroy();
    //@header('Location: logout.php?sto=1'); // Redirecting To login Page
}
//Inactivity timeout


$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
// NULL VARIABLES
// NULL END
$ses_sql=mysqli_query($con,"select * from users where gAuthid='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
if($user_check == NULL){exit(header("location: logout.php"));}
//GLOBAL VARIABLES
$login_session =$row['gAuthid'];

$_SESSION['nonce'] = $nonce = md5('salt'.microtime());
$_SESSION['email'] =$row['email'];
$_SESSION['l_name'] =$row['l_name'];
$_SESSION['f_name'] =$row['f_name'];
$_SESSION['username'] =$row['username'];
$_SESSION['class'] =$row['class'];
$_SESSION['prog'] =$row['programme'];
$_SESSION['active'] =$row['active'];
$_SESSION['firstlogin'] =$row['firstlogin'];
$active = $_SESSION['active'];
//$_SESSION['register'] =$row['register'];
//$_SESSION['lastlogin'] =$row['lastlogin'];

/*$main_sql = mysqli_fetch_assoc(mysqli_query($con, "select * from main"));
$_SESSION['mainactive'] = $main_sql['active'];
$_SESSION['systemalert'] = $main_sql['alert'];
$_SESSION['homepopup'] = $main_sql['homepopup'];
$_SESSION['supportemail'] = $main_sql['supportemail'];
$_SESSION['newcase'] = $main_sql['newcase'];
$_SESSION['mapsjsapi'] = $main_sql['mapsjsapi'];*/
//$devs = mysqli_num_rows(mysqli_query($con, "select id from developers where user='".$_SESSION['login_user']."' and stat=1"));

if($_SESSION['locked']==""){
	$_SESSION['locked'] = 1;
}

if($_SESSION['firstlogin']==1 && basename($_SERVER['PHP_SELF'])!="firstlogin.php")
header('location: firstlogin.php');

if($_SESSION['active'] == "0"){
@header('Location: logout.php'); // Redirecting To login Page
}

// END
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
unset($_SESSION['login_user']);
header('Location: index.php'); // Redirecting To Home Page
}
if(basename($_SERVER['PHP_SELF']) == "session.php") {
header('location: /home.php');
}
?>