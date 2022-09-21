<?php
require_once("config.php");
if(!isset($_SESSION["login_sess"])) 
{
    header("location:login.php"); 
}
  $email=$_SESSION["login_email"];
  $findresult = mysqli_query($dbc, "SELECT * FROM users WHERE email= '$email'");
if($res = mysqli_fetch_array($findresult))
{
    $oldusername =$res['username'];     
$username = $res['username']; 
$fname = $res['fname'];   
$lname = $res['lname'];  
$email = $res['email'];  
$image= $res['image'];
}
$page = $_SERVER['PHP_SELF'];

require_once("process.php"); 


?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Deductions</title>

		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/calculator.png">

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/media.css">
	</head>
	<body>
		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>
        <div class="header header-dark">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			</div>
			<div class="header-right">
				<div class="mr-20 user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<!--<img src="" alt="" /> profile image here-->
								<i class="icon-copy bi bi-person-fill"></i>
							</span>
							<span class="user-name">Admin</span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="#"
								><i class="dw dw-user1"></i> Profile</a
							>
							<a class="dropdown-item" href="#"
								><i class="dw dw-settings2"></i> Account Setting</a
							>
							<a class="dropdown-item" href="login.html"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM data") or die(mysqli->error);
             
            ?>
           
		   
            <?php 
            function pre_r($array){
            

                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
            ?>
            
            
			<?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM deductions") or die(mysqli->error);
             
            ?>
        <div class="left-side-bar">
			<div class="brand-logo">
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
							<a href="index.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="employees.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-people"></span
								><span class="mtext">Employees</span>
							</a>
						</li>
						<li>
							<a href="salary_matrix.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-grid-3x2"></span
								><span class="mtext">Salary Matrix</span>
							</a>
						</li>
						<li>
							<a href="position.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-pin-map"></i></span
								><span class="mtext">Position</span>
							</a>
						</li>
						<li>
							<a href="#" class="dropdown-toggle">
								<span class="micon bi bi-calculator"></span
								><span class="mtext">Calculations</span>
							</a>
							<ul class="submenu">
								<li><a href="incentives.php">Incentives</a></li>
								<li><a href="deductions.php">Mandatory Deductions</a></li>
								<li><a href="other_deductions.php">Other Deductions</a></li>
                                <li><a href="#">Add Record</a></li>
							</ul>
						</li>
						<li>
							<a href="#;" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Payslips</span>
							</a>
						</li>
						<li>
							<a href="#;" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-envelope-paper"></i></span
								><span class="mtext">Payroll Report</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					
					<div class="card-box mb-30">
						<div class="pd-20 pb-10 d-flex justify-content-center">
							<h4 class="text h4">CALCULATIONS - MANDATORY DEDUCTIONS</h4>
                        </div>
						<div class="pd-10 pr-20">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-Employee">Add Deduction</button>
						</div>
						<div class="d-flex justify-content-md-end">
							<!-- The Modal -->
							
							<div class="modal fade" id="add-Employee" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title w-100 text-center" id="modalLabel">
													Add New Deduction
												</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													×
												</button>
											</div>
											<div class="modal-body">
												<form action="process.php" method="POST">
													<div class="form-group">
														<label class="col-sm-12 col-md-4 col-form-label">Deduction Name</label>
														<div class="col-sm-12 col-md-10">
															<input name="deductionName"  class="form-control" type="text" placeholder="Enter New Deduction Name" required>
														</div>
													</div>
                                                  
													
													<div class="form-group">
														<label class="col-sm-12 col-md-4 col-form-label">Description</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="description" type="text" placeholder="Enter Description " required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Amount</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="amount" type="number" placeholder="Enter Amount">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-4 col-form-label">Deduction Type</label>
														<div class="col-sm-12 col-md-10">
														<div class="col-sm-12 col-md-10">
															<select name="deductionType" id="" style="width: 250px;">
																<option value="percentage">Percentage</option>
																<option value="real_value">Real Value</option>
															</select>
														</div>
														</div>
													</div>
													<div class="form-group">
													<label class="col-sm-12 col-md-4 col-form-label">Deduction Limit</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="deductionLimit" type="number" placeholder="Enter Maximum Deduction" required>
														</div>
                                                    </div>
                                                    <div>
                                                    <button style="margin-left: 1rem;"type="submit" name="insertDeductions" class="btn btn-primary">
													Save changes
												    </button>
                                                    <button style="position: absolute; margin-left: 1rem; bottom: 1rem;" type="button" class="btn btn-secondary" data-dismiss="modal">
													Close
													</button>
                                                    </div>

												</form>
											</div>
											<div class="modal-footer">
												
											</div>
										</div>
									</div>
								</div>
						</div>
                        
						<div class="table-responsive">
                            <table class="table table-striped table-bordered">
                              <thead class="text-white text-center bg-secondary">
                                <tr>
                                  <th scope="col">Deduction Name</th>
                                  <th scope="col">Amount</th>
								  <th scope="col">Type</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
							  <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td ><?php echo $row['deductionName']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                 
                   
                    <td><?php $deduction_type = $row['deductionType'];
                    $deduction_Amount = $row['amount'];
                     if($deduction_type == 'percentage') {
                        echo $deduction_Amount.'%';
                     } else{
                        echo $deduction_Amount;
                     }?></td>
                    <td align="center">
                        <a href="process.php?deductionDelete=<?php echo $row['deductionId']; ?>">
                            <class class="btn btn-danger btn-sm">Delete</class>
                        </a>
                       
                    </td>
                </tr>
                <?php endwhile;  ?>
                               
  
                              </tbody>
                            </table>
                        </div>
                        
					</div>
					<!-- Export Datatable End -->
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					@ BSU-CMPS
				</div>
			</div>
		</div>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<!-- buttons for Export datatable -->
		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="vendors/scripts/datatable-setting.js"></script>
	</body>
</html>
