<?php



//declare database
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));  
$result = $mysqli->query("SELECT * FROM data") or die(mysqli->error);

$findresult = mysqli_query($mysqli, "SELECT * FROM salaryData");
if($res = mysqli_fetch_array($findresult))
{
$salaryAmount = $res['salaryAmount']; 
$salaryGrade = $res['salaryGrade'];   
$salaryStep = $res['salaryStep'];  

}
while($row = $findresult->fetch_assoc()){
  $salaryAmount = $row['salaryAmount']; 
}
$id = 0;  
$update = false;
$name = '';
$position = '';
$sg = '';
$step = '';
$username = '';
$gsis = 0;
$hdmf = 0;
$philhealth = 0;
$salary = 0;
$pera = 2000;
$eaName = '';
$eaAmount = '';
$fetched_sum = 0;
$gross_amount = 0;
//insert new salary
if(isset($_POST['saveNewSalary'])){
  $salaryGrade = $_POST['salaryGrade'];
  $salaryAmount = $_POST['salaryAmount'];
  $salaryStep = $_POST['salaryStep'];
  $mysqli->query("INSERT INTO salaryData (salaryGrade, salaryAmount, salaryStep) VALUES ('$salaryGrade','$salaryAmount','$salaryStep')") or
  die($mysqli->error);

  header("location:salary.php");
//insert employee allowance
}
if(isset($_POST['addEmployeeAllowance'])){
  $employeeId = $_POST['id'];
  
  $employeeAllowanceId = $_POST['employeeAllowanceId'];
  
  $result = $mysqli->query("SELECT * FROM allowance WHERE allowanceId=$employeeAllowanceId") or die($mysqli->error());
        $row = $result->fetch_array();
        $employeeAllowanceName = $row['allowanceName'];
        $employeeallowanceAmount = $row['allowanceAmount'];
       
    $mysqli->query("INSERT INTO employeeallowance ( employeeallowanceAmount, employeeId, eaName, allowanceId) VALUES ('$employeeallowanceAmount', '$employeeId', '$employeeAllowanceName', '$employeeAllowanceId')") or
    die($mysqli->error);

  header("location:".$_SERVER['HTTP_REFERER']);
}
//insert employee deduction
if(isset($_POST['addEmployeeDeduction'])){
  $employeeId = $_POST['id'];
  
  $employeeDeductionId = $_POST['employeeDeductionId'];
  
        $result = $mysqli->query("SELECT * FROM deductions WHERE deductionId=$employeeDeductionId") or die($mysqli->error());
        $row = $result->fetch_array();

        $employee_salary = $mysqli->query("SELECT * FROM data WHERE id=$employeeId") or die($mysqli->error());
        $employee_salary_row = $employee_salary->fetch_array();
        $current_employee_salary = $employee_salary_row['salary'];

        $employeeDeductionName = $row['deductionName'];
        $employeeDeductionAmount = $row['amount'];
        $percentage_employeeDeductionAmount = $employeeDeductionAmount/100;
        $deduction_type = $row['deductionType'];
        $deduction_limit = $row['deductionLimit'];
        if($deduction_type == 'percentage'){
          $final_employeeDeductionAmount = $percentage_employeeDeductionAmount * $current_employee_salary;
        }
        else{
          $final_employeeDeductionAmount = $employeeDeductionAmount;
        }
       if ($final_employeeDeductionAmount > $deduction_limit){
        $final_employeeDeductionAmount = $deduction_limit;
       }
       else{
        $final_employeeDeductionAmount = $final_employeeDeductionAmount;
       }
    $mysqli->query("INSERT INTO employeedeductions( employeeDeductionAmount, employeeId, edName, deductionId) VALUES ('$final_employeeDeductionAmount', '$employeeId', '$employeeDeductionName', '$employeeDeductionId')") or
    die($mysqli->error);

  header("location:".$_SERVER['HTTP_REFERER']);
}
//insert deductions
if(isset($_POST['insertDeductions'])){
  $deductionName = $_POST['deductionName'];
  $description = $_POST['description'];
  $amount = $_POST['amount'];
  $deduction_type = $_POST['deductionType'];
  $deduction_limit = $_POST['deductionLimit'];

  if ($amount >$deduction_limit){
    $amount = $deduction_limit;
  }
  else{
    $amount = $amount;
  }
  
  $mysqli->query("INSERT INTO deductions (deductionName, description, amount, deductionType, deductionLimit) VALUES ('$deductionName', '$description', '$amount', '$deduction_type', '$deduction_limit')") or
  die($mysqli->error);

  header("location:deductions.php");
}
//insert department
if(isset($_POST['insertDepartment'])){
  $departmentName = $_POST['departmentName'];
  $mysqli->query("INSERT INTO department (departmentName) VALUES ('$departmentName')") or
  die($mysqli->error);

  header("location:department.php");
}
//insert position
if(isset($_POST['insertPosition'])){
  $positionName = $_POST['positionName'];
  $mysqli->query("INSERT INTO position (positionName) VALUES ('$positionName')") or
  die($mysqli->error);

  header("location:position.php");
}
//insert allowance
if(isset($_POST['insertAllowance'])){
  $allowanceName = $_POST['allowanceName'];
  $allowanceDescription = $_POST['allowanceDescription'];
  $allowanceAmount = $_POST['allowanceAmount'];
  $mysqli->query("INSERT INTO allowance (allowanceName, allowanceDescription, allowanceAmount) VALUES ('$allowanceName', '$allowanceDescription', '$allowanceAmount')") or
  die($mysqli->error);

  header("location:allowance-list.php");
}

//save
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $position = $_POST['position'];
    $sg = $_POST['sg'];
    $step = $_POST['step'];

    $departmentName = $_POST['departmentName'];
   
    $findresults= mysqli_query($mysqli, "SELECT * FROM salaryData where salaryStep= '$step' and salaryGrade= '$sg'");
      if($res = mysqli_fetch_array($findresults))
      {
      $salaryAmount = $res['salaryAmount']; 


}

  if($sg==$salaryGrade && $step==$salaryStep){$salaryAmount=$salaryAmount;}
        
    $mysqli->query("INSERT INTO data (name, position, sg, step, departmentName, salary) VALUES ('$name', '$position', '$sg', '$step', '$departmentName', '$salaryAmount')") or
    die($mysqli->error);

$salaryAmount=0;
            
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:employees.php");
}

//delete
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:employees.php");
}

//employee allowance delete process
if (isset($_GET['employeeallowanceDelete'])){
  $eaID = $_GET['employeeallowanceDelete'];
  $mysqli->query("DELETE FROM employeeallowance WHERE eaID=$eaID") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:".$_SERVER['HTTP_REFERER']);
}
//employee deduction delete process
if (isset($_GET['employeeDeductionDelete'])){
  $edID = $_GET['employeeDeductionDelete'];
  $mysqli->query("DELETE FROM employeedeductions WHERE edID=$edID") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:".$_SERVER['HTTP_REFERER']);
}

//deduction delete process
if (isset($_GET['deductionDelete'])){
  $deductionId = $_GET['deductionDelete'];
  $mysqli->query("DELETE FROM deductions WHERE deductionId=$deductionId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:deductions.php");
}
//allowance delete process
if (isset($_GET['allowanceDelete'])){
  $allowanceId = $_GET['allowanceDelete'];
  $mysqli->query("DELETE FROM allowance WHERE allowanceId=$allowanceId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:allowance-list.php");
}
//department delete process
if (isset($_GET['departmentDelete'])){
  $departmentId = $_GET['departmentDelete'];
  $mysqli->query("DELETE FROM department WHERE departmentId=$departmentId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:department.php");
}

//position delete process
if (isset($_GET['positionDelete'])){
  $positionId = $_GET['positionDelete'];
  $mysqli->query("DELETE FROM position WHERE positionId=$positionId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:position.php");
}

//salary delete process
if (isset($_GET['salaryDelete'])){
  $id = $_GET['salaryDelete'];
  $mysqli->query("DELETE FROM salarydata WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:merged.php");
}
//edit
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    if (is_countable($result) && count($result) == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $position = $row['position'];
        $sg = $row['sg'];
        $step = $row['step'];
    
    }
   
}
//update
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name =$_POST['name'];
    $position =$_POST['position'];
    $sg =$_POST['sg'];
    $step =$_POST['step'];

    $results = $mysqli->query("SELECT salaryAmount FROM salarydata WHERE salaryStep ='step' AND salaryGrade ='sg' ") or die($mysqli->error());
  $row = $results->fetch_assoc();
  
  $salaryAmount = $row['salaryAmount'];


   $mysqli->query("UPDATE data SET salary='$salaryAmount', name='$name', position='$position', sg='$sg', step='$step' WHERE id=$id") or die($mysqli->error());

   


 $mysqli->query("UPDATE data SET salary='$salary' WHERE id=$id") or die($mysqli->error());

   $_SESSION['message'] = "Record has been updated!";
   $_SESSION['msg_type'] = "warning";

   header("location:employees.php");
}

if (isset($_POST['updateDeductions'])){
  $gsis = $_POST['gsis'];
  $hdmf =$_POST['hdmf'];
  $philhealth =$_POST['philhealth'];
  $datagsis = $_POST['gsis'];
  $datahdmf =$_POST['hdmf'];
  $dataphilhealth =$_POST['philhealth'];
  

 $mysqli->query("UPDATE data SET philhealth='$philhealth', gsis='$gsis', hdmf='$hdmf'") or die($mysqli->error());

 $mysqli->query("UPDATE deductions SET dataphilhealth='$dataphilhealth', datagsis='$datagsis', datahdmf='$datahdmf'") or die($mysqli->error());
 

 //convert string to integer
$intgsis = (int)$gsis;
$inthdmf = (int)$hdmf;
$intphilhealth = (int)$philhealth;
 $totalDeductions = $intgsis + $inthdmf + $intphilhealth;

 $mysqli->query("UPDATE data SET totalDeductions='$totalDeductions'") or die($mysqli->error());
 $_SESSION['message'] = "Record has been updated!";
 $_SESSION['msg_type'] = "warning";

 header("location:employees.php");
}





    

?>