<?php 
	//connection
	require "connection.php";
	$error=" ";
	$divi=" ";

if (is_logged_in()) {
	# code...


/*********************************
A summary of requests and actions 
*********************************/
if (isset($_GET["request"])) {
	//identify the request

	$request=$_GET["request"];

	switch ($request) {
		case 'newAdmission':	

		 break;
		
		default:
			# code...
			break;
	}
}



/********************************
	Action Admit a student
********************************/
if (isset($_POST['actAdmitStudent'])) {
	//collect data
	$name=is_username($_POST['stname']);
	$upi=uncrack($_POST['upi']);
	$dob=uncrack($_POST['dob']);
	$class=uncrack($_POST['class']);

	//insert that data
	$sq="insert into `students` (`name`,`dateOfBirth`,`class`,`upi`) values ('$name','$dob','$class','$upi')";
	if (mysqli_query($conn,$sq)) {
		//success
		$error="<div class='alert alert-success fade in'> <strong>Student record was added successfully</strong> <br> 
			The new Student has been admitted successfully.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
	else
	{
		//fail
		$error="<div class='alert alert-warning fade in'> <strong>System failed to admit student</strong> <br> 
			The new student has a UPI that resembles an existing student within the system.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
}


/***************************************
	Action Update a student's record
***************************************/

if (isset($_POST['actUpdateStudent'])) {
	//collect data
	$name=is_username($_POST['stname']);
	$upi=uncrack($_POST['upi']);
	$dob=uncrack($_POST['dob']);
	$class=uncrack($_POST['class']);

	//update data
	$sq="UPDATE `students` set `name`='$name',`dateOfBirth`='$dob', `class`='$class' where `upi`='$upi'";
	if (mysqli_query($conn,$sq)) {
		//success
		$error="<div class='alert alert-success fade in'> <strong>Student record was updated successfully</strong> <br> 
			$name's records have been updated successfully.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
	else
	{
		//fail
		$error="<div class='alert alert-warning fade in'> <strong>System failed to update student records</strong> <br> 
			The system failed to update $name's records. If this system persista, pleace contact System administrator.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
}

/***************************************
	Action Delete a student's record
***************************************/

if (isset($_POST['actDeleteStudent'])) {
	//collect data
	$name=is_username($_POST['stname']);
	$upi=uncrack($_POST['upi']);
	$dob=uncrack($_POST['dob']);
	$class=uncrack($_POST['class']);

	$sq="DELETE from `students` where `upi`='$upi'";

	if (mysqli_query($conn,$sq)) {
		//success
		$error="<div class='alert alert-success fade in'> <strong>Student record was deleted successfully</strong> <br> 
			$name's records have been removed from the system.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
	else
	{
		//fail
		$error="<div class='alert alert-warning fade in'> <strong>System failed to delete $name's records</strong> <br> 
			The system failed to delete $name's records. If this system persists, please contact System administrator.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
}

/********************************
	Action Admit a teacher
********************************/

if (isset($_POST['admitTeacher'])) {
		//collect data
	$tscnum=uncrack($_POST['tscnum']);
	$ttname=is_username($_POST['ttname']);
	$tws=uncrack($_POST['tws']);
	$dob=uncrack($_POST['dob']);
	$dop=uncrack($_POST['dop']);
	$type0=uncrack($_POST['type0']);
	$passwd=uncrack($_POST['passwd']);

	$sqs="INSERT into `teacher` (`name`,`tscNum`,`dateOfBirth`,`dateOfAppointment`,`currentWorkingStation`, `type`, `password`) values ('$ttname','$tscnum','$dob','$dop','$tws','$type0','$passwd')";
	if (mysqli_query($conn,$sqs)) {
		//success
		$error="<div class='alert alert-success fade in'> <strong>The new Teacher record was added successfully</strong> <br> 
			The new teacher has been admitted successfully.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
	else
	{
		//fail
		$error="<div class='alert alert-warning fade in'> <strong>System failed to admit teacher $ttname</strong> <br> 
			A teacher with similar TSC Number already exists within our system.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
}


/********************************
	Action change password
********************************/
if (isset($_POST['changepassword'])) {
	//collect data
	$pass0=uncrack($_POST['pass0']);
	$pass1=uncrack($_POST['pass1']);
	$pass2=uncrack($_POST['pass2']);

	//check if the two old password and the new password match
	$sq0="select * from teacher where tscNum='$tsc' and password='$pass0'";
	$rec0=mysqli_query($conn,$sq0);

	if (mysqli_num_rows($rec0) == 1) {
		//old password and new passwords matched

		//check if the new passwords match
		if ($pass1===$pass2) {
			$sqq="update `teacher` set `password`='$pass1' where `tscNum`='$tsc'";
			if (mysqli_query($conn,$sqq)) {
				//success
				$error="<div class='alert alert-success fade in'> <strong>Your Password was updated successfully</strong> <br> 
					The new password was updated. You will use it in your next login.
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
				</div>";
			}
			else
			{
				//fail
				$error="<div class='alert alert-warning fade in'> <strong>The password was not updated</strong> <br> 
					There was technical error when updating your password.
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
				</div>";
			}
		}
		else
		{
			//fail : new passwords mismatched
			$error="<div class='alert alert-warning fade in'> <strong>Passwords did not match</strong> <br> 
				Hello, $funame, the new passwords did not match.
			<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
			</div>";
		}
	}
	else
	{
		//fail : old and new passwords mismatched
		$error="<div class='alert alert-warning fade in'> <strong>You input invalid password</strong> <br> 
			Hello, $funame, the old password you used was incorrect.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}

	
}


/********************************
	Action Add a book
********************************/

if (isset($_POST['actAddBook'])) {
		//collect data
	$bktitle=uncrack($_POST['bktitle']);
	$bkclass=uncrack($_POST['class']);
	$coppies=uncrack($_POST['noc']);
	$subject=uncrack($_POST['subject']);
	

	$sqs="INSERT into `books` (`title`,`subject`,`class`,`numberOfCopies`) 
				values ('$bktitle','$subject','$bkclass','$coppies')";
	if (mysqli_query($conn,$sqs)) {
		//success
		$error="<div class='alert alert-success fade in'> <strong>Book Added successfully</strong> <br> 
			The has been added successfully.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
	else
	{
		//fail
		$error="<div class='alert alert-warning fade in'> <strong>System failed to add the new book</strong> <br> 
			Our system failed to add the new book due to technical issues. If problem persists, please contact system administrator.
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
		</div>";
	}
}


/********************************
	Action View/ Add Exams
********************************/

if (isset($_POST['viewexam'])) {
	//collect exam details
	$tclass=$_POST['tclass'];
	$test=$_POST['texam'];
	$term=$_POST['tterm'];
	$tyear=$_POST['tyear'];

	$exam_label=$test." ".$term." ".$tyear;
	//redirect the user to the exam page
	header("location:exam.php?exam=$exam_label&class=$tclass");

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
				</div>

				<div class="menu-div">
				<?php

				//only the head teacher should be handed these controls

				if (is_headTeacher()) {

				echo "<u><h4 class='colored text-center'>Administrator Controls</h4></u>
					<div class='devider'><i class='fa fa-heart-o fa-lg'></i></div>
					<div class='row'>

					<center><i class='fa fa-user heighten'></i> <br> <h4>Teacher</h4></center>
						<div class='col-xs-6'>
							<a href='#'><button class='btn-control' onclick=\"unhide('frmAdmitTeacher');\"><img src=\"./img/icons/Add.png\"><br>Admit Teacher</button></a>
						</div>
						<div class='col-xs-6'>
							<a href='#'><button class='btn-control' onclick=\" \"><i class='fa fa-eye heighten-two'></i><br>View Teachers</button></a>
						</div>
					</div>

					<div class='row'>
					<center><i class='fa fa-book heighten'></i> <br> <h4>Books</h4></center>

						<div class='col-xs-6'>
							<a href='#'><button class='btn-control' onclick=\"unhide('frmBook')\"><img src='./img/icons/Add.png'> <br/>Add books </button></a>
						</div>
						<div class='col-xs-6'>
							<a href='#'><button class='btn-control' onclick=\" \"><i class='fa fa-eye heighten-two'></i><br>View books</button></a>
						</div>
					</div>
					";
				}
					
				?>


				<div class='devider'><i class='fa fa-heart-o fa-lg'></i></div>	
				<u><h4 class="colored text-center">Teacher Controls</h4></u>
				<div class='devider'><i class='fa fa-heart-o fa-lg'></i></div>

					<div class='row'>
					<center><img src="./img/icons/User.png"> <br> <h4>Student</h4></center>
						<div class='col-xs-6'>

							<a href='#'> <button class='btn-control' onclick="unhide('frmAdmit')"> <img src="./img/icons/Add.png"><br> Admit Student </button></a>
						</div>

						<div class='col-xs-6'>
						<a href="home.php#students"><button class='btn-control'><i class='fa fa-eye heighten-two'></i><br>View Students</button> </a>
						</div>
					</div>
					<div class='row'>
					<center><i class='fa fa-book heighten'></i> <br> <h4>Books</h4></center>

						<div class='col-xs-12'>
							<a href="home.php#books"><button class='btn-control'><img src="./img/icons/Search.png"><br/>Check Books' Store </button> </a>
						</div>
					</div>

					<div class='row'>
					<center><img src="./img/icons/Portfolio.png"> <br> <h4>Exams</h4></center>

						<div class='col-xs-12'>
							<a href="#"><button class='btn-control' onclick="unhide('examfrm')"><img src="./img/icons/Address_Book.png"><br/>View Exams </button> </a>
						</div>
					</div>

				</div>
				</div>

			<?php include_once "profile_sec.php";?>
			</div>




			<!-- This is the main panel-->

			<div class="main-panel col-xs-8 w3-card-2 pull-right">
			<div class="row">
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

			<?php echo $divi; ?>

				<!-- Form for viewing Result Slip (processed externally to pdf)-->

			<div class="text-center w3-card-4 ordinary-form" style="display:none;" id="slipfrm">
					<!-- the closing button-->
				<img src="img/icons/Close.png" class="pull-right" onclick="hide('slipfrm')" title="Close Examinations Form">
					<h2 class="frm-text">Display Result Slip <img src="./img/icons/Address_Book.png"></h2><br>					
					
					<form method="POST" action="class_slip.php">
								<div class="form-group wow fadeInDown" data-wow-duration="200ms" data-wow-delay="300ms">
								<label for="type0">Select class: *</label>
	                            <select required name="tclass" id="type0" title="please select a class" class="form-control text-center">
	                                    <option value=""> *** select class to view exam *** </option>
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

	                            <input type="submit" onclick="hide(frmAdmit)" name="viewslip" class="btn btn-info pull-center" value="View Exam">
	                  </form>
	        </div>


			<!-- Form for viewing exams-->

			<div class="text-center w3-card-4 ordinary-form" style="display:none;" id="examfrm">
				<!-- the closing button-->
			<img src="img/icons/Close.png" class="pull-right" onclick="hide('examfrm')" title="Close Examinations Form">
					<h2 class="frm-text">View Or Input Exams <img src="./img/icons/Address_Book.png"></h2><br>					
					
					<form method="POST" action="home.php">
								<div class="form-group wow fadeInDown" data-wow-duration="200ms" data-wow-delay="300ms">
								<label for="type0">Select class: *</label>
	                            <select required name="tclass" id="type0" title="please select a class" class="form-control text-center">
	                                    <option value=""> *** select class to view exam *** </option>
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

	                            <div class="form-group wow fadeInDown" data-wow-duration="400ms" data-wow-delay="500ms">
								<label for="type2">Select Term: *</label>
	                            <select required name="tterm" id="type2" title="please select a term" class="form-control text-center">
	                                    <option value=""> *** select term *** </option>
	                                    <option value="1"> *** Term One *** </option>
	                                    <option value="2"> *** Term Two *** </option>
	                                    <option value="3"> *** Term Three *** </option>
	                            </select>
	                            </div>

								<div class="form-group wow fadeInDown" data-wow-duration="600ms" data-wow-delay="700ms">
								<label for="type1">Select Exam type: *</label>
	                            <select required name="texam" id="type1" title="please select a test type" class="form-control text-center">
	                                    <option value=""> *** select Exam Type *** </option>
	                                    <?php 
	                                        $qq="select `label`, `id` from `tests`";
	                                        $rr=mysqli_query($conn,$qq);
	                                        while ($row=mysqli_fetch_array($rr,MYSQLI_BOTH)) {
	                                            $title= $row['label'];
	                                            echo "<option value=\"$title\"> *** $title *** </option>";
	                                        }
	                                    ?>
	                            </select>
	                            </div>

								<div class="form-group wow fadeInDown" data-wow-duration="800ms" data-wow-delay="900ms">
								<label for="type3">Select Year: *</label>
	                            <select required name="tyear" id="type3" title="please select a year" class="form-control text-center">
	                                    <option value=""> *** select Year *** </option>
	                                    <?php 
	                                    $current_year=date('y')+2000; //the current year                                   
	                                    for ($i=$current_year; $i>=2010 ; $i--) {	                                  
	                                     echo "<option value=\"$i\"> *** $i *** </option>";                                
	                                    }

	                                    ?>
	                            </select>
	                            </div>

								<input type="submit" onclick="hide(frmAdmit)" name="viewexam" class="btn btn-info pull-center" value="View Exam">
							</form>
				</div>

			<!-- Form for changing password-->

			<div class="text-center w3-card-4 ordinary-form" style="display:none" id="passfrm">
			<img src="img/icons/Close.png" class="pull-right" onclick="hide('passfrm')" title="Close Form">
					<h2 class="frm-text">Change Your Password <img src="./img/icons/User.png"></h2><br>					
					
					<form method="POST" action="home.php">
								<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="400ms">
								<label for="name">Type the old password: *</label>
								<input type="password" autofocus required id="name" name="pass0" class=" text-center form-control" placeholder="Enter the old password"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="700ms" data-wow-delay="600ms">
								<label for="upi">Enter the new password: *</label>
								<input type="password" required id="pass1" name="pass1" class=" text-center form-control" placeholder="Type new password"onkeyup="checker2('pass1','pass2','warn')"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="900ms" data-wow-delay="800ms">
								<label for="dob">Re-enter the new password: *</label>
								<input type="password" required id="pass2" name="pass2" class=" text-center form-control" placeholder="Re-type the new password" onkeyup="checker2('pass1','pass2','warn')"> <span id="warn"></span><br>
								</div>

								<input type="submit" onclick="hide('passfrm')" name="changepassword" class="btn btn-info pull-center" value="change password">
							</form>
				</div>

			<!-- Form for Book Addition-->
			<div class="text-center w3-card-4 ordinary-form" style="display: none;" id="frmBook">
			<img src="img/icons/Close.png" class="pull-right" onclick="hide('frmBook')" title="Close Form">
					<h2 class="frm-text">Add A New Book <img src="./img/icons/Address_Book.png"></h2><br>					
					
					<form method="POST" action="home.php">
								<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="400ms">
								<label for="bktitle">Book Title: *</label>
								<input type="text" autofocus required id="bktitle" name="bktitle" class=" text-center form-control" placeholder="Title. e.g. KLB Science Class 1">
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="700ms" data-wow-delay="600ms">
								<label for="type0">This book is for class: *</label>
	                            <select required name="class" id="type0" title="please select a class" class="form-control text-center">
	                                    <option value=""> *** select book class *** </option>
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

	                            <div class="form-group wow fadeInDown" data-wow-duration="900ms" data-wow-delay="800ms">
								<label for="type0">This book is for Subject: *</label>
	                            <select required name="subject" id="type0" title="please select a class" class="form-control text-center">
	                                    <option value=""> *** select book subject *** </option>
	                                    <?php 
	                                        $qq="select `label`, `id` from `subject`";
	                                        $rr=mysqli_query($conn,$qq);
	                                        while ($row=mysqli_fetch_array($rr,MYSQLI_BOTH)) {
	                                            $title= $row['label'];
	                                            echo "<option value=\"$title\"> *** $title *** </option>";
	                                        }
	                                    ?>
	                            </select>
	                            </div>
								<div class="form-group wow fadeInDown" data-wow-duration="1100ms" data-wow-delay="1000ms">
								<label for="noc">Number of Coppies: *</label>
								<input type="number" required id="noc" name="noc" class=" text-center form-control" placeholder="No. of coppies e.g 14"><br>
								</div>

								<input type="submit" onclick="hide('frmBook')" name="actAddBook" class="btn btn-info pull-center" value="Add book">
							</form>
				</div>


			<!-- Form for Teacher registration-->

				<div class="text-center w3-card-4 ordinary-form" style="display: none;" id="frmAdmitTeacher">
				<img src="img/icons/Close.png" class="pull-right" onclick="hide('frmAdmitTeacher')" title="Close Registration Form">
						<h2 class="frm-text">Register A New Teacher <img src="./img/icons/User.png"></h2><br>					
					
					<form method="POST" action="home.php">
								<div class="form-group wow fadeInDown" data-wow-duration="100ms" data-wow-delay="200ms">
								<label for="name">Teacher Name: *</label>
								<input type="text" autofocus required id="name" name="ttname" class=" text-center form-control" placeholder="Name. e.g. Mwenye Kiti">
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="300ms" data-wow-delay="400ms">
								<label for="upi">TSC Number: *</label>
								<input type="number" required id="upi" name="tscnum" class=" text-center form-control" placeholder="TSC Number. e.g 1234">
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
								<label for="tws">Teacher's Work Station: *</label>
								<input type="text" required id="tws" name="tws" class=" text-center form-control" placeholder="Name. e.g. Likoni Primary">
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="700ms" data-wow-delay="800ms">
								<label for="type0">Teacher's Designation: *</label>
	                            <select required name="type0" id="type0" title="please select type designation" class="form-control text-center">
	                                    <option value=""> *** Select Type *** </option>
	                                    <option value="teacher"> *** Teacher*** </option>
	                                    <option value="HTeacher"> *** Deputy Teacher *** </option>
	                                    <option value="HTeacher"> *** Head Teacher *** </option>
	                            </select>
	                            </div>

								<div class="form-group wow fadeInDown" data-wow-duration="900ms" data-wow-delay="1000ms">
								<label for="dob">Date of Birth: *</label>
								<input type="date" required id="dob" name="dob" class=" text-center form-control" placeholder="Date: MM/DD/YYYY">
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="1100ms" data-wow-delay="1200ms"> 
								<label for="dop">Date of Appointment: *</label>
								<input type="date" required id="dop" name="dop" class=" text-center form-control" placeholder="Date: MM/DD/YYYY">
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="1300ms" data-wow-delay="1400ms">
								<label for="passwd">Set Password: *</label>
								<input type="password"  required id="passwd" name="passwd" class=" text-center form-control" placeholder="Password *****" onkeyup="checker('passwd','b');"> <span id="b"></span>
								</div>

								<input type="submit" onclick="hide('frmAdmitTeacher')" name="admitTeacher" class="btn btn-info pull-center" value="Admit Teacher">
							</form>
				</div>
			

			<!-- Form for student registration -->

			<div class="text-center w3-card-4 ordinary-form" style="display:none" id="frmAdmit">
			<img src="img/icons/Close.png" class="pull-right" onclick="hide('frmAdmit')" title="Close Registration Form">
					<h2 class="frm-text">Register A New Student <img src="./img/icons/User.png"></h2><br>					
					
					<form method="POST" action="home.php">
								<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="400ms">
								<label for="name">Student Name: *</label>
								<input type="text" autofocus required id="name" name="stname" class=" text-center form-control" placeholder="Name. e.g. Mwenye Kiti"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="700ms" data-wow-delay="600ms">
								<label for="upi">Student UPI: *</label>
								<input type="text" required id="upi" name="upi" class=" text-center form-control" placeholder="UPI. e.g. MSA123"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="900ms" data-wow-delay="800ms">
								<label for="dob">Date of Birth: *</label>
								<input type="date" required id="dob" name="dob" class=" text-center form-control" placeholder="Date: MM/DD/YYYY"><br>
								</div>

								<div class="form-group wow fadeInDown" data-wow-duration="1100ms" data-wow-delay="1000ms">
                            <select required name="class" id="type0" title="please select a class" class="form-control text-center">
                                    <option value=""> *** Select Class *** </option>
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
								<input type="submit" onclick="hide(frmAdmit)" name="actAdmitStudent" class="btn btn-info pull-center" value="Admit Student">
							</form>
				</div>
				</div>

				<div class="row">
				<!-- A table to display curremnt listing of students-->
				<a name="students"> </a>

				<div class="text-center  ordinary-form w3-card-4">
					<h3 class="frm-text">Current Student Listing<img src="./img/icons/User.png"></h3><br>
					<div>

					<div id="search-bar form-group">
				<form method="post" action="">
					<input type="text" autofocus placeholder="Hi <?php echo $funame?>, Just start typing to search for student records" name="search-text" class="form-control text-center" onkeyup="showresult(this.value,'ser','txtHint');">
					<button  class="btn btn-info" id="btn-srch" type="submit" name="search-main"><i class="fa fa-search -fa-lg"></i> Search</button>
				</form>
				</div>

						<div>
						<br>

						<!-- displays search results table-->
						<div id="txtHint">
					
						</div>

						<table class="text-center w3-table w3-bordered w3-striped w3-border">
						<tr class="w3-cyan text-center">
							<th>Name</th>
							<th>UPI</th>
							<th>Date of Birth</th>
							<th>Class</th>
							<th colspan="2" class="text-center">Action</th>
						</tr>
						<?php
						$qq="select * from `students` order by `name` asc limit 10";
                                        $rr=mysqli_query($conn,$qq);
                                        while ($row=mysqli_fetch_array($rr,MYSQLI_BOTH)) {
                                            $name= $row['name'];
                                            $dob=$row['dateOfBirth'];
                                            $class=$row['class'];
                                            $upi=$row['upi'];

                                            echo "
                                            <tr>
                                            	<td>$name</td>
                                            	<td>$upi</td>
                                            	<td>$dob</td>
                                            	<td>$class</td>
                                            	<td><a href='edit_delete.php?request=stedit&upi=$upi&nm=$name&class=$class&dob=$dob'>Edit</a></td>
                                            	";

                                            	if (is_headTeacher()) {
                                            	echo
                                            	"
                                            	<td><a href='edit_delete.php?request=stdelete&upi=$upi&nm=$name&class=$class&dob=$dob'>Delete</a></td>";
                                            }
                                            else
                                            {
                                            	echo
                                            	"
                                            	<td><span onclick=\"(<script> alert('Delete operation can only be done by the Head Teacher or Deputy Head Teacher');</script>)\">Delete</span></td>";
                                            }

                                            echo"</tr>";
                                        }
						?>

						</table>
						</div>
					</div>
				</div>
				</div>


				<div class="row">
				<!-- A table to display curremnt listing of students-->

				<div class="text-center  ordinary-form w3-card-4">
					<h3 class="frm-text">Current Book Listing<img src="./img/icons/Address_Book.png"></h3><br>
					<div>
					<a name="books"> </a>

					<div id="search-bar form-group">
				<form method="post" action="">
					<input type="text" autofocus placeholder="Hi <?php echo $funame?>, start typing to search book records" name="search-text" class="form-control text-center" onkeyup="showresult(this.value,'book','hintBook');">
					<button  class="btn btn-info" id="btn-srch" type="submit" name="search-main"><i class="fa fa-search -fa-lg"></i> Search</button>
				</form>
				</div>

						<div>
						<br>

						<!-- displays search results table-->
						<div id="hintBook">
					
						</div>

						<table class="text-center w3-table w3-bordered w3-striped w3-border">
						<tr class="w3-cyan text-center">
							<th>Tittle</th>
							<th>Class</th>
							<th>Subject</th>
							<th>Number of Copies</th>
							<th colspan="2" class="text-center">Action / Book State</th>
						</tr>
						<?php
						$qq="select * from `books` order by `id` asc limit 10";
                                        $rr=mysqli_query($conn,$qq);
                                        while ($row=mysqli_fetch_array($rr,MYSQLI_BOTH)) {
                                            $title= $row['title'];
                                            $class=$row['class'];
                                            $subject=$row['subject'];
                                            $noc=$row['numberOfCopies'];

                                            echo "
                                            <tr>
                                            	<td>$title</td>
                                            	<td>$class</td>
                                            	<td>$subject</td>
                                            	<td>$noc</td>
                                            	";

                                            	if (is_headTeacher()) {
                                            		# code...
                                            	echo"
                                            	<td>Edit</td>
                                            	<td>Delete</td>
                                            </tr>";
                                        }else
                                        {
                                        	echo"
                                            	<td>Request Book</td>
                                            </tr>";
                                        }

                                        }

						?>

						</table>
						</div>
					</div>
				</div>
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