<?php 
	//connection
	require "connection.php";
$error=" ";
$div1=" ";



if (is_logged_in()) {
	# code...


		//include the header

		require "header1.php";
?>

<section height="auto">
	<div class="container works clearfix">
		<div class="row">
			<div class="left-panel col-md-4 pull-left w3-card-2">
				<div class="user-details w3-card-2">
				<div class="text-center">
					<h2>Menu</h2>
					<div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
				</div>

				<div class="menu-div">
				<?php

				//only the head teacher should be handed these controls

				if (is_headTeacher()) {

				echo "<u><h4 class='colored'>Administrator Controls</h4></u>
					<div class='devider'><i class='fa fa-heart-o fa-lg'></i></div>
					<ul>
						<li onclick=\"unhide('frmAdmitTeacher');\"><a href='#'>Admit a Teacher <i class='fa fa-user heighten'></i></a></li><br/>
						<li onclick=\"unhide('frmBook')\"><a href='#'>Add books <img src='./img/icons/Address_Book.png'></a></li><br/>
					</ul>";
				}
					
				?>


					
				<u><h4 class="colored">Teacher Controls</h4></u>
				<div class='devider'><i class='fa fa-heart-o fa-lg'></i></div>
					<ul>
						<li> <span onclick="unhide('frmAdmit')"> <a href='#'>New Student Admission <img src="./img/icons/Add.png"></a> </span></li><br>
						<li> <a href="home.php#students">View Student List <img src="./img/icons/User.png"> </a></li> <br>
						<li> <a href="home.php#books">Check Books' Store <img src="./img/icons/Address_Book.png"> </a></li>
						<li> <span onclick="unhide('examfrm')"> <a href='#'>View Exams <img src="./img/icons/Portfolio.png"></a> </span></li><br>

					</ul>
				</div>
				</div>

			<?php include_once "profile_sec.php";?>
			</div>

			<div class="main-panel col-md-8 w3-card-2 pull-right">
			<div>
			<div class="text-center">
				<h1 class="colored">Welcome, <?php 
				if (is_headTeacher()) {
					echo "Admin ";
				}
				else
				{
					echo "Teacher ";
				}
				echo $funame;


				?></h1>
				<div class="black-devider"><i class="fa fa-heart-o fa-lg"></i></div>
				<?php echo $error; ?>
			</div>

			<?php echo $div1; ?>
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
	else
	{
		header("location:index.php");
	}

?>