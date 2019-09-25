<?php
include 'session.php';
$i = $_REQUEST['id'];
$row = mysqli_query($con, "select l.*, u.* from listings l, users u where u.email=l.user and l.uniquekey='$i'");
if(mysqli_num_rows($row)==0){
	header('location: /');	
}
$p = mysqli_fetch_assoc($row);
$title = $p['title'];
include 'web/header.php';
?>

<div class="col-md-14">
	<div class="col-md-3"><br>
		<div class="w3-content w3-display-container">
		<?php 
								$img = $p['images'];
								$img = explode(", ",$img);
								$imgn = count($img);
								for($i=0; $i<$imgn; $i++){
									echo '<img class="mySlides" src="/uploads/'.$p['uniquekey']."/".$img[$i].'" width="100%" height="400px;">';
								}
								if($imgn>1){
								?>
								<button class="w3-button w3-black w3-display-left" <?php echo 'onclick="plusDivs(-1)"';?>>&#10094;</button>
  							<button class="w3-button w3-black w3-display-right" <?php echo 'onclick="plusDivs(1)"';?>>&#10095;</button>
  							<?php } ?>
	</div>
	<script>
	$(document).ready(function(){
		$("#conddesc").hide();
});
var slideIndex = 1;
	showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

function viewcondn(){
	$("#conddesc").toggle(300);
}
</script>
</div>
	<div class="col-md-9">
		<h3><b><?php echo $p['title']; ?></b></h3>
		<div onmouseover="this.style.background='#CFD3FF';" onmouseout="this.style.background='#FFE796';" style="border:200px;border-color:#F50000;background:#FFE796;padding:15px;border-radius:0.3em;display:inline-block;" onhover><font color="green" size="+2" style="font-weight:bold;font-family:Arial;">INR <?php echo number_format($p['price']); ?></font>
		</div>
		<?php if($p['type']!="food"){
						$cndn = "";
						switch ($p['condtn']) {
							case '1':
								$cndn = "Brand New";break;
							case '2':
								$cndn = "Like New";break;
							case '3':
								$cndn = "Very Good";break;
							case '4':
								$cndn = "Good";break;
							case '5':
								$cndn = "Acceptable";break;
							
							default:
								$cndn = "";break;
						}
						?><br><hr>
						<?php } ?>
						<font color="brown" size="+1" style="font-weight:bold;" face="Arial"><?php echo $cndn;?></font><?php if($p['condtn']!=1){ ?><br>
						<a onclick="viewcondn()" style="cursor:pointer;">(Click here for condition description)</a>
						<p id="conddesc"><Br><?php echo $p['conddesc'];?></p>
						<?php } ?>
						<hr>
						<a class="btn btn-primary btn-lg" <?php if(strtotime($timestamp)>=$p['endtime'] || $p['leftqty']<1){echo 'title="The listing has expired or is Out of Stock" disabled="true"';} else {echo 'href="/buynow.php?id='.$p['uniquekey'].'"';}?>><i class="fa fa-shopping-cart"></i> Buy Now</a> 
						<?php if($p['leftqty']>0){ echo '<font color="green" size="4"><b>Stock Left: '.$p['leftqty'].' of '.$p['qty'].'</b></font>';} else {
							echo '<font color="red"><b>(Out of Stock)</b></font>';}?>
						
						<hr>
						<h4><b>Listing expires in:</b></h4>
						<?php

			$endtime = date('Y-m-d H:i:s', $p['endtime']);;
			$endtime = strtotime($endtime);
			$cdt = date("F", $endtime)." ".date("d", $endtime).", ".date("Y", $endtime)." ".date("H:i:s", $endtime);
			//$title = "HUII Conference 2018";
			if(strtotime($timestamp)<$endtime){
			?>
						
						<div class="countdown styled" id="mycountdown"></div>
						<?php } else { echo "Expired";}?>

	</div>
</div><br><br>
<div class="row">
	<div class="col-md-9">
<h4><b>Listing Description</b></h4>
	<style>
	.description {
		background-color: white;
		border: 0px;
		scrolling: none;
		font-family: Arial;
		word-break: keep-all;
		white-space: nowrap;
		overflow-x: auto;
		display: inline-block;

	}
	</style>
		<pre style="padding-left:5%;" class="description">
		<?php echo ($p['description']);?><br>
	</pre>
</div><div class="col-md-3">
<h4><b>Delivery</b></h4>
		<p style="padding-left:5%;" align="justify"><?php echo $p['delivery'];?></p><br>
		<h4><b>Seller Information</b></h4><div style="padding-left:5%;">
		<b>Name:</b> <?php echo $p['f_name']." ".$p['l_name'];?><br>
				<b>Programme:</b> <?php echo strtoupper($p['programme']);?><br>
				<b>Entering Year:</b> <?php echo $p['class'];?></div><br><Br>
			</div>
			</div>
				<style>
				.countdown {
//text-align:center;
}
.styled{
  padding: 00px 0 20px;
  display: block;
  //float: center;
}
.bottomcountdown {
	color: white;
	text-shadow: 2px 0 0 #000, -2px 0 0 #000, 0 2px 0 #000, 0 -2px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
}
.countdownheader {
	text-align: center;
	color: #fff;
	//text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
	display: inline-block;font-size: 30px;font-weight:400;
}
.styled div {color: #000;
	display: inline-block;font-size: 20px;font-weight: 400;text-align: center;margin: 0 1px;width: 90px;padding: 10px 30px 53px;height: 70px;/* background: rgba(255, 255, 255, 0.18); */}
	@media screen and (max-width: 766px) {
			.styled div {color: #000;
	display: inline-block;font-size: 20px;font-weight: 400;text-align: center;margin: 0 1px;width: 100px;padding: 10px 30px 53px;height: 140px;/* background: rgba(255, 255, 255, 0.18); */}
	}
.styled div:last-child{/* border:none; */}
/* IE7 inline-block hack */
*+html .styled div{
  display: inline;
  zoom: 1;
}
.styled div:first-child {
  margin-left: 0;
}
.styled div span {display: block;padding-top: 3px;font-size: 17px;font-weight: 400;text-align: center;}
@media(max-width:768px){
	.styled div {
	  margin-bottom:10px; 
	  font-size:34px;
	      font-size: 68px;
	}
	.styled div:nth-child(2){
		/* border-right:none; */
	}
	.styled div span{
		font-size:14px;
	}
}
				</style>
				<script type="text/javascript" src="https://www.smartcitizen.in/assets/js/jquery.countdown.js"></script>
				<script src="https://www.smartcitizen.in/assets/js/rAF.js"></script>
				<script type="text/javascript">
				/*
					Author: Shekhar Chatterjee
					Author URL: https://shekharchatterjee.com 
					*/
					$( function() {
					// Add background image
						//$.backstretch('images/road2.jpg');
						var endDate = <?php echo '"'.$cdt.'"';?>;
						$('.countdown.simple').countdown({ date: endDate });
						$('.countdown.styled').countdown({
						  date: endDate,
						  render: function(data) {
							$(this.el).html("<div>" + this.leadingZeros(data.days, 2) + " <span>DAYS</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>HOURS</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>MINUTES</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>SECONDS</span></div>");
						  },
						  onEnd: function() {
							//$(this.el).addClass('ended');
							window.location.reload();
						  }
						});
						$('.countdown.callback').countdown({
						  date: +(new Date) + 10000,
						  render: function(data) {
							$(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
						  },
						  onEnd: function() {
							$(this.el).addClass('ended');
						  }
						}).on("click", function() {
						  $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
						});

					});
				</script>