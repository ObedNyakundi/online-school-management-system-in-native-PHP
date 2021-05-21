<?php 
	//connection
	require "connection.php";
if (is_logged_in()) {


	if (isset($_GET['label'])) {
			global $stnm, $label, $upi;

			$stnm=$_GET['name'];
			$stclass=$_GET['class'];
			$label=$_GET['label'];
			$upi=$_GET['upi'];
		}

		if (isset($_POST['addStudentMarks'])) {
			//collect the data
			$nm=uncrack($_POST['nm']);
			$test=uncrack($_POST['lbl']);
			$class=uncrack($_POST['stclass']);
			$upi=uncrack($_POST['upi']);
			$math=uncrack($_POST['maths']);
			$eng=uncrack($_POST['eng']);
			$swa=uncrack($_POST['swa']);
			$sci=uncrack($_POST['sci']);
			$ss=uncrack($_POST['ss']);


			$totals=($math+$eng+$swa+$sci+$ss);
			$average=($totals/5);

			$sq="INSERT into `exam` 
			(`name`, `maths`, `english`, `kiswahili`, `science`, `socialStudies`, `totals`, `average`, `upi`,`label`) 
			values ('$nm','$math','$eng','$swa','$sci','$ss','$totals','$average','$upi','$test')";

			

			if (mysqli_query($conn,$sq)) {
				header("location:exam.php?exam=$test&class=$class&err=1"); //error 1 is for success
			}
			else
			{
				header("location:exam.php?exam=$test&class=$class&err=2"); //error 1 is for success
			}

		}


		//include the header

		require "header1.php";
?>

<section height="auto">
	<div class="container works clearfix">
		<div class="row">
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



			<div class="main-panel col-md-8 w3-card-2 pull-right">
			<div>
				<h1>Add a student's Marks</h1>
			</div>
			<div>
				<!--I have hiddedn the input form-->
							 <form class="form-inline ordinary-form" method="post" action="exam_insert_frm.php" role="form">

							 <div class="form-group">
							    <label for="nm">Name:</label>
							    <input type="text" name="nm" value="<?php echo $stnm; ?>" placeholder="name" class="form-control" id="nm">
							  </div>

							  <div class="form-group">
							    <label for="stclass">Class:</label>
							    <input type="text" name="stclass" value="<?php echo $stclass; ?>" placeholder="class" class="form-control" id="stclass">
							  </div>

							  <div class="form-group">
							    <label for="lbl">Test:</label>
							    <input type="text" name="lbl" value="<?php echo $label; ?>" placeholder="test name" class="form-control" id="lbl">
							  </div>

							  <div class="form-group">
							    <label for="upi">UPI:</label>
							    <input type="text" name="upi" value="<?php echo $upi; ?>" placeholder="UPI" class="form-control" id="upi">
							  </div>

							  <div class="form-group">
							    <label for="maths">Maths:</label>
							    <input type="number" required onkeyup="strip2('maths',3)" name="maths" placeholder="Maths" class="form-control" id="maths">
							  </div>

							  <div class="form-group">
							    <label for="eng">English:</label>
							    <input type="number" required name="eng" onkeyup="strip2('eng',2)" placeholder="English" class="form-control" id="eng">
							  </div>

							  <div class="form-group">
							    <label for="swa">Kiswahili:</label>
							    <input type="number" required name="swa" onkeyup="strip2('swa',2)" placeholder="Kiswahili" class="form-control" id="swa">
							  </div>

							  <div class="form-group">
							    <label for="sci">Science:</label>
							    <input type="number" required name="sci" onkeyup="strip2('sci',3)" placeholder="Science" class="form-control" id="sci">
							  </div>

							  <div class="form-group">
							    <label for="ss">Social S.:</label>
							    <input type="number" required name="ss" onkeyup="strip2('ss',3)" placeholder="Social Studies" class="form-control" id="ss">
							  </div>

							  <br><button type="submit" name="addStudentMarks" class="btn btn-info">Add Student Marks</button>
							</form>
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