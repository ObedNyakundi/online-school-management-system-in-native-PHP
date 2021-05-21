<!-- Show the current user's profile-->
				<div class="user-details text-center w3-card-2">
					<h2>Profile</h2>
					<div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>

					<div>
						<img src="./img/members/default.jpg" class="featured-thumbnail">

						<div class='user-details'>
							<?php 
							$sqprof="select * from `teacher` where `tscNum`='$tsc'";
							$user_record=mysqli_fetch_array(mysqli_query($conn,$sqprof),MYSQLI_BOTH);

							$current_working_station=$user_record['currentWorkingStation'];
							$date_of_appointment=$user_record['dateOfAppointment'];

							echo "
							<h3> $uname </h3>
							<h4> <span class='dtag'> TSC Num.: </span> <span class='dval'> $tsc </span> <br/>

								<span class='dtag'> Ac. Type: </span> <span class='dval'> $type </span> <br/>
								<span class='dtag'> Work Station: </span> <span class='dval'> $current_working_station </span>  <br/>
								 <span class='dtag'> Appointed on:</span> <span class='dval'> $date_of_appointment </span>  <br/> </h4>
							";

							?>
						</div>
					</div>
				</div>
