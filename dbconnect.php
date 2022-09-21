<?php
// connection settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'crud';

//connect to mysql database
$con = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($con));
?>