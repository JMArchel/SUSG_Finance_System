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

$first_name = $last_name = $email = $position = $password = $confirm_password ="";
$first_name_err = $last_name_err = $email_err = $position_err = $password_err = $confirm_password_err ="";
$check = "";

$email = $password = "";
$email_err = $password_err = $login_err = "";
//register
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $select = mysqli_query($connuser, "SELECT `first_name`,`last_name`,`email` FROM `user` WHERE `first_name`='$first_name' AND `last_name`='$last_name' AND `email`='$email';") or die('query failed');
    $name_check = mysqli_query($connuser, "SELECT `first_name`,`last_name` FROM `user` WHERE `first_name`='$first_name' AND `last_name`='$last_name';") or die('query failed');
    $email_check= mysqli_query($connuser, "SELECT `email` FROM `user` WHERE `email`='$email';") or die('query failed');
    
    if(empty($_POST["first_name"])){
        $first_name_err = "Please enter your firstname.";
    }elseif(mysqli_num_rows($select) > 0){
        $first_name_err = 'User already exist.';
    }elseif(mysqli_num_rows($name_check) > 0){
        $last_name_err = 'User already exist.';
    }else{
        $first_name = $_POST['first_name'];
    }

    if(empty($_POST["last_name"])){
        $last_name_err = "Please enter your lastname.";
    }elseif(mysqli_num_rows($select) > 0){
        $last_name_err = 'User already exist.';
    }elseif(mysqli_num_rows($name_check) > 0){
        $last_name_err = 'User already exist.';
    }else{
        $last_name = $_POST['last_name'];
    }

    if(empty($_POST["email"])){
        $email_err = "Please enter your email.";
    }elseif(mysqli_num_rows($select) > 0){
        $email_err = 'Email already exist.';
    }elseif(mysqli_num_rows($email_check) > 0){
        $email_err = 'Email already exist.';
    }else{
        $email = $_POST['email'];
    }

    if(empty($_POST["position"])){
        $position_err = "Enter position.";
    }else{
        $position = $_POST['position'];
    }

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

    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($position_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (email, password, first_name, last_name, position) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($connuser, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_password, $param_first_name, $param_last_name, $param_position);
            
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_position = $position;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: account_waiting");
            } else{

                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
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
    <title>Register</title>
</head>
<body class="account-back">
	<div class="container">
        <div class="row account-body">
            <div class="col-7" style="padding-right: 2rem;">
                <h1 class="text-center title">SUSG Finance System</h1>
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
                <div>
                    <div class="form-container">
                        <h5 class="account-header">Register</h5>
                        <p>Please fill this form to create an account.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="padding-left: 1rem; padding-right: 1rem;"> 
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Firstname</label>
                                    <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>" placeholder="Enter firstname">
                                    <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
                                </div>    
                                <div class="form-group col-md-6">
                                    <label>Lastname</label>
                                    <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>" placeholder="Enter lastname">
                                    <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
                                </div>
                                <div class="form-group col-10">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter email address">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                </div>
                                <div class="col-5">
                                    <label>Role</label>
                                    <select name="position" class="form-group form-control form-select <?php echo (!empty($position_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $position; ?>">
                                        <option selected disabled value=" ">Choose Position <i class='bx bxs-group'></i> </option>
                                        <option value=1>Editor</option>
                                        <option value=0>Viewer</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a role.
                                    </div>
                                </div>
                                <div class="col-2" style="color: #fceded;">-</div>
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Enter password">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" placeholder="Confirm password">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                </div>
                            </div>
                            <div><?php echo "&nbsp&nbsp&nbsp" ?></div>
                            <div class="form-group below">
                                <input type="submit" class="form-control btn btn-primary" value="submit" style="inline-size: 10rem;">
                            </div>
                            <p class="below1">Already have an account? <a class="link" href="account_login">Login here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>