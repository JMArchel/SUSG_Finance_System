<?php
session_start();

$connection = mysqli_connect('localhost','root','', 'susg_user') or die('connection failed');
$school_year=mysqli_query($connection,"SELECT CONCAT(`year_1`,'-',`year_2`) AS latest_year FROM `database_year` ORDER BY `year_1` DESC LIMIT 1;");
$school_year = mysqli_fetch_array($school_year);
$_SESSION["school_year"] = $school_year['latest_year'];

include "database.php";

$email= $_SESSION['email'];
if($email == false){
    header('Location: account_login');
}elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: general_information");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION['info'] = "";
    $otp_number = $_POST["otp1"].$_POST["otp2"].$_POST["otp3"].$_POST["otp4"];
    $otp_code = mysqli_real_escape_string($connuser, $otp_number);
    $check_code = "SELECT * FROM `user` WHERE code = $otp_code";
    $code_res = mysqli_query($connuser, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: account_new_password');
        exit();
    }else{
        $code_err = "You've entered an incorrect code!";
    }
}


?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/account_reset_code.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>Forgot Password</title>
</head>
<body class="account-back">
	<div class="container">
        <div class="row account-body">
            <div class="col-7" style="padding-right: 2rem;">
                <h1 class="title">SUSG Finance System</h1>
                <p class="description">Welcome to the SUSG Finance System! This will help track and manage the financial activities of events from different committees with ease with our web-based platform, providing real-time visibility easy access.</p>
                <div class="row">
                    <div class="col-5" style="align-items: center;padding-left:2rem">
                        <img src="images/susg-logo.svg" class="float-right" style="height:4rem; margin-right:1rem;">
                        <img src="images/susg-finance.svg" class="float-right" style="height:4rem; margin-right:1rem;">
                        <p style="padding-top: 1rem;"> In partnership with </p>
                        <img src="images/bass.svg" class="float-right" style="height:4rem; margin-right:1rem;">
                    </div>
                </div>
            </div>
            <div class="col-5 account-info">
                <div class="form-container">
                    <h5 class="account-header">Code Verification</h5>
                    <center>
                        <header class="shield-icon">
                            <i class="bx bxs-check-shield" style="color: white;"></i>
                        </header>
                        <p>Enter the OTP Code</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="padding-left: 1rem; padding-right: 1rem;"> 
                            <div class="input-field">
                                <input type="number" name="otp1" />
                                <input type="number" name="otp2" disabled />
                                <input type="number" name="otp3" disabled />
                                <input type="number" name="otp4" disabled />
                                <span class="invalid-feedback"><?php echo $code_err; ?></span>
                            </div>
                            <button type="submit">Verify OTP</button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
	</div>
    <script src="js/account_reset_code.js" defer></script>
</body>
</html>