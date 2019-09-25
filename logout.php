<?php
if($_REQUEST['sto']==1){
	include 'session.php';
if(session_start()) // Destroying All Sessions
	{
		session_destroy();
		header("Location: index.php?sto=1"); // Redirecting To Home Page
	}
}
else if($_REQUEST['loc']==1){
	include 'session.php';
if($_SESSION['login_user']!=""){
mysqli_query($con, "update users set deactivate=1 where fbid='".$_SESSION['login_user']."'");
}
if(session_start()) // Destroying All Sessions
	{
		session_destroy();
		header("Location: index.php?loc=1"); // Redirecting To Home Page
	}
}
else{
	session_start();
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: index.php"); // Redirecting To Home Page
	}	
}
?>