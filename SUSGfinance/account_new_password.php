<?php
session_start();

$connection = mysqli_connect('localhost','root','', 'susg_user') or die('connection failed');
$school_year=mysqli_query($connection,"SELECT CONCAT(`year_1`,'-',`year_2`) AS latest_year FROM `database_year` ORDER BY `year_1` DESC LIMIT 1;");
$school_year = mysqli_fetch_array($school_year);
$_SESSION["school_year"] = $school_year['latest_year'];

include "database.php";

$email = $_SESSION['email'];
if($email == false){
    header('Location: account_login');
}elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: general_information");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $_SESSION['info'] = "";
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) > 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($password_err) && empty($confirm_password_err)){
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE `user` SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($connuser, $update_pass);
        if($run_query){
            $info = "Password Changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: login');
        }else{
            $password_err = "Failed to change your password!";
        }
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
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>LogIn</title>
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
                    <h5 class="account-header">New Password</h5>
                    <p>Create a new password</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="padding-left: 1rem; padding-right: 1rem;"> 
                    <center>
                        <?php if(!empty($_SESSION['info'])){ ?>
                        <div class="alert alert-info"> <?php echo $_SESSION['info']; ?></div>
                        <?php } ?>
                    </center>    
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter new password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm your password">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                    <div class="form-group">
                        <input type="submit" class=" form-control btn btn-primary" value="submit" style="inline-size: 10rem;">
                    </div>
                        </form>
                    </div>
            </div>
        </div>
	</div>
</body>
</html>