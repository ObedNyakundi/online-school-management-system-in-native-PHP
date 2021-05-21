<?php 
	require "connection.php";

	//this page should never be loaded directly. it is used by ajax for live searching by members, admins, trainers anyone according to how i have defined him/her.

	
	if (isset($_GET["act"])) {

		$data=uncrack($_GET["q"]);
		$option_type=$_GET["act"];


		if ($option_type=='ser')
				{  
				//this works for admin Members search page only
				$sqm="SELECT * FROM `students` WHERE `name` LIKE '%$data%' OR `upi` LIKE '%$data%' OR `class` LIKE '%$data%' ORDER BY `name` ASC limit 10";
						$rec=mysqli_query($conn,$sqm);
						echo "<h3 class='frm-text'> search results...</h3>";

						echo "<table class=\"text-center w3-table w3-bordered w3-striped w3-border  w3-hoverable\">
								<tr class=\"w3-cyan text-center\">
									<th>Name</th>
									<th>UPI</th>
									<th>Date of Birth</th>
									<th>Class</th>
									<th colspan=\"2\" class=\"text-center\">Action</th>
								</tr>";
						
						                        while ($row=mysqli_fetch_array($rec,MYSQLI_BOTH)) {
		                                            $name= $row['name'];
		                                            $dob=$row['dateOfBirth'];
		                                            $class=$row['class'];
		                                            $upi=$row['upi'];

		                                            echo "
		                                            <tr style='background:#ff9'>
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
						echo "</table>";

			}
			elseif ($option_type=='book') 
				{  
				//this works for admin Members search page only
				$sqm="SELECT * FROM `books` WHERE `title` LIKE '%$data%' OR `subject` LIKE '%$data%' OR `class` LIKE '%$data%' ORDER BY `id` ASC limit 10";
				
						$rec=mysqli_query($conn,$sqm);

						echo "<h3 class='frm-text'> search results...</h3>";

						echo "<table class=\"text-center w3-table w3-bordered w3-striped w3-border  w3-hoverable\">
								<tr class=\"w3-cyan text-center\">
									<th>Tittle</th>
									<th>Class</th>
									<th>Subject</th>
									<th>Number of Copies</th>
									<th colspan=\"2\" class=\"text-center\">Action / Book State</th>
								</tr>";
						
						                 while ($row=mysqli_fetch_array($rec,MYSQLI_BOTH)) {
                                            $title= $row['title'];
                                            $class=$row['class'];
                                            $subject=$row['subject'];
                                            $noc=$row['numberOfCopies'];

                                            echo "
                                            <tr style='background:#ff9'>
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

						echo "</table>";

			}
	elseif ($option_type=='Main') {
		# code...
		$sq0="select * from members where Type='Admin'";
					if (mysqli_query($conn,$sq0)) {
						$record=mysqli_query($conn,$sq0);
						while ($row=mysqli_fetch_array($record,MYSQLI_BOTH)) {
							$admin_name=$row["Name"];
							$first_name=substr($admin_name, 0,strpos($admin_name, " "));
							$admin_post=$row["post"];
							$admin_fb=$row["Facebook"];
							$admin_tweeter=$row["Twitter"];
							$admin_gplus=$row["googlePlus"];
							$admin_pic=$row["Pic"];
							echo "
						<figure class=\"team-member col-md-4 col-sm-6 col-xs-12 text-center wow fadeInUp animated\" data-wow-duration=\"500ms\">
						<div class=\"member-thumb\">
							<img src=\"img/members/$admin_pic\" alt=\"Team Member\" class=\"img-responsive service-thumbnail\">
							<figcaption class=\"overlay\">
								<h5>Contact $first_name </h5>
								<p>choose any of the following links:</p>
								<ul class=\"social-links text-center\">
									<li><a href=\"http://$admin_tweeter\"><i class=\"fa fa-twitter fa-lg\"></i></a></li>
									<li><a href=\"http://$admin_fb\"><i class=\"fa fa-facebook fa-lg\"></i></a></li>
									<li><a href=\"http://$admin_gplus\"><i class=\"fa fa-google-plus fa-lg\"></i></a></li>
								</ul>
							</figcaption>
						</div>
						<h4>$admin_name</h4>
						<span>$admin_post</span>
					</figure>

							";

						}
					}
					else{
						echo "<div class='alert alert-danger fade in'> <strong>Hello Visitor.</strong> <br> 
					There is a connection problem to Makers Database. Please check us out again later <br>
					<a href=\"home.php\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"> &times;</a>
					</div>";
					}
	}
	elseif ($option_type=='sear2') {
		//this works for admin eventss search page only
		
		$sqm="SELECT * FROM `events` WHERE `title` LIKE '%$data%' OR `Description` LIKE '%$data%' OR `Location` LIKE '%$data%' ORDER BY `Type` ASC";
				$rec=mysqli_query($conn,$sqm);
				echo "<h3 class='frm-text'> search results...</h3>";

				echo "<table class=\"text-center w3-table w3-bordered w3-striped w3-border  w3-hoverable\">
						<tr class=\"w3-cyan text-center\">
							<th>Image</th>
							<th>Title</th>
							<th>Description</th>
							<th>Location</th>
							<th>Date</th>
							<th colspan=\"2\" class=\"text-center\">Action</th>
						</tr>";
				
				while ($rw=mysqli_fetch_array($rec)) {
					$even_img=$rw["Image"];
					$even_name=$rw["title"];
					$even_desc=$rw["Description"];
					$even_loc=$rw["Location"];
					$even_date=$rw["eventDate"];

					echo "<tr class='w3-pink'>
							<td><img alt='$even_name image' src='./img/events/$even_img' class='td-thumbnail'></td>
							<td>$even_name</td>
							<td>$even_desc</td>
							<td>$even_loc</td>
							<td>$even_date</td>
							<td><a href='' class='sear1'>Edit <i class='fa fa-edit fa-lg'></i> </a></td>
							<td><a href='' class='sear1'>Delete <i class='fa fa-trash fa-lg'></i></a></td>
						</tr>
					";
				}
				echo "</table>";


	}
	else{
		echo "";
	}

	}
?>