<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home");
    exit;
}

$connection = mysqli_connect('localhost','root','', 'susg_user') or die('connection failed');
$school_year=mysqli_query($connection,"SELECT CONCAT(`year_1`,'-',`year_2`) AS latest_year FROM `database_year` ORDER BY `year_1` DESC LIMIT 1;");
$school_year = mysqli_fetch_array($school_year);
$_SESSION["school_year"] = $school_year['latest_year'];

include "database.php";
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>Waiting</title>
</head>
<body class="account-back">
	<div class="container">
        <div class="account-body" style="width: 40rem; height: 25rem;">
            <h1 class="title" style="margin-bottom:0rem;padding-bottom: 0px;padding-top:1.5rem;">Thank you</h1>
            <h5 class="text-center" style="color: white;">for registering!</h5>
            <p class="description">We have received your registration and will review it shortly. Please allow up to 24 hours for us to process your registration. Once approved, you will receive an email confirmation. Thank you for your patience.</p>
            <center><a href="account_login" class="btn btn-primary" style=" width: 10rem;">Back</a></center>
        </div>
	</div>
</body>
</html>