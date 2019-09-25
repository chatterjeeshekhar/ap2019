<?php
include 'session.php';
$i = $_REQUEST['id'];
$row = mysqli_query($con, "select l.*, u.* from listings l, users u where u.email=l.user and l.uniquekey='$i' and l.endtime>'".strtotime($timestamp)."'");
if(mysqli_num_rows($row)==0){
	header('location: /');	
}
$p = mysqli_fetch_assoc($row);
$title = "Buy Now - ".$p['title'];
include 'web/header.php';
?>
<script>
function onload(){
	$("[type='number']").keypress(function (evt) {
    evt.preventDefault();
	});
	calctotal();
}
function calctotal(){
	var p = document.getElementById("price").value;
	var q = document.getElementById("qty").value;
	if(q>0){
		document.getElementById("total").innerHTML = p*q;
	}
}
</script>
<body onload="onload()">
<div class="col-md-12">
	<div class="col-md-6">
		<h3>Buy Now</h3><br>
		<form action="/add-to-cart.php" method="post">
			<input tyoe="hidden" name="itemid" value="<?php echo $_REQUEST['id'];?>" type="hidden">
			<div class="row">
				<div class="col-md-3">Title</div>
				<div class="col-md-9"><input class="form-control" value="<?php echo $p['title']; ?>" placeholder="Enter Title of Food Sale (max 12 characters)" required="true" readonly="true"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Price</div>
				<div class="col-md-4"><input class="form-control" type="number" id="price" name="price" value="<?php echo $p['price']; ?>" required="true" placeholder="(Indian Rupees) 0.00" readonly="true"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Quantity</div>
				<div class="col-md-2"><input class="form-control" max="<?php echo $p['leftqty'];?>" type="number" id="qty" name="qty" min="1" onKeyPress="calctotal()" value="1" required="true" placeholder="" onchange="calctotal()" onKeyUp="calctotal()"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Total</div>
				<div class="col-md-4" style="font-size:26"><b>INR <span id="total"></span></b>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-4"><button type="submit" class="btn btn-success btn-lg" name="submit" value="add-to-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
				</div>
			</div>
		</form>
	</div>
</div>