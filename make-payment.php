<?php
include 'session.php';
$q = mysqli_query($con, "select * from cart where user='".$_SESSION['email']."'");
if(mysqli_num_rows($q)>0){
	while($r = mysqli_fetch_assoc($q)){
		$leftqty = mysqli_fetch_assoc(mysqli_query($con, "select leftqty from listings where uniquekey='".$r['itemid']."'"))['leftqty'];
		$aqty = mysqli_fetch_assoc(mysqli_query($con, "select qty from listings where uniquekey='".$r['itemid']."'"))['qty'];
		if($r['qty']>$leftqty){
			$qty = $leftqty;
		} else {
			$qty = $r['qty'];
		}
		$orderid = rand(1000000, 9999999);
		while(mysqli_num_rows(mysqli_query($con, "select id from orders where orderid='$orderid'"))>0){
			$orderid = rand(1000000000, 9999999999);
		}
		$price = $r['qty']*mysqli_fetch_assoc(mysqli_query($con, "select price from listings where uniquekey='".$r['itemid']."'"))['price'];
		if(mysqli_query($con, "insert into orders (user, orderid, itemid, qty, amount, timestamp) VALUES ('".$_SESSION['email']."', '$orderid', '".$r['itemid']."', '".$r['qty']."', '$price', '$timestamp')")){
			//mysqli_query($con, "update listings set leftqty=leftqty-$qty where uniquekey='".$r['itemid']."'");
			mysqli_query($con, "delete from cart where user='".$_SESSION['email']."' and itemid='".$r['itemid']."'");
		}
		//echo $r['itemid']." ".$qty."<br>";

	}
	@header("location: /orders.php");
} else {
	@header("location: /");
}
