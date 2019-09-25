<?php
$title = "My Orders";
include 'web/header.php';
?>
<div class="col-md-12">
	<h3>My Orders</h3>
	<?php
	$sql = "select o.itemid, o.orderid, o.itemid, o.status, o.qty, l.type, l.title, l.images, l.price, o.timestamp  from orders o, listings l where o.itemid=l.uniquekey and o.user='".$_SESSION['email']."' ORDER BY timestamp DESC
";
	//echo $sql;
		$r = mysqli_query($con, $sql);
		if(mysqli_num_rows($r)==0){ ?>
			<div class="col-md-14" style="height:25%;background-color:#E6E6E6;border-radius: 0.5em;font-size:18px;">
				<p style="position: relative;float: left; top: 50%; left: 50%; transform: translate(-50%, -50%);">You do not seem to have any orders as of now</p>
			</div>
		<?php } else {
		$i = 1; ?>
			<div class="col-md-14">
				<div class="table-responsive">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" >
						<thead>
							<th>#</th>
							<th>OrderID</th>
							<th>Link</th>
							<th>Title</th>
							<th>Images</th>
							<th>Timestamp</th>
							<th>Rate</th>
							<th>Qty</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Open</th>
						</thead>
						<tbody>
							<?php
								while($a = mysqli_fetch_assoc($r)){
									echo "<tr>";
									echo "<td>".$i."</td>";
									echo "<td>".$a['orderid']."</td>";
									echo '<td><a class="btn btn-primary" href="/openlisting.php?id='.$a['itemid'].'"><i class="fa fa-eye"></i></a></td>';
									echo "<td>".ucfirst($a['type'])."</td>";
									echo "<td>".substr($a['title'], 0, 45)."..</td>";
									/*echo "<td>";
									$img = explode(", ", $a['images']);
									echo '<a href="/openlisting.php?id='.$a['uniquekey'].'"><img src="/uploads/'.$a['itemid'].'/'.$img[0].'" width="75" height="100"></a>';
									echo "</td>";*/
									//echo "<td>".$a['timestamp']."</td>";
									echo "<td>".date("d-m-Y", strtotime($a['timestamp']))."</td>";
									echo "<td>".number_format($a['price'])."</td>";
									echo "<td>".$a['qty']."</td>";
									echo "<td>".number_format($a['price']*$a['qty'])."</td>";
									echo "<td>";
									if($a['status']==1){echo "Pending";}if($a['status']==0){echo "Cancelled";}if($a['status']==2){echo "Confirmed";}echo "</td>";
									echo '<td><a href="/open-order.php?id='.$a['orderid'].'" class="btn btn-success btn-lg"><i class="fa fa-eye"></i></a></td>';
									echo "</tr>";
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php } ?>
</div>