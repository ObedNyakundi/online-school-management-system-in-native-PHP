<?php 
	//connection
	require "connection.php";
	$error= " ";

if (is_logged_in()) {
	header("location:home.php");
}
else
{

	if (isset($_POST["logU"])) {
		//collect data
		$tscnum=uncrack($_POST["tscnum"]);
		$passwd=uncrack($_POST["pass0"]);

		$sqst="select * from `teacher` where `tscNum`='$tscnum' and `password`='$passwd'";
		$queryresult=mysqli_query($conn,$sqst);
		$arr=mysqli_fetch_array(mysqli_query($conn,$sqst), MYSQLI_BOTH);

		if (mysqli_num_rows($queryresult) == 1) {
				
			//True if the member exists. false otherwise.
			$tsc_number=$arr["tscNum"];
			$uname=$arr["name"];
			$type=$arr["type"]; 

			//set cookies to remember the user for 30 days
			setcookie("name",$uname,time()+86400*30,"/","",0);
			setcookie("tsc",$tsc_number,time()+86400*30,"/","",0);
			setcookie("type",$type,time()+86400*30,"/","",0);
			//direct user to homepage.
			
			/* I will use them when handing controls*/
			/*
			if ($type=='HTeacher'){
				header("location:home.php");
			}
			else
			{
			header("location:home.php");
			}*/

			header("location:home.php");
			}else{
				$error="<div class='alert alert-warning fade in'> <strong>Invalid Login details</strong> <br> 
			The TSC number or password you used is invalid <br> Try again.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
			}
	}


		//include the header

		require "header0.php";
?>

<section height="auto">
	<div class="container works clearfix">
		<div class="row">
			<div class="left-panel col-xs-4 pull-left w3-card-2">

			<!-- login Form -->

				<div class="text-center">
					<h2 class="">Staff Login <img src="./img/icons/Lock.png"></h2><br>					
					
					<form method="POST" action="index.php">
								<label for="email">TSC Number:</label>
								<input type="number" autofocus required id="email" name="tscnum" class="form-control center" placeholder="TSC number. e.g. 1234"><br>
								<label for="passwd">Password:</label>
								<input type="password" required id="passwd" name="pass0" class="form-control center" placeholder="Enter password"><br>
								<input type="submit" name="logU" class="btn btn-info pull-center" value="Login">
							</form>
				</div>
			</div>

			<div class="main-panel col-xs-8 w3-card-2 pull-right">
			<div class="text-center">
				<h1>School Management Public Board</h1>
				<?php echo $error;?>
			</div>
				
			</div>
			
	

			</div>
		</div>
	</div>
	</section>

<?php
//inculde the footer
		require "footer0.php";
	}

?>