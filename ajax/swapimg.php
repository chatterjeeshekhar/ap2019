<?php
include '../session.php';
$id = $_REQUEST['id'];
$a = $_REQUEST['a'];
$b = $_REQUEST['b'];
$t = $_REQUEST['t'];
$img = mysqli_fetch_assoc(mysqli_query($con, "select images from listings where uniquekey='$id'"))['images'];
//echo $img."<br>";
$img = explode(", ", $img);
if($t==1){
	if($a>0 && $b<=count($img)){
		$a = $a-1;
		$b = $b-1;
		$temp = $img[$a];
		$img[$a] = $img[$b];
		$img[$b] = $temp;
		$img = implode(", ", $img);
		if(mysqli_query($con, "update listings set images='$img' where uniquekey='$id'")){
			echo "Swaped";
		}
	}
}
else if($t==2){
	$a = $a-1;
	unlink(dirname(__FILE__) ."/uploads/".$id."/".$img[$a]);
	unset($img[$a]);
	$img = implode(", ", $img);
	if(mysqli_query($con, "update listings set images='$img' where uniquekey='$id'")){
			//echo "Swaped";
	}
}
?>