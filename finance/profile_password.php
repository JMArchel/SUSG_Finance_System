<?php
// Check if the user is logged in, if not then redirect him to login page
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login");
    exit;
}
$id=$_SESSION['id'];
$first_name=ucfirst($_SESSION['first_name']);
$last_name=ucfirst($_SESSION['last_name']);
$email=$_SESSION['email'];
$position=$_SESSION['position'];
$school = $_SESSION['position'];
include("database.php");

if (!empty($_GET['idkey'])) {
	$success=$_GET['idkey'];
}

$oldpassword = $password = $confirm_password = "";
$oldpassword_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate password
    if(empty(trim($_POST["old_password"]))){
        $oldpassword_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["old_password"])) < 8){
        $oldpassword_err = "Password must have atleast 8 characters.";
    } else{
        $oldpassword = trim($_POST["old_password"]);
    }
  
    if(empty(trim($_POST["new_password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["new_password"]);
    }
  
    // Validate confirm password
    if(empty(trim($_POST["confirm_new_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_new_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
  
    if(empty($oldpassword_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "SELECT `password` FROM `user` WHERE `id`= ? ";
            if($stmt = mysqli_prepare($connuser, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_id);
                
                // Set parameters
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result 
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($oldpassword, $hashed_password)){
                                // Password is correct, so start a new session
  
                                $sql1 = "UPDATE `user` SET `password`= ? ,`update_timestamp`= CURRENT_TIMESTAMP WHERE `id`= $id ";
  
                                if($stmt = mysqli_prepare($connuser, $sql1)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "s", $param_password);
  
                                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
  
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                    
                                        $sql2 = "SELECT `id`,`first_name`, `last_name`, `email`, `password`,`position` FROM `user` WHERE `id`= ?";
                            
                                        if($stmt = mysqli_prepare($connuser, $sql2)){
                                            // Bind variables to the prepared statement as parameters
                                            mysqli_stmt_bind_param($stmt, "s", $param_id);
                                                                    
                                            // Set parameters
                                            $param_id = $id;
                                                                    
                                            // Attempt to execute the prepared statement
                                            if(mysqli_stmt_execute($stmt)){
                                                // Store result 
                                                mysqli_stmt_store_result($stmt);
                                                                        
                                                // Check if username exists, if yes then verify password
                                                if(mysqli_stmt_num_rows($stmt) == 1){                    
                                                    // Bind result variables
                                                    mysqli_stmt_bind_result($stmt, $id, $first_name, $last_name, $email, $hashed_password,$position);
                                                    if(mysqli_stmt_fetch($stmt)){
                                                    
                                                        // Redirect user to welcome page
                                                        header("location: profile_password?idkey=success");
                                                    }
                                                } else{
                                                    echo "Oops! Something went wrong. Please try again later.";
                                                }
                                            }
                                        } else{
                                            // Password is not valid, display a generic error message
                                            $login_err = "Invalid input or Check for validation.";
                                        }
                                    }
                                } else{
                                    // Username doesn't exist, display a generic error message
                                    $login_err = "Invalid input or Check for validation.";
                                }
                            } else{
                                $login_err = "Invalid Old Password.";
                            }
                        }
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }
            }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>User Profile</title>
</head>
<?php include("sidebar.php"); ?>
<body class="body-top">
    <div class="row">
        <div class="col-3 profile-body" style="left: 14%;">
            <div class="card shadow design" style="padding-top:3rem;padding-bottom:3rem;">
                <center>
                    <header class="profile-initial"><?php echo ucwords(htmlspecialchars($_SESSION["profile"])); ?></header>
                </center>
                <div style="padding-top:2rem;">
                    <p class="profile-lastname"><?php echo ucwords(htmlspecialchars($_SESSION["last_name"])), ", <br> <p class='profile-firstname'>", ucwords(htmlspecialchars($_SESSION["first_name"])); ?></p>
                    <center>
						<header class="position d-inline p-2">
                        <?php 
                        $posi= ucwords(htmlspecialchars($_SESSION["position"]));
                        if ($posi==0){echo " Viewer ";}
                        elseif($posi==1){echo " Editor ";}
                        else{echo " Administrator ";}
                        ?>
						</header>
					</center>
                    <div class="d-flex justify-content-center" style="padding-bottom: 1.5rem;">
                        <nav class="nav">
                            <a class="nav-link links" href="profile_info" style="margin-right: 0.5rem;"><i class='bx bx-wrench icon'></i> Info </a>
							<?php 
							if ($posi==1 or $posi==2){
								?><a class="nav-link links" href="profile_approval"><i class='bx bx-checkbox-checked icon'></i> Approval </a>
							<?php }
							?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-6 profile-body" style="right: 10%;">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-container">
						<h4 class="account-header">Change Password</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
						<div class="row mb-3">
                                <div class="col-sm-4">
                                <h6 class="mb-0">New Password</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Enter New Password" name="new_password" value="<?php echo $password; ?>"/>
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                <h6 class="mb-0">Confirm New Password</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                <input class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Enter Confirm New Password" name="confirm_new_password" value="<?php echo $confirm_password; ?>"/>
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                </div>
                            </div><br><br>
                            <div class="row mb-3">
                                <p>To confirm your changes, please input your old password</p>
                                <div class="col-sm-4">
                                <h6 class="mb-0">Old Password</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                <input class="form-control <?php echo (!empty($oldpassword_err)) ? 'is-invalid' : ''; ?>" type="password" placeholder="Old Password" name="old_password" value="<?php echo $oldpassword; ?>"/>
                                <span class="invalid-feedback"><?php echo $oldpassword_err; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                <input class="btn btn-primary" type="submit" value="Change Password" name="submit">
                                </div>
                            </div>
                        </form>
					</div>
                </div>
            </div>
        </div>
    </div>
<?php
	if(!empty($success)){echo '<div class="alert alert-success text-center position-absolute" style="width:100%; border-radius:0px;">' ?> <i class='bx bx-check-circle text-success'></i> <?php echo 'Successful' . '</div>';} ?> 
</body></html>