<?php
require_once("process.php"); 
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Salary Matrix</title>

		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/matrix.png">

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
							<a class="dropdown-item" href="#"
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
							<a href="index.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="employees.html" class="dropdown-toggle no-arrow">
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
							<a href="position.html" class="dropdown-toggle no-arrow">
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
								<li><a href="incentives.html">Incentives</a></li>
								<li><a href="deductions.html">Mandatory Deductions</a></li>
								<li><a href="other_deductions.html">Other Deductions</a></li>
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
							<h4 class="text h4">SALARY MATRIX</h4>
						</div>
						<div class="pd-10 pr-20">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add New Salary</button>
						</div>
						<div class="d-flex justify-content-md-end">
							<!-- The Modal -->
							<div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
										<form method="POST" action="save_user.php">
												<div class="modal-header">
													<h3 class="modal-title">Add New Salary</h3>
												</div>
												<div class="modal-body">
													<div class="col-md-2"></div>
													<div class="col-md-8">
														<div class="form-group">
															<label>Salary Grade</label>
															<input type="text" name="salaryGrade" class="form-control" required="required"/>
														</div>
														<div class="form-group">
															<label>Step</label>
															<input type="text" name="salaryStep" class="form-control" required="required" />
														</div>
														<div class="form-group">
															<label>Salary Amount</label>
															<input type="text" name="salaryAmount" class="form-control" required="required"/>
														</div>
													</div>
												</div>
												<div style="clear:both;"></div>
												<div class="modal-footer">
													<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
													<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
												</div>
												</div>
											</form>
										</div>
									</div>
								</div>
						</div>
                        
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead class="text-white bg-secondary">
									<tr>
										<th class="table-plus datatable">Salary Grade</th>
									
                                        <th>Step</th>
                                        <th>Salary Amount</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                <?php
                                        require 'conn.php';
                                        $query = mysqli_query($conn, "SELECT * FROM `salarydata`") or die(mysqli_error());
                                        while($fetch = mysqli_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <td ><?php echo $fetch['salaryGrade']?></td>
                                        <td><?php echo $fetch['salaryStep']?></td>
                                        <td><?php echo $fetch['salaryAmount']?></td>
                                        <td	>
										
										<button class="btn btn-warning" data-toggle="modal" type="button" data-target="#update_modal<?php echo $fetch['id']?>"><span class="glyphicon glyphicon-edit"></span> Edit</button>
						
									</td>
                                    </tr>
                                    <?php
                                        
                                        include 'update_user.php';
                                        
                                        }
                                    ?>
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

		<script src="js/bootstrap.js"></script>	
	</body>
</html>
