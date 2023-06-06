<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: general_information");
    exit;
}

$connection = mysqli_connect('localhost','root','', 'susg_user') or die('connection failed');
$school_year=mysqli_query($connection,"SELECT CONCAT(`year_1`,'-',`year_2`) AS latest_year FROM `database_year` ORDER BY `year_1` DESC LIMIT 1;");
$school_year = mysqli_fetch_array($school_year);
$_SESSION["school_year"] = $school_year['latest_year'];

include "database.php";

$email = $email_err ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email=$_POST["email"];
    
    if(empty($_POST["email"])){
        $email_err = "Please enter your email.";
    }
    else{

        $sql = "SELECT `email` FROM `user` WHERE `email`= ? AND approval=1";
        
        if($stmt = mysqli_prepare($connuser, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result 
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $code = rand(9999, 1111);
                    $insert_code = "UPDATE `user` SET code = $code WHERE email = '$email'";
                    $run_query =  mysqli_query($connuser, $insert_code);
                    if($run_query){
                        $subject = "Password Reset Code";
                        $message = "Your password reset code is $code";
                        $header= "From:crimedata <codeverification@crimedata.mydatamarker.com>\r\n";
                        if( mail($email,$subject,$message,$header)){
                            session_start();
                            $info = "We've sent a passwrod reset otp to your email - $email";
                            $_SESSION['info'] = $info;
                            $_SESSION['email'] = $email;
                            header("location: account_reset_code");
                            exit();
                        }else{
                            $email_err = "Failed while sending code!";
                        }
                    }else{
                        $email_err = "Something went wrong!";
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $email_err = "Email doesn't exist";
                }
            } else{
                $email_err = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

    }
    // Close connection
    mysqli_close($connuser);
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
                        <h5 class="account-header">Forgot Password</h5>
                        <p>We need to check your email.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="padding-left: 1rem; padding-right: 1rem;"> 
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter your email">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>    
                            <a class="link" href="account_login">Password Remembered?</a>
                            <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                            <div class="form-group below">
                                <input type="submit" class="form-control btn btn-primary" value="submit" style="inline-size: 10rem;">
                            </div>
                            <p>Don't have an account? <a class="link" href="account_register">Register now</a>.</p>
                        </form>
                    </div>
            </div>
        </div>
	</div>
</body>
</html>