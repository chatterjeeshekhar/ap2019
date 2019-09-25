<?php
include 'session.php';
if(mysqli_fetch_assoc(mysqli_query($con, "select active from users where gAuthid='".$_SESSION['login_user']."'"))['active']==0){
    @header('location: /logout.php?suspended=1');
  }
//include 'web/checkfirstlogin.php';
//echo $_SESSION['login_user'];
//include 'web/fbconfig.php';

function ttw($t){
	return date("F jS", strtotime($t))." ".substr($t, 11);
}
function ttw2($t){
	return date("F jS Y", strtotime($t))." ".substr($t, 11);
}
/*$ashokaemail = mysqli_fetch_assoc(mysqli_query($con, "select ashokaemail from users where fbid='".$_SESSION['login_user']."'"))['ashokaemail'];
if(($_SESSION['city']=="" || $_SESSION['country']=="" || $_SESSION['birthday']=="--" || $_SESSION['email']=="" || (($ashokaemail=="" || !strpos($ashokaemail, '@ashoka.edu.in')!==false) && $_SESSION['class']<=$lastyear)) && basename($_SERVER['PHP_SELF'])!="settings.php" && basename($_SERVER['PHP_SELF'])!="firstsignin.php"){
  @header("location: /settings.php");
}
if(mysqli_fetch_assoc(mysqli_query($con, "select deactivate from users where fbid='".$_SESSION['login_user']."'"))['deactivate']==1){
  header("location: /logout.php?loc=1");  
}*/
?>
<head>
	<title>
    <?php
    if($title!=""){
      echo $title." - ";
    }
    ?>Ashoka University</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link href='favicon.png' rel="shortcut icon" type="image/x-icon">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#BF2828">
	<!--<meta http-equiv="refresh" <?php echo 'content="'.$sessiontimeout.';URL=/logout.php?sto=1"';?>>-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link href="assets/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
  <script src="assets/js/modals/bootstrap-dialog.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
  <link href="assets/css/listing.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script>
	function helpguide(sc){
           BootstrapDialog.show({
            title: 'Virtual Assistant',
            message: sc,
            type: BootstrapDialog.TYPE_WARNING,
            buttons: [{label: 'Close',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
      }
	$(document).ready(function() {
    $('#dataTables-example').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
    $('#dataTables-example2').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
    $('#dataTables-example3').DataTable( {
        "order": [[ 0, "asc" ]]
    } );
} );
	</script>
	<style>
	.body {
		padding-left: 50px;
		padding-right: 50px;
	}
	.profilepic {
		border-radius: 10em;
	}
	@media screen and (max-width: 766px) {
			.mainlogo {
			width: 100%;
		}
    body{
      margin-bottom: 50px;
    }
    .navbar-brand {
      display: block;
    }
	}
  @media screen and (min-width: 766px) {
    .navbar-brand {
      display: none;
    }
  }
	</style>
	 <script>
                  jQuery(function ($) {
                            var anhour = <?php echo "(".$sessiontimeout.")-1,";?>
                              display = $('#time1');
                              startTimer(anhour, display);
                            });
                  function startTimer(duration, display) {
                          var timer = duration, minutes, seconds;
                          setInterval(function () {
                              minutes = parseInt(timer / 60, 10)
                              seconds = parseInt(timer % 60, 10);

                              minutes = minutes < 10 ? "0" + minutes : minutes;
                              seconds = seconds < 10 ? "0" + seconds : seconds;

                              display.text(minutes + ":" + seconds);

                              if (--timer < 0) {
                                  timer = duration;
                               }
                                }, 1000);
                            }

                  </script>

</head>
<div class="topbar" style="vertical-align:middle;width:100%;background-color:#BF2828;height:30px;text-align:right;"><span style="text-align:right;padding-right:50px;vertical-align:middle;color:white">Developed by <a href="https://shekharchatterjee.com/" style="color:white">Shekhar Chatterjee</a></span></div>
<div class="body">
	<a href="/"><img src="assets/img/logo-300x125.png" class="mainlogo"></a><br>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
    	<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand">Navigation</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li <?php if(basename($_SERVER['PHP_SELF'])=="home.php") {echo 'class="active"';} ?>><a href="/"><i class="fa fa-home"></i> Home</a></li>
      <!--<li <?php if(basename($_SERVER['PHP_SELF'])==".php") {echo 'class="active"';} ?>><a href="/move_in.php"><i class="fa fa-suitcase"></i> Moving In</a></li>-->
      <li <?php if(basename($_SERVER['PHP_SELF'])=="books.php") {echo 'class="active"';} ?>><a href="/books.php"><i class="fa fa-book"></i> Books</a></li>
      <li <?php if(basename($_SERVER['PHP_SELF'])=="shop.php") {echo 'class="active"';} ?>><a href="/shop.php"><i class="fa fa-shopping-cart"></i> Items</a></li>
      <!--<li <?php if(basename($_SERVER['PHP_SELF'])=="books.php") {echo 'class="active"';} ?>><a href="/books.php"><i class="fa fa-book"></i> Book Exchange</a></li>-->
      <li <?php if(basename($_SERVER['PHP_SELF'])=="food.php") {echo 'class="active"';} ?>><a href="/food.php"><i class="fa fa-birthday-cake"></i> Food</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li <?php if(basename($_SERVER['PHP_SELF'])=="cart.php") {echo 'class="active"';} ?>><a href="/cart.php"><i class="fa fa-cart-plus"></i> Cart</a></li>
      <li <?php if(basename($_SERVER['PHP_SELF'])=="orders.php") {echo 'class="active"';} ?>><a href="/orders.php"><i class="fa fa-cart-plus"></i> My Orders</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF'])=="listings.php" || basename($_SERVER['PHP_SELF'])=="new.php") {echo 'class="active"';} ?>><a href="/listings.php"><i class="fa fa-list"></i> My Listings</a></li>
      <li class="dropdown" style="cursor:pointer;">
        <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bookmark-o"></i> <?php echo $_SESSION['f_name']." ".$_SESSION['l_name'];?>  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/settings.php"><i class="fa fa-gears"></i> Settings</a></li>
            <li><a href="https://www.facebook.com/chatterjeeshekhar" target="_new"><i class="fa fa-question"></i> Suggestions</a></li>
            <li><a href="/logout.php"><i class="fa fa-sign-in"></i> Log Out</a></li>
          </ul>
        </li>
    </ul>
</div>
  </div>
</nav>