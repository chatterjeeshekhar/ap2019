<?php
$title = "Items for Sale";
include 'web/header.php';
?>
<div class="col-md-14">
	<?php
		$r = mysqli_query($con, "select * from listings where type='item' and active=1 and endtime>'".strtotime($timestamp)."' ORDER BY starttime DESC");
		$cnt = mysqli_num_rows($r)-1;
		$k = 0;
		while($a = mysqli_fetch_assoc($r)){
			?>
			<div class="col-md-2">
						<div class="w3-content w3-display-container">	
							<?php 
								$img = $a['images'];
								$img = explode(", ",$img);
								$imgn = count($img);
								for($i=0; $i<$imgn; $i++){
									?>
									<a style="text-decoration:none;" <?php echo 'href="/openlisting.php?id='.$a['uniquekey'].'"';?>>
										<?php 
									echo '<img class="mySlides'.$k.'" id="mySlides" src="/uploads/'.$a['uniquekey']."/".$img[$i].'" width="100%" height="250px;"></a>';
								}
								if($imgn>1){
								?>
							<button class="w3-button w3-black w3-display-left" <?php echo 'onclick="plusDivs(-1, '.$k.')"';?>>&#10094;</button>
  							<button class="w3-button w3-black w3-display-right" <?php echo 'onclick="plusDivs(1, '.$k.')"';?>>&#10095;</button>
  							<?php } ?>
						</div><br>
						<justify><font size="-1"><a style="text-decoration:none;" <?php echo 'href="/openlisting.php?id='.$a['uniquekey'].'"';?>><?php echo $a['title']; ?></a><br></font>
						<font color="green" size="+2" style="font-weight:bold;font-family:Arial;">INR <?php echo number_format($a['price']); ?></font><br>
						<?php 
						$cndn = "";
						switch ($a['condtn']) {
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
						?>
						<font color="brown" face="Arial"><?php echo $cndn;?></font>
					</div>
			<?php
		$k = $k+1;
		}
	?>
</div>
<script>
var slideIndex = 1;
for (var l = 0; l<=<?php echo $cnt;?>; l++){
	defaultDivs(slideIndex, l);
}

function defaultDivs(n, l) {
  var i;
  var x = document.getElementsByClassName("mySlides"+l);
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

function plusDivs(n, l) {
  showDivs((slideIndex += n), l);
}

function showDivs(n, l) {
  var i;
  var x = document.getElementsByClassName("mySlides"+l);
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>