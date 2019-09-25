<?php
include 'session.php';
$d = $_POST;
if($d['submit']=="add-to-cart"){
		$id = $d['itemid'];
		$qty = $d['qty'];
		$leftqty = mysqli_fetch_assoc(mysqli_query($con, "select leftqty from listings where uniquekey='$id'"))['leftqty'];
	if(mysqli_num_rows(mysqli_query($con, "select id from cart where user='".$_SESSION['email']."' and itemid='".$id."'"))==0){
		if($qty<=$leftqty){
			if(mysqli_query($con, "insert into cart (user, itemid, qty, timestamp) VALUES ('".$_SESSION['email']."', '$id', '$qty', '$timestamp')")){
				@header("location: /cart.php");
			}
		}
	} else {
		$r = mysqli_fetch_assoc(mysqli_query($con, "select * from cart where user='".$_SESSION['email']."' and itemid='".$id."'"));
		$newqty = $r['qty']+$qty;//$curqty
		if($newqty>$leftqty){
			$newqty = $leftqty;
		}
		if(mysqli_query($con, "update cart set qty='$newqty' where user='".$_SESSION['email']."' and itemid='".$id."'")){
			@header("location: /cart.php");
		}
	}
}
?>