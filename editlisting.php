<?php
include 'session.php';
$id = $_REQUEST['id'];
$row = mysqli_query($con, "select l.*, u.* from listings l, users u where u.email=l.user and l.uniquekey='$id'");
if(mysqli_num_rows($row)==0){
	header('location: /');	
}
$p = mysqli_fetch_assoc($row);
$title = "Edit Listing - ".$p['title'];
include 'web/header.php';
?>
<script>
function onload(){
	document.getElementById("conddesc").style.display = "none";
	conditioncheck();
}
function conditioncheck(){
	var cond = document.getElementById("condition").value;
	if(cond!=1 && cond!=""){
		document.getElementById("conddesc").style.display = "block";
	}
	else {
		document.getElementById("conddesc").style.display = "none";	
	}
}

</script>
 <script src="/js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea',plugins: "code",
  setup: function (editor) {
        editor.on('change', function (e) {
            editor.save();
        });
    } });</script>

<body onload="onload()">
<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">Edit Listing</div>
		<div class="panel-body">
			<div class="row">
			<?php
			//echo $p['images'];
			$img = explode(", ", $p['images']);
			$i = 1;
			for($a=0;$a<count($img);$a++){
				
					echo '<div class="col-md-3"><div class="panel panel-default"><div class="panel-body">';
					echo '<img src="/uploads/'.$p['uniquekey'].'/'.$img[$a].'" width="100%" height="30%"><br><center>';
					if(count($img)>1){
					echo '<button onclick="swapimg('.$i.', '.($i-1).')" class="btn btn-default btn-lg"'; if($a==0){echo 'disabled="true" ';} echo '><i class="fa fa-step-backward"></i></button>';
					echo '<button onclick="swapimg('.$i.', '.($i+1).')" class="btn btn-default btn-lg"'; if($a==(count($img)-1)){echo 'disabled="true" ';} echo '><i class="fa fa-step-forward"></i></button>';
					echo '<button class="btn btn-default btn-lg" onclick="delimg('.$i.')"><i class="fa fa-trash"></i></button>';
					}
					echo '</div></div></div>';
				
				$i++;
			}
			if(count($img)<4){
				echo '<div class="col-md-2"><div class="panel panel-default"><div class="panel-body" style="vertical-align:middle;top:50%;left:50%;text-align:center;">';
				echo '<div ';
				if(count($img)==1){
					echo 'style="padding-top:52%; height:30%; width:100%;"';
				}
				else {
					echo 'style="padding-top:75%; height:36%; width:100%;"';
				}
				echo '><a style="text-decoration:none;cursor:pointer" onclick="uploadimg()"><i width="100%" style="font-size: 5vw;" class="fa fa-plus-circle"></i></a><br><br><b>Upload</b></div>';
				echo '</div></div></div>';
			}
			?>
		</div><br>
		<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
			<div class="row">
				<div class="col-md-3">Title of Food</div>
				<div class="col-md-9"><input class="form-control" name="title" value="<?php echo $p['title']; ?>" placeholder="Enter Title of Food Sale (max 12 characters)" required="true"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Sale Description</div>
				<div class="col-md-9"><textarea class="form-control" name="desc" required="true" placeholder="Enter Description of Eatable (Variants Available, Menu, Dimensions, Servings etc)" rows="5"><?php echo $p['description'];?></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Price</div>
				<div class="col-md-9"><input class="form-control" type="number" name="price" value="<?php echo $p['price']; ?>" required="true" placeholder="(Indian Rupees) 0.00"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Quantity</div>
				<div class="col-md-2"><input class="form-control" value="<?php echo $p['qty'];?>" type="number" name="qty" min="0" required="true" placeholder=""></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Condition</div>
				<div class="col-md-9">
					<select class="form-control" name="condition" id="condition" required="true" onchange="conditioncheck()">
						<option value="">--Book Condition--</option>
						<option value="1" <?php if($p['condtn']==1){echo "selected";}?>>Brand New</option>
						<option value="2" <?php if($p['condtn']==2){echo "selected";}?>>Like New</option>
						<option value="3" <?php if($p['condtn']==3){echo "selected";}?>>Very Good</option>
						<option value="4" <?php if($p['condtn']==4){echo "selected";}?>>Good</option>
						<option value="5" <?php if($p['condtn']==5){echo "selected";}?>>Acceptable</option>
					</select>
				</div>
			</div><br>
			<div class="row" id="conddesc">
				<div class="col-md-3">Condition Description</div>
				<div class="col-md-9"><textarea class="form-control" name="conddesc" placeholder="Enter Condition Description here"><?php echo $p['conddesc']; ?></textarea><br></div>
			<br></div>
			<div class="row">
				<div class="col-md-3">Delivery Instructions</div>
				<div class="col-md-9"><textarea class="form-control" name="delivery" placeholder="Dorm Room Delivery or Pick-up (Enter descriptively how you wish to deliver)"><?php echo $p['delivery']; ?></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3" style="text-align:left; vertical-align:middle;"><button type="reset" class="btn btn-default btn-lg">Reset</button></div>
				<div class="col-md-9" style="text-align:right; vertical-align:middle;"><button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">Update <i class="fa fa-chevron-right"></i></div>
			</div><br>
		</form>
		</div>
	</div>
</div>
 <form action="" method="post" id="imgform" enctype="multipart/form-data">
        <input type="hidden" name="action" value="imgupload">  
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
        <input type="file" id="my_file" name="files" style="display:none" onchange="upimg()"/>
      </form>
<script type="text/javascript">
function swapimg(a,b){
	if(b==0 || b><?php echo count($img); ?>){
		alert("False");
	}
	else {
		$.get("/ajax/swapimg.php?t=1&id=<?php echo $id; ?>&a="+a+"&b="+b, function(data){
			location.reload();
		});

	}
}
<?php if(count($img)>1){?>
function delimg(a){
	BootstrapDialog.confirm({
            title: 'Delete',
            message: 'Warning! Delete the Image?',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            btnOKLabel: 'Delete', // <-- Default value is 'OK',
            btnOKClass: 'btn-danger', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
                    $.get("/ajax/swapimg.php?t=2&id=<?php echo $id; ?>&a="+a, function(data){
						location.reload();
					});
                }else {
                    //alert('Nope.');
                }
            }
        });
}
<?php } ?>
 function upimg(){
        $('#imgform').submit();
      }
function uploadimg(){
	$("input[id='my_file']").click();
}
</script>
<?php
if($_POST['action']=="imgupload"){
	$d = $_POST;
	$id = $d['id'];
	if(count($_FILES['files']['name'])==1){
		$errors = array();
		$uploadedFiles = array();
		$extension = array("jpeg","jpg","png","gif");
		$bytes = 1024;
		$KB = 4096;
		$totalBytes = $bytes * $KB;
		//$uniqueKey = md5(rand(1000000,9999999));    
		$UploadFolder = "uploads/".$id."/";
		$counter = 0;
		 
		 $temp = $_FILES["files"]["tmp_name"];
		 $name = $_FILES["files"]["name"];
		 $ext = pathinfo($name, PATHINFO_EXTENSION);
		    if(in_array($ext, $extension) == false){
		        array_push($errors, $name." is invalid file type.");
		    }
		    else {
		    	move_uploaded_file($temp,$UploadFolder."/".$name);
		    	    $images = mysqli_fetch_assoc(mysqli_query($con, "select images from listings where uniquekey='".$id."'"))['images'];
		       		$images = $images.", ".$name;	

		    //SUCCESSFUL UPLOAD
		    	$usql = "update listings set images='$images' where uniquekey='".$id."'";

		    	if(mysqli_query($con, $usql)){
		    		echo '<script>window.location = "'.basename(__FILE__, '.php').'.php?id='.$_POST['id'].'";</script>';
		    	}
		    }

	}		
}
if($_POST['submit']=="submit"){
	$d = $_POST;
	$id = $d['id'];
	$c = mysqli_fetch_assoc(mysqli_query($con, "select type from listings where uniquekey='".$_REQUEST['id']."'"))['type'];
	$title = trim($d['title']);
	$condition = $d['condition'];
	$conddesc = trim(htmlspecialchars(mysqli_real_escape_string($con, $d['conddesc'])));
	$desc = trim(mysqli_real_escape_string($con, $d['desc']));
	$price = $d['price'];
	$qty = $d['qty'];
	$delivery = trim(htmlspecialchars(mysqli_real_escape_string($con, $d['delivery'])));
	if($c=="food"){
		$condition = "1";
		$conddesc = "";
	}
	if($condition=="1"){
		$conddesc = "";
	}
	$usql = "update listings set qty='$qty', title='$title', condtn='$condition', conddesc='$conddesc', description='$desc', price='$price', delivery='$delivery' where uniquekey='$id' and user='".$_SESSION['email']."'";
	//echo $usql;
	if(mysqli_query($con, $usql)){
		echo '<script>window.location = "'.basename(__FILE__, '.php').'.php?id='.$_POST['id'].'";</script>';
	}
}
?>