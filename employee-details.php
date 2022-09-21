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
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBO Payroll Management System</title>
    <link rel="stylesheet" href="style2.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/datatables.bootsrap4.min.css"/>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
  
</head>
<script>
     $(function() {
        $('#nav li a').click(function() {
           $('#nav li').removeClass();
           $($(this).attr('href')).addClass('active');
        });
     });
  </script>
<body style="background:var(--bg2);">
<section id="mainBody">
  <div id="bodyContent">
     
  </div>
</section>
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
 
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.js"></script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> 
    <input type="checkbox" name="" id="menu-toggle">
    <div class="sidebar">
        <div class="sidebar-container">
            <div class="brand">
                <h2>
                    <span></span>
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

                        <h4 style="padding-left:3px;">
                        <?php echo $fname ." ". $lname; ?> 
                        </h4>
                       <small></small>
                    </div>
                    
                </div>
            </div>
            <form action="">
            <div class="sidebar-menu" >
                <ul>
                    <li class="side-nav">
                        <a href="index.php" >
                            <span class="las la-adjust"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a class="current" href="employees.php" >
                            <span class="las la-users"></span>
                            <span>Employees</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="department.php">
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
                    <li class="side-nav">
                        <a href="calculations.php" >
                            <span class="las la-chart-bar"></span>
                            <span>Calculations</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="" >
                            <span class="las la-calendar"></span>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="side-nav">
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
            <div  class="header-title-wrapper">
                
                <div class="header-title">
                    <h1>Employees</h1>
                    <p>Display Employee deductions and allowances <span class="las la-chart-line">
                    <h2 style=" font-size:48px;font-family:'Times New Roman';"><?php echo $name; ?></h2>
                    </span> </p>
                </div>
            </div>
            <div class="header-action"  >
                
                    
               
                  
              


<!-- Modal -->
<div style="margin-right:8rem; "class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:var(--bg);">
        <h5 class="modal-title" id="exampleModalLabel">Add Allowance</h5>
        <button style="height:5px;width:15px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding-left:8rem; background:var(--bg2);">
      <div class="row justify-content-enter" >
            <form action="process.php" method="post" class="forms" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
                <div class="form-group">
                <label for="">Allowance</label><br>
                <select name="employeeAllowanceId" id="" style="width: 250px;">
                    <option value="">Select</option>
                    <?php
                
                    $resultsss = $mysqli->query("SELECT * FROM allowance") or die($mysqli->error());
                    while ($trowt = mysqli_fetch_array($resultsss)) {
                        $trowst[] = $trowt;
                    }
                    foreach ($trowst as $trowt) {
                        print "<option value='" . $trowt['allowanceId'] . "'>" . $trowt['allowanceName'] . "</option>";
                        
                    }
                    ?>
                </select>
                </div>
                
               

               
                
                <?php
                if ($update == true ): 
                 ?>
                    <button type="submit" class="btn btn-info" name="addEmployeeAllowance" value="process.php?addEmployeeAllowance">Insert</button>
                    <a href="employees.php" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
               <?php else: ?>
                <button type="submit" class="btn btn-success" name="save" style="margin-top:10px;">Save</button>
                <a href="employees.php" id="cancel" name="cancel" class="btn btn-danger" style="margin-top:10px;">Cancel</a>
                <?php endif; ?>
            </form>
            </div>
      </div>
      <div class="modal-footer" style="background:var(--bg);">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
            </div>
            <div class="header-action" style="position:absolute;right:1rem; top:1rem;">
            <div class="dropdown">
           
                <button name="papa" class="btn btn-light dropdown-toggle link-color" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Profile Menu
                </button>
  
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="las la-user dropdown-item link-color" href="account.php">My Profile</a></li>
                    <li><a class="las la-cog dropdown-item link-color" href="edit-profile.php">Account settings </a></li>
                    <li><a class="las la-sign-out-alt dropdown-item link-color" href="logout.php">Log out</a></li>
   
                    </ul>
 
            </div>
                
            </div>
        </header>
        <main>
           

            <?php

            if (isset($_SESSION['message'])):
            ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">

                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        
            </div>
            <?php endif ?>
            <div class="container">
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM employeeallowance where employeeId=$id") or die(mysqli->error);
             
            ?>
            <div class="row" style="width: 70%; float:right;" >
            <table id="tableid" class="table  table-bordered table-sm" style=" background:white;width: calc(60vw - 320px);">
                    <legend>Employee Allowance Information</legend>
                <thead class="bg-dark text-white">
                        <tr style="text-align:center;">
                            <th>Allowance Name</th>
                            <th >Amount</th>
                            <th >Actions</th>
                        </tr>
                    </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['eaName']; ?></td>
                    <td><?php echo $row['employeeallowanceAmount']; ?></td>
                  
                    <td align="center">
                        <a href="process.php?employeeallowanceDelete=<?php echo $row['eaID']; ?>">
                            <class class="btn btn-danger btn-sm">Delete</class>
                        </a>
                       
                    </td>
                </tr>
                <?php endwhile;  ?>
               

                </table>
            </div>


            

            <div  class="row" style="width: 30%; float:left;">
            <!-- Modal -->
<div style="margin-right:8rem; "class="modal fade" id="exampleModals" tabindex="-1" aria-labelledby="deductionLabelModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:var(--bg);">
        <h5 class="modal-title" id="deductionLabelModal">Add Deductions</h5>
        <button style="height:5px;width:15px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="padding-left:8rem; background:var(--bg2);">
      <div class="row justify-content-enter" >
            <form action="process.php" method="post" class="forms2" >
            <input type="hidden" name="id" value="<?php echo$id ?>">
                <div class="form-group">
                <label for="">Deductions</label><br>
                <select name="employeeDeductionId" id="" style="width: 250px;">
                    <option value="">Select</option>
                    <?php
                
                    $result = $mysqli->query("SELECT * FROM deductions") or die($mysqli->error());
                    while ($trow = mysqli_fetch_array($result)) {
                        $trows[] = $trow;
                    }
                    foreach ($trows as $trow) {
                        print "<option value='" . $trow['deductionId'] . "'>" . $trow['deductionName'] . "</option>";
                    }
                    ?>
                </select>
                </div>
                
               

               
                
                <?php
                if ($update == true ): 
                 ?>
                     <button type="submit" class="btn btn-info" name="addEmployeeDeduction" value="process.php?addEmployeeDeduction">Insert</button>
                    <a href="employees.php" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
               <?php else: ?>
                <button type="submit" class="btn btn-success" name="save" style="margin-top:10px;">Save</button>
                <a href="employees.php" id="cancel" name="cancel" class="btn btn-danger" style="margin-top:10px;">Cancel</a>
                <?php endif; ?>
            </form>
            </div>
      </div>
      <div class="modal-footer" style="background:var(--bg);">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
            <form action="process.php" method="POST" class="forms3" >
                <legend>Allowance form</legend>
                 <!-- Allowance Name-->
                 <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                <label>Allowance Name</label><br>
                 <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Allowance
                </button>
                </div>
                
                <div class="form-group">
                <label for="">Deductions</label><br>
                 <!-- Button trigger modal -->
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModals">
                Add Deductions
                </button>
                </div>
                </div>
               
                  
         
            </form>
            </div>


            <div class="container">
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM employeedeductions where employeeId=$id") or die(mysqli->error);
             
            ?>
            <div class="row" style="width: 70%; float:right;" >
            <table id="tableid" class="table  table-bordered table-sm" style=" background:white;width: calc(60vw - 320px);">
                    <legend>Employee Deductions Information</legend>
                <thead class="bg-dark text-white">
                        <tr style="text-align:center;">
                            <th>Deduction Name</th>
                            <th >Amount</th>
                            <th >Actions</th>
                        </tr>
                    </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['edName']; ?></td>
                    <td><?php echo $row['employeeDeductionAmount']; ?></td>
                  
                    <td align="center">
                        <a href="process.php?employeeDeductionDelete=<?php echo $row['edID']; ?>">
                            <class class="btn btn-danger btn-sm">Delete</class>
                        </a>
                       
                    </td>
                </tr>
                <?php endwhile;  ?>
               

                </table>
            </div>


            

            <div  class="row" style="width: 30%; float:left;">
           
                </div>
               
                  
         
            </form>
            </div>
            <?php 
            function pre_r($array){
            

                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
            ?>
            
           
            </div>
        </main>
    </div>

    
 
   <style>
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

    .link-color {
       
       color: var(--link-color);
     }
     .dropdown-item:hover{
       text-decoration: underline;
      
     }
     
       
    select#xyz {
   border:0px;
   outline:0px;
   color:var(--link-color);
}
.ass:hover{
    text-decoration: underline;
}
.table{
    color:var(--table-color);
}
.th{
    font-size:.9rem;
   
}

/* remove the horizontal scroll bar*/
html, body {
  max-width: 100%;
  overflow-x: hidden;
}


   </style>

   
   <!-- refresh the page once the back button has been clicked -->
  <script>
 window.onunload = function(){};

 


if (window.history.state != null && window.history.state.hasOwnProperty('historic')) {
    if (window.history.state.historic == true) {
        document.body.style.display = 'none';
        window.history.replaceState({historic: false}, '');
        window.location.reload();
    } else {
        window.history.replaceState({historic  : true}, '');
    }
} else {
    window.history.replaceState({historic  : true}, '');
    
}

$('table').dataTable({searching: false, paging: false, info: false});

</script>
</body>
</html>