<?php
include '../session.php';
$id = $_REQUEST['id'];
if(mysqli_num_rows(mysqli_query($con, "select id from cart where user='".$_SESSION['email']."' and id='$id'"))>0){
	if(mysqli_query($con, "delete from cart where user='".$_SESSION['email']."' and id='$id'")){
		echo "Y";
	}
}
?>