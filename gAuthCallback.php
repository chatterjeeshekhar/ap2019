<?php
require 'web/connect.php';
session_start();
if(isset($_SESSION['login_user'])){
//exit(header("location: home.php"));
}

// Holds the Google application Client Id, Client Secret and Redirect Url
require_once('web/gAuthMeta.php');

// Holds the various APIs involved as a PHP class. Download this class at the end of the tutorial
require_once('web/google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);

		// Access Tokem
		$access_token = $data['access_token'];
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($access_token);

		//echo '<pre>';print_r($user_info); echo '</pre>';
		$email = $user_info["emails"][0]["value"];
		//echo substr($email, -14);
		if(substr($email, -14) == "@ashoka.edu.in"){
			//echo "Yes";
			// Authentical Successful
            if(mysqli_num_rows(mysqli_query($con, "select id from users where email='$email'"))==0){
            	//Register an account

            	//Variables
            	$id = $user_info["id"];
            	$fname = $user_info["name"]["givenName"];
            	$lname = $user_info["name"]["familyName"];
            	$picture = $user_info["image"]["url"];
            	//Variables end
            	//echo '<pre>';print_r($user_info); echo '</pre>';
            	$isql = "insert into users (gAuthid, f_name, l_name, email, picture, created) VALUES ('".$id."', '".$fname."', '".$lname."', '".$email."', '".$picture."', '".$timestamp."')";
                echo $isql;
            	if(mysqli_query($con, $isql)){
            		if(!isset($_SESSION)){ 
        					session_start(); 
    				}
    				$_SESSION['login_user'] = $id;
    				$_SESSION['email'] = $email;
                    mysqli_query($con, "insert into loginlog (gAuthid, ip, timestamp) VALUES ('".$id."', '".$ipadd."', '".$timestamp."')");
                    @header('location: firstlogin.php');
            	}
            }
            else {
            	if(mysqli_fetch_assoc(mysqli_query($con, "select active from users where email='$email'"))['active']!="1"){
                        die("Account is Suspended");
            	}
            	//Sign-In
            	if(mysqli_num_rows(mysqli_query($con, "select id from users where email='$email' and active=1"))>0){
            		//echo "Login";
                    if(!isset($_SESSION)){ 
        					session_start(); 
    				}
                    $id = $user_info["id"];
    				$_SESSION['login_user'] = $id;
    				$_SESSION['email'] = $email;
                    //echo $_SESSION['email'];
                    mysqli_query($con, "insert into loginlog (gAuthid, ip, timestamp) VALUES ('".$id."', '".$ipadd."', '".$timestamp."')");
                    @header('location: home.php');
            	}
            }

			//Authentical Ends
		}
		else {
			@header('location: invalid.php');
		}

		// Now that the user is logged in you may want to start some session variables
		//$_SESSION['logged_in'] = 1;

		// You may now want to redirect the user to the home page of your website
		// header('Location: home.php');
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}
?>