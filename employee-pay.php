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

$fres = mysqli_query($mysqli, "SELECT * FROM data WHERE id= '$id'");
if($res = mysqli_fetch_array($fres))
{
$name = $res['name']; 
$position = $res['position']; 
$sg = $res['sg']; 
$step = $res['step']; 
$salary = $res['salary'];  
$departmentName = $res['departmentName'];
}

$value_sum = 0;
$value_difference = 0;
$net_amount = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBO Payroll Management System</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="style2.css">
    <script src="script.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<script>
     $(function() {
        $('#nav li a').click(function() {
           $('#nav li').removeClass();
           $($(this).attr('href')).addClass('active');
        });
     });
  </script>
<body >

    <input type="checkbox" name="" id="menu-toggle">
    <div class="sidebar">
        <div class="sidebar-container">
            <div class="brand">
                <h2>
                    <span class="lab la-staylinked"></span>
                    CBO Payroll Management System
                </h2>
            </div>
            <div class="sidebar-avartar">
                <div>
                <center>
            <?php if($image==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="images/'.$image.'" style="height:50px;width:50px;border-radius:50%;">';}?> 

<p></p>
  </center>
                </div>
                <div class="avartar-info">

                    <div class="avartar-text">

                        <h4>
                        <?php echo $fname ." ". $lname; ?> 
                        </h4>
                        <small>
                        <?php echo $email; ?> 
                        </small>
                    </div>
                   

                </div>
            </div>
            <form action="">
            <div class="sidebar-menu" >
                <ul>
                    <li>
                        <a href="index.php" >
                            <span class="las la-adjust"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a  href="employees.php" >
                            <span class="las la-users"></span>
                            <span>Employees</span>
                        </a>
                    </li>
                    <li  class="side-nav">
                        <a href="department.php" >
                            <span class="las la-users" ></span>
                            <span>Departments</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="position.php">
                            <span class="las la-users" ></span>
                            <span>Position</span>
                        </a>
                    </li>
                    <li>
                        <a class="current" href="calculations.php" >
                            <span class="las la-chart-bar"></span>
                            <span>Calculations</span>
                        </a>
                    </li>
                    <li>
                        <a href="" >
                            <span class="las la-calendar"></span>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="account.php">
                            <span class="las la-user"></span>
                            <span>Account</span>
                        </a>
                    </li>
                    
                </ul>
              
            </div>
            </form>
           <!--side-card was here-->
        </div>
    </div>
    <div class="main-content">
    <header>
            <div class="header-title-wrapper">
                <label for="">
                    <span class="las la-bars">

                    </span>
                </label>
                <div class="header-title">
                    <h1>Employees</h1>
                    <p>Display Employee Records <span class="las la-chart-line">

                    </span> </p>
                </div>
            </div>
            <div style="text-align:center;" class="header-action">
                <h1>Employee Payroll</h1>
                <h2 style="font-family:cursive;">Benguet State University</h2>
                <h3 style="font-family:cursive;">La trinidad Benguet</h3>
                <h4 style="font-family:cursive;">Administrative Services Division</h4>
                <h3 style="font-family:Brush Script MT;">Compensation Benefits and other obligations office</h3>
            </div>
        </header>
        <main>
        <div class="container mt-5 mb-5" style="width: calc(95vw - 320px);">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center lh-1 mb-2">
                <h6 class="fw-bold">Payslip</h6> <span style="display:inline;" class="fw-normal">Payment slip for the month of <p style="display:inline;" id="month"></p> <p style="display:inline;" id="year"></p></span>
            </div>
            
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Salary Grade</span> <small class="ms-3"><?php echo $sg; ?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3"><?php echo $name; ?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Step</span> <small class="ms-3"><?php echo $step; ?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Position</span> <small class="ms-3"><?php echo $position; ?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">ESI No.</span> <small class="ms-3"></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Department</span> <small class="ms-3"><?php echo $departmentName; ?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                           
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******1</small> </div>
                        </div>
                    </div>
                </div>
            
                <table class="table table-borderless" style="width: 50%; float:left;">
        <thead>
			<tr>
				<th>Earnings</th>
				<th>Amount</th>
		
				
			</tr>
		</thead>

        <tbody>
            <?php
         
          $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
          $result = $mysqli->query("SELECT * FROM employeeallowance where employeeId=$id") or die(mysqli->error);
         
          $allowance_results = $mysqli->query("SELECT employeeId, sum(employeeallowanceAmount) AS value_sum FROM employeeallowance where employeeId=$id") or die(mysqli->error);
          while($allowance_rows = $allowance_results->fetch_assoc()) {
                
            $fetched_sum = $allowance_rows['value_sum'];
           
        }
        $current_employee_salary = $mysqli->query("SELECT * FROM data where id=$id") or die(mysqli->error);
         
      
            $gross_amount= $fetched_sum + $salary;
     

           
      
            // read data of each row
			while($row = $result->fetch_assoc()) {
                
                echo "<tr>
                    
                    <td>" . $row["eaName"] . "</td>
                    <td>" . number_format($row["employeeallowanceAmount"],2) . "</td>
                 
                    
                </tr>";
            }
            
            
            
            ?>
           <tr>
           <td>Basic</td>
            <td><?php echo number_format($salary,2); ?></td>
           </tr>
           <tr>
           <td>Gross Amount</td>
            <td><?php echo number_format($gross_amount,2); ?></td>
           </tr>
        </tbody>
    </table>
    

    <table class="table table-borderless" style="width: 50%; float:right;">
        <thead>
			<tr>
				
				<th>Deductions</th>
				<th>Amount</th>
				
			</tr>
		</thead>

        <tbody>
            <?php
         
          $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
          $select_all_deduction = $mysqli->query("SELECT * FROM employeedeductions where employeeId=$id") or die(mysqli->error);
         
          $deduction_results = $mysqli->query("SELECT employeeId, sum(employeeDeductionAmount) AS value_difference FROM employeedeductions where employeeId=$id") or die(mysqli->error);
          while($deduction_rows = $deduction_results->fetch_assoc()) {
                
            $fetched_difference = $deduction_rows['value_difference'];
           
        }
   
      
            // read data of each row
			while($deduction_row = $select_all_deduction->fetch_assoc()) {
                echo "<tr>
                
                    <td>" . $deduction_row["edName"] . "</td>
                   
                    <td>" . number_format($deduction_row["employeeDeductionAmount"],2) . "</td>
                </tr>";
            }
            $net_amount = $gross_amount - $fetched_difference;  
         
            ?>
             <tr>
           <td>Total Deduction</td>
            <td><?php echo number_format($fetched_difference,2); ?></td>
           </tr>
        </tbody>
    </table>

            </div>
            <div class="row">
                <div class="col-md-4"> <br> <span class="fw-bold">Net Amount : <?php echo number_format($net_amount,2); ?></span> </div>
                <div class="border col-md-8">
                    <div class="d-flex flex-column"> 
                        <span>In Words</span> <span>  <?php 
                        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                        echo $f->format($net_amount);
                        
                        ?> </span> </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">Remarks</span> <span class="mt-4">Authorised Signatory</span> </div>
            </div>
        </div>
    </div>
</div>
        </main>
    </div>

    <style>
        html, body {
  max-width: 100%;
  overflow-x: hidden;
}
/* scrollbar styling
 */

::-webkit-scrollbar {
    -webkit-appearance: none;
}
::-webkit-scrollbar:vertical {
    width: 11px;
}
::-webkit-scrollbar:horizontal {
    height: 11px;
}
::-webkit-scrollbar-thumb {
    border-radius: 8px;
    border: 2px solid white; /* should match background, can't be transparent */
    background-color: rgba(0, 0, 0, .5);
}
::-webkit-scrollbar-track { 
    background-color: #fff; 
    border-radius: 8px; 
} 


    </style>

    <script>
        const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

const d = new Date();
let name = month[d.getMonth()];
document.getElementById("month").innerHTML = name;

document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>
</body>
</html>