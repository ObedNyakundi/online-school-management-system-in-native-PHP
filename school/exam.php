<?php 
	//connection
	require "connection.php";
	if (is_logged_in()) {
			$error=" ";




		if (isset($_GET['exam'])) {
			global $exam,$stclass;

			$exam=$_GET['exam'];
			$stclass=$_GET['class'];
		}
		else
		{
			header("location:home.php");
		}

		





		//include the header

		require "header1.php";
?>

<section height="auto">
	<!-- This is the left panel-->
			<div class="left-panel col-xs-4 pull-left w3-card-2">

							<!-- List the menu items-->
				<div class="user-details w3-card-2">
				<div class="text-center">
					<h2>Menu</h2>
					<div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
				</div>

				<div class="menu-div">
								
				<u><h4 class="colored">Examination Controls</h4></u>
				<div class='devider'><i class='fa fa-heart-o fa-lg'></i></div>
					
				</div>
				</div>

			<?php include_once "profile_sec.php";?>
			</div>




			<!-- main panel -->
			<div class="main-panel col-md-8 w3-card-2 pull-right">
				<div class="row">
					<div class="text-center">
						<h1 class="colored">Welcome, 
						<?php 
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

					

						<div class="text-center ordinary-form">
					<!-- I will first display the list students in that class whose marks have not been added to exam -->

						<?php
						
						$sq0="SELECT `students`.`upi` as `upi`, `students`.`name` as `name` FROM students where class LIKE '%$stclass%' and upi not in (SELECT upi from exam where label='$exam')";

						$rec=mysqli_query($conn,$sq0);
						if (mysqli_num_rows($rec)>0) {
							echo "<h3 class='frm-text'> Students whose marks have not been added: </h3>";
							while ($row=mysqli_fetch_array($rec,MYSQLI_BOTH)) {
								$upi=$row['upi'];
								$nm=$row['name'];						

								echo "<h4> <a href='exam_insert_frm.php?label=$exam&name=$nm&upi=$upi&class=$stclass'> $upi $nm </a> </h4>";
							}							
						}
						?>
					</div>
						

						<div class="text-center  ordinary-form w3-card-4">
						<h3 class="frm-text">Current Student Exam Listing <img src="./img/icons/User.png"></h3>
							<h4 class="frm-text">(<?php echo $stclass.' '.$exam; ?>)</h4>
						<br>
							<table class="text-center w3-table w3-bordered w3-striped w3-border">
						<tr class="w3-cyan text-center">
							<th>Name</th>
							<th>Math</th>
							<th>English</th>
							<th>Kiswahili</th>
							<th>Science</th>
							<th>S. Studies</th>
							<th>Totals</th>
							<th>Average</th>
							<th>position</th>
						</tr>
						<?php
						if (mysqli_num_rows(mysqli_query($conn,"SELECT * from `exam` where `label`='$exam' and `upi` in (select `upi` from `students` where `class`='$stclass') order by totals desc"))>0) 
						{
							$sq="SELECT * from `exam` where `label`='$exam' and `upi` in (select `upi` from `students` where `class`='$stclass') order by totals desc";
							$rec=mysqli_query($conn,$sq);
							$i=1;
							//variables for calculating totals
							$tmath=0;
							$teng=0;
							$tkis=0;
							$tsci=0;
							$tss=0;
							$ttotal=0;


							while ($row=mysqli_fetch_array($rec,MYSQLI_BOTH)) {
								//collect data
								$nm=$row['name'];
								$maths=$row['maths']; $tmath+=$maths;
								$eng=$row['english']; $teng+=$eng;
								$swa=$row['kiswahili']; $tkis+=$swa;
								$sci=$row['science']; $tsci+=$sci;
								$ss=$row['socialStudies']; $tss+=$ss;
								$total=$row['totals']; $ttotal+=$total;
								$average=$row['average'];

								//drawing in the table
								echo"
									<tr>
										<td>$nm</td>
										<td>$maths</td>
										<td>$eng</td>
										<td>$swa</td>
										<td>$sci</td>
										<td>$ss</td>
										<td>$total</td>
										<td>$average</td>
										<td>$i</td>
									</tr>
								";

								$i++;
							}

							$i-=1;

							echo" 
									<tr style='font-weight:bold; color:blue'>
										<td>Totals</td>
										<td>$tmath</td>
										<td>$teng</td>
										<td>$tkis</td>
										<td>$tsci</td>
										<td>$tss</td>
										<td>$ttotal</td>
										<td> </td>
										<td> </td>
									</tr>
									<tr style='font-weight:bold; color:blue'>
										<td>M.S.S</td>
										<td>".round($tmath/$i)."</td>
										<td>".round($teng/$i)."</td>
										<td>".round($tkis/$i)."</td>
										<td>".round($tsci/$i)."</td>
										<td>".round($tss/$i)."</td>
										<td>".round($ttotal/$i)."</td>
										<td> </td>
										<td> </td>
									</tr>
								";

						?>

						</table>
						<?php
						
							# code...
						
						echo '<a target="_blank" href="exam_result.php?exam='.$exam.'&stclass='.$stclass.'"> print result (PDF)</a> <br>';
						echo '<a target="_blank" href="exam_result_slip.php?exam='.$exam.'&stclass='.$stclass.'"> Generate provisional Result Slips</a>';
						}
						?>
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