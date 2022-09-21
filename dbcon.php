
<?php
$conn = new mysqli('localhost','root','','crud');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>