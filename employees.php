<?php require_once("config.php");
require_once("process.php"); 
if(!isset($_SESSION["login_sess"])) 
{
    header("location:login.php"); 
}
  $email=$_SESSION["login_email"];
  $findresult = mysqli_query($dbc, "SELECT * FROM users WHERE email= '$email'");
if($res = mysqli_fetch_array($findresult))
{
$username = $res['username']; 
$fname = $res['fname'];   
$lname = $res['lname'];  
$email = $res['email'];  
$image= $res['image'];
}

 


 ?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Employees</title>

		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/employees.png">

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

        <link rel="stylesheet" href="style2.css">
    
    
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
								<div>
                <center>
            <?php if($image==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="images/'.$image.'" style="height:50px;width:50px;border-radius:50%;">';}?> 

<p></p>
  </center>
                </div>
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
							<a href="salary_matrix.html" class="dropdown-toggle no-arrow">
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
					<!-- Export Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20 pb-10 d-flex justify-content-center">
							<h4 class="text h4">EMPLOYEES</h4>
						</div>
						<div style="margin-left: 7px;"class="pd-10 pr-20 d-flex justify-content-start">
							<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-Employee">Add Employee</button>
						</div>
						<div class="d-flex justify-content-md-end">
							<!-- The Modal -->
							<div class="modal fade" id="add-Employee" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title w-100 text-center" id="modalLabel">
													Add Employee
												</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													×
												</button>
											</div>
											<div class="modal-body">
												<form action="process.php" method="POST">
													<div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Name</label>
														<div class="col-sm-12 col-md-10">
															<input name="name"  class="form-control" type="text" placeholder="Enter Employee Name" required>
														</div>
													</div>
                                                    <div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Position</label>
														<div class="col-sm-12 col-md-10">
															<select name="position" class="custom-select col-12">
                                                            <option value="">Select</option>
                                                                <?php
                                                            
                                                                $result_position = $mysqli->query("SELECT * FROM position") or die($mysqli->error());
                                                                while ($srow = mysqli_fetch_array($result_position)) {
                                                                    $srows[] = $srow;
                                                                }
                                                                foreach ($srows as $srow) {
                                                                    print "<option value='" . $srow['positionName'] . "'>" . $srow['positionName'] . "</option>";
                                                                }
                                                                ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Department</label>
														<div class="col-sm-12 col-md-10">
															<select name="departmentName" class="custom-select col-12">
                                                            <option value="">Select</option>
                                                                <?php
                                                            
                                                                $resultss = $mysqli->query("SELECT * FROM department") or die($mysqli->error());
                                                                while ($trow = mysqli_fetch_array($resultss)) {
                                                                    $trows[] = $trow;
                                                                }
                                                                foreach ($trows as $trow) {
                                                                    print "<option value='" . $trow['departmentName'] . "'>" . $trow['departmentName'] . "</option>";
                                                                }
                                                                ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-4 col-form-label">Salary Grade</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="sg" type="number" placeholder="Enter Employee's Salary Grade" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Step</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="step" type="number" placeholder="Enter Employee's Step">
														</div>
													</div>
                                                    <div>
                                                    <button type="submit" name="save" class="btn btn-primary">
													Save changes
												    </button>
                                                    <button style="position: absolute; margin-left: 10rem; bottom: 1rem;" type="button" class="btn btn-secondary" data-dismiss="modal">
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
                        
						<div class="pb-20">
                        <table id="tableid" class="table hover  data-table-export nowrap  ">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Salary Grade</th>
                            <th>Step</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['sg']; ?></td>
                    <td><?php echo $row['step']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td>
                       
                
                       
                        <select class="ass"id="xyz" onChange="window.location.href=this.value">
                        <option value="" disabled selected hidden>Actions</option>
                        <option  class="btn btn-link btn-sm" value="edit-record.php?edit=<?php echo $row['id']; ?>">Edit</option>
                            

                        <option  class="btn btn-link btn-sm" value="process.php?delete=<?php echo $row['id']; ?>">Delete</option>
                        <option  class="btn btn-link btn-sm" value="employee-pay.php?edit=<?php echo $row['id']; ?>">Pay</option>
                        <option  class="btn btn-link btn-sm" value="employee-details.php?edit=<?php echo $row['id']; ?>">View</option>
                        </select>
                       
                    </td>
                </tr>
                <?php endwhile;  ?>
               

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
       <style>
         select#xyz {
   border:0px;
   outline:0px;
   color:var(--link-color);
}
       </style>
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
