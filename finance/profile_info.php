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

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$update_first_name_err = $update_last_name_err = $update_email_err = "";

	// Check if first name is empty
    if(empty(trim($_POST["update_first_name"]))){
        $update_first_name_err = "Please enter your firstname.";
    } else{
        $update_first_name = trim($_POST["update_first_name"]);
    }

	//check if last name is empty
	if(empty(trim($_POST["update_last_name"]))){
        $update_last_name_err = "Please enter your lastname.";
    } else{
        $update_last_name = trim($_POST["update_last_name"]);
    }

	// check if email is empty
	if(empty(trim($_POST["update_email"]))){
        $update_email_err = "Please enter your email.";
    } else{
        $update_email = trim($_POST["update_email"]);
    }

	// Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password to confirm changes.";
    } else{
        $password = trim($_POST["password"]);
    }

	if(empty($update_first_name_err) && empty($update_last_name_err) && empty($update_email_err) && empty($password_err)){
        
		$sql = "SELECT `id`, `password` FROM `user` WHERE `id`= ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $hashed_password);
                    
					if(mysqli_stmt_fetch($stmt)){
                        
						if(password_verify($password, $hashed_password)){

							$check_id = $id;
							$sql1 = "UPDATE `user` SET `email`= '$update_email' ,`first_name`= '$update_first_name' ,`last_name`= '$update_last_name', `update_timestamp`= CURRENT_TIMESTAMP WHERE `id`= $check_id ";
							
							if(mysqli_query($connuser, $sql1)){
								
								$sql = "SELECT `id`,`first_name`, `last_name`, `email`, `password`,`position` FROM `user` WHERE `id`= ?";
        
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
											mysqli_stmt_bind_result($stmt, $id, $first_name, $last_name, $email, $hashed_password,$position);
											if(mysqli_stmt_fetch($stmt)){

												session_start();
													
												// Store data in session variables
												$_SESSION["first_name"] = $first_name;
												$_SESSION["last_name"] = $last_name;
												$_SESSION["email"] = $email;
                                                $f = substr($first_name, 0, 1);
                                                $l = substr($last_name, 0, 1);
                                                $_SESSION["profile"] = $f . $l; 
													
												// Redirect user to welcome page
												header("location: profile_info?idkey=success");
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
									echo "Oops! Something went wrong. Please try again later.";
								}

									// Close statement
									mysqli_stmt_close($stmt);
							}
						} else {
							$password_err="Invalid Password";
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
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
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
                            <a class="nav-link links" href="profile_password" style="margin-right: 0.5rem;"><i class='bx bx-low-vision icon'></i> Password </a>
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
						<h4 class="account-header">Change Info</h4>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="row mb-3">
									<div class="col-sm-4">
										<h6 class="mb-0">First Name</h6>
									</div>
									<div class="col-sm-8 text-secondary">
										<input type="text" class="form-control <?php echo (!empty($update_first_name_err)) ? 'is-invalid' : ''; ?>" name="update_first_name" value="<?php echo $first_name; ?>">
										<span class="invalid-feedback"><?php echo $update_first_name_err; ?></span>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-4">
										<h6 class="mb-0">Last Name</h6>
									</div>
									<div class="col-sm-8 text-secondary">
										<input type="text" class="form-control <?php echo (!empty($update_last_name_err)) ? 'is-invalid' : ''; ?>" name="update_last_name" value="<?php echo $last_name; ?>">
										<span class="invalid-feedback"><?php echo $update_last_name_err; ?></span>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-4">
										<h6 class="mb-0">Email</h6>
									</div>
									<div class="col-sm-8 text-secondary">
										<input type="email" class="form-control <?php echo (!empty($update_email_err)) ? 'is-invalid' : ''; ?>" name="update_email" value="<?php echo $email; ?>">
										<span class="invalid-feedback"><?php echo $update_email_err; ?></span>
									</div>
								</div><br><br>
								<div class="row mb-3">
									<p>To confirm your changes, please input your password</p>
									<div class="col-sm-4">
										<h6 class="mb-0">Password</h6>
									</div>
									<div class="col-sm-8 text-secondary">
										<input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" placeholder="Enter password">
										<span class="invalid-feedback"><?php echo $password_err; ?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input class="btn btn-primary" type="submit" value="Update Info">
									</div>	
								</div>
								<div class="row">
								<?php 
								if(!empty($login_err)){
									echo '<div class="alert alert-danger">' . $login_err . '</div>' ;
								}        
								?>
								</div>
							</form>
						</div>
                </div>
            </div>
        </div>
    </div>
<?php if(!empty($success)){echo '<div class="alert alert-success text-center position-absolute" style="width:100%; border-radius:0px;">' ?> <i class='bx bx-check-circle text-success'></i> <?php echo 'Successful' . '</div>';} ?> 
</body>
</html>