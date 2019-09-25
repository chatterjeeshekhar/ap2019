<?php
include 'session.php';
setlocale(LC_MONETARY, 'en_IN');
//$i = $_REQUEST['id'];
$title = "Your Cart";
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
		document.getElementById("total").value = p*q;
	}
}
</script>
<body onload="onload()">
<div class="col-md-12">
	<div class="col-md-12">
		<h3>Shopping Cart</h3><br>
			<?php 
			$sql = "select c.itemid, c.id, c.qty, l.type, l.title, l.price from cart c, listings l where c.user='".$_SESSION['email']."' and l.uniquekey=c.itemid and l.endtime>'".strtotime($timestamp)."' and c.qty<=l.qty and c.qty<=l.leftqty";
			$mr = mysqli_query($con, $sql);
			//echo $sql;
			if(mysqli_num_rows($mr)>0 || 1==2) { ?>
			<div class="col-md-14">
				<div class="table-responsive">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" >
						<thead>
							<th>#</th>
							<th><i class="fa fa-link"></i></th>
							<th>Type</th>
							<th>Title</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Total</th>
							<th>Remove</th>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$amt = 0;

			while($r = mysqli_fetch_assoc($mr)){
			
									echo "<tr>";		
									echo "<td>".$i."</td>";
									echo '<td><a class="btn btn-primary" href="/openlisting.php?id='.$r['itemid'].'"><i class="fa fa-eye"></i></a>';
									echo "<td>".ucfirst($r['type'])."</td>";
									echo "<td>".ucwords(strtolower($r['title']))."</td>";
									echo "<td>".money_format('%!i', $r['price'])."</td>";
									echo "<td>".$r['qty']."</td>";
									echo "<td>".money_format('%!i', ($r['price']*$r['qty']))."</td>";
									echo '<td><button class="btn btn-danger" onclick="removeItem('.$r['id'].')"><i class="fa fa-times-rectangle-o"></i> Drop</button></td>';
									echo "</tr>";
									$i++;
									$amt = $amt + ($r['price']*$r['qty']); 
							?>
						
			<?php } ?> 
			</tbody>
					</table>
					<script type="text/javascript">
					function removeItem(i){
						
					BootstrapDialog.confirm({
            title: 'Remove',
            message: 'Warning! Drop your item from Cart?',
            type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
            btnOKLabel: 'Drop it!', // <-- Default value is 'OK',
            btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
                    	$.get("/ajax/removeItem.php?id="+i, function(data){
				               		if(data=="Y"){location.reload();}	
				               	});
                }else {
                    //alert('Nope.');
                }
            }
        });
				}
					</script>
				</div>
			</div>
			<div class="col-md-14 align-right"><h4><strong>Sub-Total: <?php echo money_format('%!i', $amt);?></strong></h4></div>
			<form action="/make-payment.php" method="post">
			<h3>Delivery Address</h3>
			<div class="row">
				<div class="col-md-1">Location </div><div class="col-md-6"><input type="text" class="form-control" placeholder="Delivery Location (Room No, Building)"></div>
			</div>
			<h3>Payment Method</h3>
			<input type="radio" name="payment" disabled="true"> Credit/Debit Cards  
			<input type="radio" name="payment" disabled="true"> Net Banking  
			<input type="radio" name="payment" checked="true"> Cash on Delivery	 <br>
			<br>
			<div class="row">
				<div class="col-md-12">
					<right><button class="btn btn-primary btn-lg" type="submit" name="submit" value="submit">Proceed to Payment</button></right>
				</div>
			</div>
			</form>
			<br>

			
			<?php } else { ?>
			<div class="col-md-14" style="height:25%;background-color:#E6E6E6;border-radius: 0.5em;font-size:18px;">
				<p style="position: relative;float: left; top: 50%; left: 50%; transform: translate(-50%, -50%);">Your Shopping Cart is empty</p>
			</div>
			<?php } ?>
	</div>
</div>