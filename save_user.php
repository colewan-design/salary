<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$salaryGrade = $_POST['salaryGrade'];
		$salaryStep = $_POST['salaryStep'];
		$salaryAmount = $_POST['salaryAmount'];
		
		mysqli_query($conn, "INSERT INTO salarydata (salaryGrade, salaryAmount, salaryStep)  VALUES('$salaryGrade', '$salaryStep', '$salaryAmount')") or die(mysqli_error());
		
	
		header("location: merged.php");
	}
?>