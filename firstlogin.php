<?php
include 'session.php';
if(mysqli_fetch_assoc(mysqli_query($con, "select firstlogin from users where email='".$_SESSION['email']."'"))['firstlogin']==0){
	//echo "AAA";
	@header("location: /");
}
$title = "Getting Started";
include 'web/header.php';
?>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Getting Started</div>
			<div class="panel-body">
				<form action="" method="post">
					
					<div class="row">
						<div class="col-md-3">Entering Class Year</div>
						<div class="col-md-9">
							<select class="form-control" name="class" required="true"><option value="">--Select Entry Year--</option>
									<?php
										$year = date("Y");
										$i = 1;
										while($i<=5){
											if($year==date("Y"))
												echo '<option value="'.$year.'" selected>'.$year."</option>\n";
											else
												echo '<option value="'.$year.'">'.$year."</option>\n";
											$year--;
											$i++;
										}
									?>
								</select>
							</div>
						</div><br>
					<div class="row">
						<div class="col-md-3">Programme</div>
						<div class="col-md-9">	
							<select name="programme" class="form-control" required="true">
								<option value="" selected>--Select Programme--</option>
								<option value="ug">UG</option>
								<option value="yif">YIF</option>
								<option value="mls">MLS</option>
								<option value="maeco">MAECO</option>
								<option value="phd">PhD</option>
							</select>
						</div>
					</div><br><br>
						<div class="text-align:right"><button class="btn btn-lg btn-success" type="submit" value="submit" name="submit"><i class="fa fa-check"></i> Continue</button></div>
				</form>
					<?php
					$d = $_POST;
					if($d['submit']=="submit"){
						//$username = strtolower($d['username']);
						$class = $d['class'];
						$prog = $d['programme'];
						$usql = "update users set class='".$class."', programme='".$prog."', firstlogin=0 where email='".$_SESSION['email']."'";
						if(mysqli_query($con, $usql)){
							echo '<script>window.location = "'.basename(__FILE__, '.php').'.php";</script>';
						}
					}
					?>
			</div>
		</div>
	</div>
</div>