<?php
session_start();
$dbHost = 'localhost';
$dbName = 'JulyData';
$dbUsername = 'root';
$dbPassword = '';
$dbc= mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName); 
?>