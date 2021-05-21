<?php 
	//connection
	require "connection.php";
$error=" ";
$div1=" ";


$stupi=" "; $stnm=" ";$stclass=" ";$stdob=" ";
$editable=false;
$act=" ";

/*********************************
A summary of requests and actions 
*********************************/
if (isset($_GET["request"])) {
	//identify the request

	$request=$_GET["request"];

				//global $stupi,$stnm,$stclass,$stdob;
				//collect the data and set globals
				$stupi=$_GET['upi'];
				$stnm=$_GET['nm'];
				$stclass=$_GET['class'];
				$dob=$_GET['dob'];

	switch ($request) {
		case 'stedit':	
				$editable=true; $act="edit_student";
		 break;

		 case 'stdelete':
		 	$act="delete_student";

		 break;
		
		default:
			# code...
			break;
	}
}

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

				<!-- Form for student registration -->

			<div class="text-center w3-card-4 ordinary-form" style="" id="frmAdmit">
			<a href="home.php"><img src="img/icons/Close.png" class="pull-right" title="Cancel"></a>
					<h2 class="frm-text"><?php
											if ($act=='edit_student') 
										{
											echo "Edit $stnm's Records";
										}
										else if($act='delete_student')
										{
											echo "<i class='fa fa-trash'></i> Delete $stnm's Records?";
										}

											?><img src="./img/icons/User.png"></h2><br>					
					
					<form method="POST" action="home.php">
								<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="400ms">
								<label for="name">Student Name: *</label>
								<input type="text" autofocus required id="name" name="stname" class=" text-center form-control" <?php if(!$editable){ echo "readonly";} ?> value="<?php echo $stnm; ?>" placeholder="Name. e.g. Mwenye Kiti"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="700ms" data-wow-delay="600ms">
								<label for="upi">Student UPI: *</label>
								<input type="text" readonly value="<?php echo $stupi;?>" id="upi" name="upi" class=" text-center form-control" placeholder="UPI. e.g. MSA123"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="900ms" data-wow-delay="800ms">
								<label for="dob">Date of Birth: *</label>
								<input type="date" <?php if(!$editable){ echo "readonly";} ?> required id="dob" name="dob" value="<?php echo $dob; ?>" class=" text-center form-control" placeholder="Date: MM/DD/YYYY"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="1100ms" data-wow-delay="1000ms">
                            <select required <?php if(!$editable){ echo "readonly";} ?> name="class" id="type0" title="please select a class" class="form-control text-center">
                                    <option value="<?php echo $stclass; ?>"> *** <?php echo $stclass; ?> *** </option>
                                    <?php 
                                        $qq="select `label`, `id` from `class`";
                                        $rr=mysqli_query($conn,$qq);
                                        while ($row=mysqli_fetch_array($rr,MYSQLI_BOTH)) {
                                            $title= $row['label'];
                                            echo "<option value=\"$title\"> *** $title *** </option>";
                                        }
                                    ?>
                            </select>
                            </div>
                            <?php
											if ($act=='edit_student') 
										{
											echo "<input type=\"submit\" onclick=\"hide(frmAdmit)\" name=\"actUpdateStudent\" class=\"btn btn-info pull-center\" value=\"Update Record\">";
										}
										else if($act='delete_student')
										{
											echo "<input type=\"submit\" onclick=\"hide(frmAdmit)\" name=\"actDeleteStudent\" class=\"btn btn-info pull-center\" value=\"Delete Record\">";
											echo "<br><a href=\"home.php\"><buttonclass=\" form-control btn btn-info pull-center\"> Cancel<img src=\"img/icons/Close.png\" class=\"pull-right\" title=\"Cancel\"></button></a>";
										}

											?>
								
							</form>
				</div>
				</div>
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