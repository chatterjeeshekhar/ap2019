<?php
require 'web/connect.php';
session_start();
if(isset($_SESSION['login_user'])){
exit(header("location: home.php"));
}
require_once('web/gAuthMeta.php');
$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';
?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<meta name="google-signin-client_id" content="1005012015966-ekp0er4iu0kipgnjque2o7dp8gcgk2uc.apps.googleusercontent.com">
</head>
<body>
  <a style="text-decoration:none;" id="customBtn" <?php echo 'href="'.$login_url.'"'; ?> class="customGPlusSignIn">
      <span class="icon"></span>
      <span class="buttonText">Google</span></a>
  <script>

    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark'
      });
    }
  </script>
<style type="text/css">
    body {
      padding-top: 100px;
    }
    #customBtn {
      display: inline-block;
      background: white;
      color: #444;
      width: 190px;
      border-radius: 5px;
      border: thin solid #888;
      box-shadow: 1px 1px 1px grey;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
    span.icon {
      background: url('https://developers.google.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;
      padding-left: 42px;
      padding-right: 42px;
      font-size: 14px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;
    }
  </style>
  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
</body>
</html>