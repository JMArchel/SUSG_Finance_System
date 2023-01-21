<?php
//set database
$school=$_SESSION['school_year'];
$database_year = 'susg_' . $school;

//connection to the database
$conn = mysqli_connect('localhost','root','', $database_year) or die('connection failed');
$connuser = mysqli_connect('localhost','root','', 'susg_user') or die('connection failed');
?>