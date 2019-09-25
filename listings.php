<?php
$title = "My Listings";
include 'web/header.php';
?>
<div class="col-md-12">
	<h3>My Listings <a href="/new.php" class="btn btn-success"><i class="fa fa-plus"></i> Create New Listing</a></h3>
	<?php
		$r = mysqli_query($con, "select * from listings where user='".$_SESSION['email']."' ORDER BY starttime DESC");
		if(mysqli_num_rows($r)==0){ ?>
			<div class="col-md-14" style="height:25%;background-color:#E6E6E6;border-radius: 0.5em;font-size:18px;">
				<p style="position: relative;float: left; top: 50%; left: 50%; transform: translate(-50%, -50%);">You do not seem to have any listing</p>
			</div>
		<?php } else {
		$i = 1; ?>
			<div class="col-md-14">
				<div class="table-responsive">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" >
						<thead>
							<th>#</th>
							<th>Type</th>
							<th>Title</th>
							<th>Images</th>
							<th>Condition</th>
							<th>Duration</th>
							<th>Expiry</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Left</th>
							<th>Status</th>
							<th>Edit</th>
						</thead>
						<tbody>
							<?php
								while($a = mysqli_fetch_assoc($r)){
									if(strtotime($timestamp)>$a['endtime'] || $a['active']==0){
										echo '<tr style="background-color:#FABEBE;">';
									}
									else if($a['qty']==0){
										echo '<tr style="background-color:#D4D490;">';
									}
									else {
										echo "<tr>";		
									}
									echo "<td>".$i."</td>";
									echo "<td>".ucfirst($a['type'])."</td>";
									echo "<td>".substr($a['title'], 0, 45)."..</td>";
									echo "<td>";
									$img = explode(", ", $a['images']);
									echo '<a href="/openlisting.php?id='.$a['uniquekey'].'"><img src="/uploads/'.$a['uniquekey'].'/'.$img[0].'" width="75" height="100"></a>';
									echo "</td>";
									echo "<td>";
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
									echo $cndn;
									echo "</td>";
									echo "<td>".$a['duration']." day(s)</td>";
									echo "<td>".date("d-m-Y", $a['endtime'])."</td>";
									echo "<td>".number_format($a['price'])."</td>";
									echo "<td>";
									if($a['qty']>0)
										echo $a['qty'];
									else
										echo '<font color="red"><b>'.$a['qty'].'</b></font>';
									echo "</td>";
									echo "<td>";
									if($a['leftqty']>0)
										echo $a['leftqty'];
									else
										echo '<font color="red"><b>'.$a['leftqty'].'</b></font>';
									echo "</td>";
									echo "<td>";
									if($a['active']==1){
										if(strtotime($timestamp)>$a['endtime']){
											echo "Expired";
										}
										else {
											echo "Active";
										}
									}
									else {
										echo "Suspended";
									}
									echo "</td>";
									echo '<td><a href="/editlisting.php?id='.$a['uniquekey'].'" class="btn btn-success btn-lg"><i class="fa fa-pencil-square-o"></i></a></td>';
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