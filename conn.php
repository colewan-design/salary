<?php
	$conn = mysqli_connect("localhost", "root", "", "crud");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>