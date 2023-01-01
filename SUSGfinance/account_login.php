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

$email = $password = "";
$email_err = $password_err = $login_err = "";

//login
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if user id is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your ID.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    }elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters."; 
    }else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT `id`,`first_name`, `last_name`, `email`, `password`,`position` FROM `user` WHERE `email`= ? AND approval=1";
        
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
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $first_name, $last_name, $email, $hashed_password,$position );
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["last_name"] = $last_name;
                            $_SESSION["email"] = $email;
                            $_SESSION["position"] = $position;
                            $f = substr($first_name, 0, 1);
                            $l = substr($last_name, 0, 1);
                            $_SESSION["profile"] = $f . $l;
                        
                            // Redirect user to welcome page
                            header("location: general_information");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid Password";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid Email.";
                }
            } else{
                $login_err = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        else{
            echo "error occured";
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
                        <h5 class="account-header">Login</h5>
                        <p>Login with your email and password.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="padding-left: 1rem; padding-right: 1rem;"> 
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter your email">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>    
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Enter password">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <a class="link" href="account_forgot_password">Forgot password?</a>
                            <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                            <div class="form-group below">
                                <input type="submit" class="form-control btn btn-primary" value="submit" style="inline-size: 10rem;">
                            </div>
                            <p>Don't have an account? <a class="link" href="account_register">Register now</a>.</p>
                            <?php 
                            if(!empty($login_err)){
                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                            }        
                            ?>
                        </form>
                    </div>
            </div>
        </div>
	</div>
</body>
</html>