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
               
                <div class="header-title">
                    <h1>Calculations</h1>
                    <p>Display Employee salary deductions <span class="las la-chart-line">

                    </span> </p>
                </div>
            </div>
            <div class="header-action " style="text-align:center;">
                <h1>Allowance</h1>
            </div>
            <div class="header-action" style="text-align:center;">
                <a href="calculations.php">Go to deductions list</a>
            </div>
        </header>
        <main>
            <?php require_once 'process.php' ?>

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
                <div  class="subcontainer">
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM allowance") or die(mysqli->error);
             
            ?>
            <div class="row" style="width: 70%; float:right" >
                <table id="tableid" class="table  table-bordered table-sm" style=" background:white;width: calc(80vw - 320px);">
                    <legend>Allowance Information</legend>
                <thead class="bg-dark text-white">
                        <tr style="text-align:center;">
                            <th>Allowance Name</th>
                            <th >Description</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['allowanceName']; ?></td>
                    <td><?php echo $row['allowanceDescription']; ?></td>
                    <td><?php echo $row['allowanceAmount']; ?></td>
                    <td align="center">
                        <a href="process.php?allowanceDelete=<?php echo $row['allowanceId']; ?>">
                            <class class="btn btn-danger btn-sm">Delete</class>
                        </a>
                       
                    </td>
                </tr>
                <?php endwhile;  ?>
               

                </table>
            </div>


            <div style="width: 30%; float:left" class="row justify-content-enter">
            <form action="process.php" method="POST" class="forms" >
                <legend>Allowance form</legend>
                 <!-- Allowance Name-->
                 <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                <label>Allowance Name</label><br>
                
                <input type="text" name="allowanceName" class="form-control" 
                        value="" placeholder="" required>
                </div>
                
                <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="allowanceDescription" class="form-control" value="" required>
                </div>
                <div class="form-group">
                <label for="">Amount</label>
                <input type="number" name="allowanceAmount" class="form-control" value="" required>
                </div>
                
                
                
                
            
                    <button type="submit" class="btn btn-info" name="insertAllowance" style="margin-top:10px;">Save</button>
                    <a href="employees.php" id="cancel" name="cancel" class="btn btn-danger" style="margin-top:10px;">Cancel</a>
               
            </form>
            </div>
            </div>
       
      
           

           
            
           
            </div>
        </main>
    </div>

    <style>
         select#xyz {
   border:0px;
   outline:0px;
   color:var(--link-color);
}
    </style>
    <!-- refresh the page once the back button has been clicked -->
  <script>
 window.onunload = function(){};

 $(document).ready(function () {
    $('#tableid').DataTable();
});

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

</script>
</body>
</html>