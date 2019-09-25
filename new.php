<?php
$title = "New Listing";
include 'web/header.php';
?>
<body onload="onload()">
<script>
function onload(){
	document.getElementById("addbook").style.display = "none";
	document.getElementById("additem").style.display = "none";
	document.getElementById("addfood").style.display = "none";
	$('form').each(function() { this.reset() });
}
function addcheck(){
	onload();
	document.getElementById("add"+document.getElementById("newlisting").value).style.display = "block";
	document.getElementById(document.getElementById("newlisting").value+"conddesc").style.display = "none";
}
function conditioncheck(v){
	var cond = document.getElementById(v+"condition").value;
	if(cond!=1 && cond!=""){
		document.getElementById(v+"conddesc").style.display = "block";
	}
	else {
		document.getElementById(v+"conddesc").style.display = "none";	
	}
}
function checkImage(v){
	if($("#"+v+"photos")[0].files.length > 4) {
            alert("You can select only 4 images");
            document.getElementById(v+"photos").value = "";
         } else {
              		
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
<div class="col-md-9">
	<h2>Add New Listing</h2>
	<select class="form-control" id="newlisting" onchange="addcheck()" autofocus="true">
		<option value="">--Select Category--</option>
		<option value="book">Books</option>
		<option value="item">Item/Products</option>
		<option value="food">Eatables</option>
	</select><br>
	<!-- Book Listing -->
	<div class="panel panel-default" id="addbook">
		<div class="panel-heading">List a Book</div>
		<div class="panel-body">
			<form method="post" enctype="multipart/form-data" name="formUploadFile">
			<input type="hidden" name="category" value="book">
			<div class="row">
				<div class="col-md-3">Title of Book</div>
				<div class="col-md-9"><input class="form-control" name="title" placeholder="Enter Title of Book (max 12 characters)" ></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Book Description</div>
				<div class="col-md-9"><textarea class="form-control" name="desc" placeholder="Enter Description of Book (ISBN, Author, Publication Date, Edition etc)" rows="5"></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Condition</div>
				<div class="col-md-9">
					<select class="form-control" name="condition" id="bookcondition" required="true" onchange="conditioncheck('book')">
						<option value="">--Book Condition--</option>
						<option value="1">Brand New</option>
						<option value="2">Like New</option>
						<option value="3">Very Good</option>
						<option value="4">Good</option>
						<option value="5">Acceptable</option>
					</select>
				</div>
			</div><br>
			<div class="row" id="bookconddesc">
				<div class="col-md-3">Condition Description</div>
				<div class="col-md-9"><textarea class="form-control" name="conddesc" placeholder="Enter Condition Description here"></textarea><br></div>
			</div>
			<div class="row">
				<div class="col-md-3">Duration of Listing</div>
				<div class="col-md-9">
					<select class="form-control" name="duration" required="true">
						<option value="">--Select Duration--</option>
						<option value="1">1 day</option>
						<option value="3">3 days</option>
						<option value="5">5 days</option>
						<option value="7">7 days</option>
						<option value="14">14 days</option>
						<option value="30">30 days</option>
						<option value="45">45 days</option>
						<option value="90">90 days</option>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Photos (Max 4)</div>
				<div class="col-md-9"><input class="form-control" type="file" onchange="checkImage('book')" id="bookphotos" name="files[]" multiple="multiple" required="true" accept="image/jpg, image/jpeg, image/png, image/gif"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Price</div>
				<div class="col-md-9"><input class="form-control" name="price" required="true" placeholder="(Indian Rupees) 0.00"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Quantity</div>
				<div class="col-md-2"><input class="form-control" value="1" type="number" name="qty" min="1" required="true" placeholder=""></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Delivery Instructions</div>
				<div class="col-md-9"><textarea class="form-control" name="delivery" placeholder="Dorm Room Delivery or Pick-up (Enter descriptively how you wish to deliver)"></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3" style="text-align:left; vertical-align:middle;"><button type="reset" class="btn btn-default btn-lg">Reset</button></div>
				<div class="col-md-9" style="text-align:right; vertical-align:middle;"><button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">Continue <i class="fa fa-chevron-right"></i></div>
			</div><br>
			</form>	
		</div>
	</div>
	<!-- Book Listing / -->
	<!-- Item Listing -->
	<div class="panel panel-default" id="additem">
		<div class="panel-heading">List an Item/Product</div>
		<div class="panel-body">
			<form method="post" enctype="multipart/form-data" name="formUploadFile">
			<input type="hidden" name="category" value="item">
			<div class="row">
				<div class="col-md-3">Title of Listing</div>
				<div class="col-md-9"><input class="form-control" name="title" placeholder="Enter Title of Item (max 12 characters)" required="true"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Item Description</div>
				<div class="col-md-9"><textarea class="form-control" name="desc" placeholder="Enter Description of Item (Color, Odour, Texture, Dimensions, Age, Expiry etc)" rows="5"></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Condition</div>
				<div class="col-md-9">
					<select class="form-control" name="condition" id="itemcondition" required="true" onchange="conditioncheck('item')">
						<option value="">--Item Condition--</option>
						<option value="1">Brand New</option>
						<option value="2">Like New</option>
						<option value="3">Very Good</option>
						<option value="4">Good</option>
						<option value="5">Acceptable</option>
					</select>
				</div>
			</div><br>
			<div class="row" id="itemconddesc">
				<div class="col-md-3">Condition Description</div>
				<div class="col-md-9"><textarea class="form-control" name="conddesc" placeholder="Enter Condition Description here"></textarea><br></div>
			</div>
			<div class="row">
				<div class="col-md-3">Duration of Listing</div>
				<div class="col-md-9">
					<select class="form-control" name="duration" required="true">
						<option value="">--Select Duration--</option>
						<option value="1">1 day</option>
						<option value="3">3 days</option>
						<option value="5">5 days</option>
						<option value="7">7 days</option>
						<option value="14">14 days</option>
						<option value="30">30 days</option>
						<option value="45">45 days</option>
						<option value="90">90 days</option>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Photos (Max 4)</div>
				<div class="col-md-9"><input class="form-control" type="file" onchange="checkImage('item')" id="itemphotos" name="files[]" multiple="multiple" required="true" accept="image/jpg, image/jpeg, image/png, image/gif"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Price</div>
				<div class="col-md-9"><input class="form-control" name="price" required="true" placeholder="(Indian Rupees) 0.00"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Quantity</div>
				<div class="col-md-2"><input class="form-control" value="1" type="number" name="qty" min="1" required="true" placeholder=""></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Delivery Instructions</div>
				<div class="col-md-9"><textarea class="form-control" name="delivery" placeholder="Dorm Room Delivery or Pick-up (Enter descriptively how you wish to deliver)"></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3" style="text-align:left; vertical-align:middle;"><button type="reset" class="btn btn-default btn-lg">Reset</button></div>
				<div class="col-md-9" style="text-align:right; vertical-align:middle;"><button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">Continue <i class="fa fa-chevron-right"></i></div>
			</div><br>
			</form>	
		</div>
	</div>
	<!-- Item Listing / -->
	<!-- Food Listing -->
	<div class="panel panel-default" id="addfood">
		<div class="panel-heading">List a Food (Bake Sale/Pizza Sale/Pan Cake Sale etc)</div>
		<div class="panel-body">
			<form method="post" enctype="multipart/form-data" id="addform" name="formUploadFile">
			<input type="hidden" name="category" value="food">
			<div class="row">
				<div class="col-md-3">Title of Food</div>
				<div class="col-md-9"><input class="form-control" name="title" placeholder="Enter Title of Food Sale (max 12 characters)" required="true"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Sale Description</div>
				<div class="col-md-9"><textarea class="form-control" name="desc" placeholder="Enter Description of Eatable (Variants Available, Menu, Dimensions, Servings etc)" rows="5"></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Duration of Listing</div>
				<div class="col-md-9">
					<select class="form-control" name="duration" required="true">
						<option value="">--Select Duration--</option>
						<option value="1">1 day</option>
						<option value="3">3 days</option>
						<option value="5">5 days</option>
						<option value="7">7 days</option>
						<option value="14">14 days</option>
						<option value="30">30 days</option>
						<option value="45">45 days</option>
						<option value="90">90 days</option>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Photos (Max 4)</div>
				<div class="col-md-9"><input class="form-control" type="file" onchange="checkImage('food')" id="foodphotos" name="files[]" multiple="multiple" required="true" accept="image/jpg, image/jpeg, image/png, image/gif"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Price</div>
				<div class="col-md-9"><input class="form-control" type="number" name="price" required="true" placeholder="(Indian Rupees) 0.00"></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Quantity</div>
				<div class="col-md-2"><input class="form-control" value="1" type="number" name="qty" min="1" required="true" placeholder=""></div>
			</div><br>
			<div class="row">
				<div class="col-md-3">Delivery Instructions</div>
				<div class="col-md-9"><textarea class="form-control" name="delivery" placeholder="Dorm Room Delivery or Pick-up (Enter descriptively how you wish to deliver)"></textarea></div>
			</div><br>
			<div class="row">
				<div class="col-md-3" style="text-align:left; vertical-align:middle;"><button type="reset" class="btn btn-default btn-lg">Reset</button></div>
				<div class="col-md-9" style="text-align:right; vertical-align:middle;"><button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">Continue <i class="fa fa-chevron-right"></i></div>
			</div><br>
			</form>	
		</div>
	</div>
	<!-- Food Listing / -->
</div>
<?php
if($_POST['submit']=="submit"){


	//IMAGE UPLOADER
	if(count($_FILES['files']['name'])<=4){
		$errors = array();
		$uploadedFiles = array();
		$extension = array("jpeg","jpg","png","gif");
		$bytes = 1024;
		$KB = 4096;
		$totalBytes = $bytes * $KB;
		$uniqueKey = md5(rand(1000000,9999999));    
		$UploadFolder = "uploads/";
		while(file_exists($UploadFolder.$uniqueKey)) {
	    	$uniqueKey = md5(rand(1000000,9999999));    
	    } 
	    $UploadFolder = $UploadFolder.$uniqueKey;
	    mkdir($UploadFolder, 0777, true);
		$counter = 0;
		 
		foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
		    $temp = $_FILES["files"]["tmp_name"][$key];
		    $name = $_FILES["files"]["name"][$key];
		     
		    if(empty($temp))
		    {
		        break;
		    }
		     
		    $counter++;
		    $UploadOk = true;
		     
		    if($_FILES["files"]["size"][$key] > $totalBytes)
		    {
		        $UploadOk = false;
		        array_push($errors, $name." file size is larger than the 4 MB.");
		    }
		     
		    $ext = pathinfo($name, PATHINFO_EXTENSION);
		    if(in_array($ext, $extension) == false){
		        $UploadOk = false;
		        array_push($errors, $name." is invalid file type.");
		    }
		     
		    if(file_exists($UploadFolder."/".$name) == true){
		        $UploadOk = false;
		        array_push($errors, $name." file is already exist.");
		    }
		     
		    if($UploadOk == true){
		        move_uploaded_file($temp,$UploadFolder."/".$name);
		        array_push($uploadedFiles, $name);
		    }
		}
		 
		if($counter>0){
		    if(count($errors)>0)
		    {
		    }
		     
		    if(count($uploadedFiles)>0){

		    		$d = $_POST;
					$c = $d['category'];
					$title = $d['title'];
					$desc = htmlspecialchars(mysqli_real_escape_string($con, $d['desc']));
					$condition = $d['condition'];
					$conddesc = htmlspecialchars(mysqli_real_escape_string($con, $d['conddesc']));
					$duration = $d['duration'];
					$price = $d['price'];
					$qty = $d['qty'];
					$delivery = htmlspecialchars(mysqli_real_escape_string($con, $d['delivery']));
					if($c=="food"){
						$condition = "1";
					}					

					$fileNames = "";
					foreach($uploadedFiles as $fileName){
	            		$fileNames .= $fileName.", ";
	        		}
	        		$fileNames = ltrim(rtrim($fileNames, ", "), ", ");

	        		$starttime = strtotime($timestamp);
	        		$endtime = $starttime+(60*60*24*$duration);

		    //SUCCESSFUL UPLOAD
		    	$isql = "insert into listings (qty, leftqty, type, user, uniquekey, title, description, condtn, conddesc, duration, starttime, endtime, images, price, delivery) VALUES ('".$qty."', '".$qty."', '".$c."', '".$_SESSION['email']."', '".$uniqueKey."', '".$title."', '".$desc."', '".$condition."', '".$conddesc."', '".$duration."', '".$starttime."', '".$endtime."', '".$fileNames."', '".$price."', '".$delivery."')";

		    	if(mysqli_query($con, $isql)){
		    		echo '<script>window.location = "'.basename(__FILE__, '.php').'.php";</script>';
		    	}

		    //SUCCESSFUL UPLOAD / 
		    }                               
		}
		else{
		    //echo "Please, Select file(s) to upload.";
		}
	}
	else {
		echo "<script>alert('You can upload maximum 4 images');</script>";
	}
}
?>