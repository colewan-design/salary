<?php require_once("config.php");
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

$page = $_SERVER['PHP_SELF'];


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
    
    <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
     <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
     <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
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
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <input type="checkbox" name="" id="menu-toggle">
    <div class="sidebar">
        <div class="sidebar-container">
            <div class="brand">
                <h2>
                    <span ></span>
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
                       
                    </div>
                   

                </div>
            </div>
            <form action="" >
            <div class="sidebar-menu">

                <ul  >
                    <li class="side-nav">
                        <a href="index.php" >
                            <span class="las la-adjust"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="employees.php">
                            <span class="las la-users" ></span>
                            <span>Employees</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="calculations.php" >
                            <span class="las la-chart-bar"></span>
                            <span>Calculations</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="">
                            <span class="las la-calendar"></span>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="side-nav">
                        <a href="account.php" class="current"> 
                            <span class="las la-user"></span>
                            <span>Account</span>
                        </a>
                    </li>
                    
                </ul>
             <!--php code here-->
                <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM data") or die(mysqli->error);
             
            ?>
            </div>
            </form>
           <!--side-card was here-->
        </div>
    </div>
    <div class="main-content">
        <header >
            <div class="header-title-wrapper">
               
                <div class="header-title">
                    <h1>Hi <?php echo $username ?>!</h1>
                    <p>Display Admin Account <span class="las la-chart-line">

                    </span> </p>
                </div>
            </div>
           
            <div class="header-action" style="position:absolute;right:1rem; top:1rem;">
            <div class="dropdown">
           
                <button name="papa" class="btn btn-light dropdown-toggle link-color" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Profile Menu
                </button>
  
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="las la-user dropdown-item link-color" href="account.php">My Profile</a></li>
                    <li><a class="las la-cog dropdown-item link-color" href="profile.php">Account settings </a></li>
                    <li><a class="las la-sign-out-alt dropdown-item link-color" href="logout.php">Log out</a></li>
   
                    </ul>
 
            </div>
                
            </div>
        </header>
        <main>
        <div class="container">
    <div class="row ">
       
        <div class="col-sm-6">
           
     <form action="" method="POST" enctype='multipart/form-data'>
  <div class="login_form">

 <?php 
 if(isset($_POST['update_profile'])){
$fname=$_POST['fname'];
 $lname=$_POST['lname'];  
 $username=$_POST['username']; 
 $folder='images/';
 $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $extension = end($file_name_array);
 $new_image_name ='profile_'.rand() . '.' . $extension;
  if ($_FILES["image"]["size"] >10000000) {
   $error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
 
}
 if($file != "")
  {
if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG") {
    
   $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
}
}

$sql="SELECT * from users where username='$username'";
      $res=mysqli_query($dbc,$sql);
   if (mysqli_num_rows($res) > 0) {
$row = mysqli_fetch_assoc($res);

   if($oldusername!=$username){
     if($username==$row['username'])
     {
           $error[] ='Username alredy Exists. Create Unique username';
          } 
   }
}
    if(!isset($error)){ 
          if($file!= "")
          {
            $stmt = mysqli_query($dbc,"SELECT image FROM  users WHERE email='$email'");
            $row = mysqli_fetch_array($stmt); 
            $deleteimage=$row['image'];
unlink($folder.$deleteimage);
move_uploaded_file($file, $folder . $new_image_name); 
mysqli_query($dbc,"UPDATE users SET image='$new_image_name' WHERE email='$email'");
          }
           $result = mysqli_query($dbc,"UPDATE users SET fname='$fname',lname='$lname',username='$username' WHERE email='$email'");
           if($result)
           {
      
           }
           else 
           {
            $error[]='Something went wrong';
           }

    }


        }    
        if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
}


        ?> 
     <form method="post" enctype='multipart/form-data' action="">
          <div class="row">
            <div class="col"></div>
           <div class="col-9" > 
            <center>
            <?php if($image==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="images/'.$image.'" style="height:150px;width:150px;border-radius:50%;">';}?> 
                <div class="form-group">
                <label>Change Profile Picture &#8595;</label>
                <input class="form-control" type="file" name="image" style="width:100%;" >
            </div>

  </center>
           </div>
           
         </div>
          </div>

          <div class="form-group">
          <div class="row"> 
            <div class="col-3">
                <label>First Name</label>
            </div>
             <div class="col">
                <input type="text" name="fname" value="<?php echo $fname;?>" class="form-control" required>
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Last Name</label>
            </div>
             <div class="col">
                <input type="text" name="lname" value="<?php echo $lname;?>" class="form-control" required>
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Username</label>
            </div>
             <div class="col">
                <input type="text" name="username" value="<?php echo $username;?>" class="form-control" required>
            </div>
          </div>
      </div>
    

           <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
<button onclick="return confirm('Are you sure?');"  href="<?php $page?> "class="btn btn-success" name="update_profile">Save Profile</button>

            </div>
           </div>
       </form>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div> 
        </main>
    </div>
    <style>

      .link-color {
       
        color: var(--link-color);
      }
      .dropdown-item:hover{
        text-decoration: underline;
       
      }
     
   .errmsg{ 
  margin: 2px auto;
  border-radius: 5px;
  border: 1px solid red;
  background: pink;
  text-align: left;
  color: brown;
  padding: 1px;
}
.successmsg{
  margin: 5px auto;
  border-radius: 5px;
  border: 1px solid green;
  background: #33CC00;
  text-align: left;
  color: white;
  padding: 10px;
}

                 
    </style>
   
  
</body>
</html>
