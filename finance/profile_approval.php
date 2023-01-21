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
include "database.php";

$id=$_SESSION['id'];

//approved
if (isset($_POST['approve_user'])) 
{
    $idd = $_POST['approve_id'];

    mysqli_query($connuser, "UPDATE `user` SET `approve_reject_timestamp`=CURRENT_TIMESTAMP,`supervisor_accept_reject`='$id',`approval`='1' WHERE `id`= $idd ");
    $res=mysqli_query($connuser,"SELECT `id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `id`=$id");

    while ($row=mysqli_fetch_array($res))
    {
        $idd=$row["id"];
        $to=$row["email"];
        $fname=$row["first_name"];
        $lname=$row["last_name"];
    }
    $name= $fname. " " .$lname;
    $mailheader = "From:".$name;
    $subject="Approval";
    $message="Your Registration has been Approved. \nWelcome " .$name. "\n \n \n \nYou can now Login";
    $header= "From:crimedata <confirmation@crimedata.mydatamarker.com>\r\n";
    mail($to,$subject,$message,$header) or die("Error");
}

//reject
if (isset($_POST['reject_user']))
{
    $idd = $_POST['reject_id'];

    mysqli_query($connuser, "UPDATE `user` SET `approve_reject_timestamp`=CURRENT_TIMESTAMP,`supervisor_accept_reject`='$id',`approval`='2' WHERE `id`= $idd ");

    $res=mysqli_query($connuser,"SELECT `id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `id`=$id");

    while ($row=mysqli_fetch_array($res))
    {
        $idd=$row["id"];
        $to=$row["email"];
        $fname=$row["first_name"];
        $lname=$row["last_name"];
    }
    $name= $fname. " " .$lname;
    $mailheader = "From:".$name;
    $subject="Rejected";
    $message="Your Registration has been Rejected.";
    $header= "From:crimedata <confirmation@crimedata.mydatamarker.com>\r\n";
    mail($to,$subject,$message,$header) or die("Error");
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
                            <a class="nav-link links" href="profile_info"><i class='bx bx-wrench icon'></i> Info </a>
                            <a class="nav-link links" href="profile_password" style="margin-left: 0.5rem;"><i class='bx bx-low-vision icon'></i> Password </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 profile-body" style="right: 10%;">
            <h3 class="text-center">Approval</h3><br>
            <table class="table" style='text-align: center;'>
                <thead>
                    <tr>
                        <th class="check-left">Full Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th colspan="2" class="check-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $res=mysqli_query($connuser,"SELECT `id`, `email`, `first_name`, `last_name`, `position` FROM `user` WHERE `approval`=0");
                    while ($row=mysqli_fetch_array($res))
                    {
                        echo "<tr>";
                            echo "<td style='display:none;'>"; echo $row["id"];  echo "</td>";
                            echo "<td class='top'>"; echo '<strong>' . ucfirst($row["last_name"]); echo '</strong>, ' .ucfirst($row["first_name"]);  echo "</td>";
                            echo "<td class='top'>"; 
                            $posi= $row["position"];
                            if ($posi==0){echo " Viewer ";}
                            elseif($posi==1){echo " Editor ";}
                            else{echo " Administrator ";}
                            echo "</td>";
                            echo "<td class='top'>"; echo $row["email"];  echo "</td>";
                            echo "<td>";
                            ?>
                                <button type="button" class="btn btn-success btn-sm approvetbtn"><i class='bx bx-user-check text-white'></i> Approve</button>
                            <?php 
                            echo "</td>";
                            echo "<td>";
                            ?>
                                <button type="button" class="btn btn-danger btn-sm rejectbtn"><i class='bx bx-user-x text-white'></i> Reject</button>
                            <?php
                            echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="button" class="approval btn btn-sm btn-primary" data-toggle="modal" data-target="#approvalModal">Approval Tracker</button>
        </div>
    </div>
    <div class="modal fade modal-lg" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#ffc526;"></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="modal-body" style="padding: 2rem 4rem;">
                    <h5 class="account-header">Approval Tracker</h5>
                    <p>Student History</p>
                    <table class="table" style='text-align: center;font-size:0.9rem;'>
                        <thead>
                            <tr>
                                <th class="check-left">Result</th>
                                <th>User</th>
                                <th class="check-right">Date and Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $res=mysqli_query($connuser,"SELECT `approval`,CONCAT(`last_name`,', ',`first_name`) AS username,`approve_reject_timestamp` AS timeframe FROM user WHERE approval != 0 ORDER BY approve_reject_timestamp DESC;");
                            while ($row=mysqli_fetch_array($res))
                            {
                                echo "<tr>";
                                    echo "<td class='top'>";
                                        if ($row["approval"]==2){
                                            echo "<p class='text-danger'>Rejected</p>";
                                        }else{
                                            echo "<p class='text-success'>Approved</p>";
                                        }
                                    echo "</td>";
                                    echo "<td class='top'>"; echo $row["username"];  echo "</td>";
                                    echo "<td class='top'>"; echo $row["timeframe"];  echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" style="padding: 3px;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Approve POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="approvetmodal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success"></div>
                <form action="profile_approval.php" method="POST">

                    <div class="modal-body">
                        <h5 class="text-success">Approve User</h5>
                        <input type="hidden" name="approve_id" id="approve_id">
                        <p style="margin-bottom: 0;">You will give access to <input type="text" name="approve_name" id="approve_name" style="border: 0 solid;" readonly></p>
                        <p>You cannot change once you approved.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="approve_user" class="btn btn-success btn-sm"><i class='bx bx-message-square-check text-white' style="margin-right: 0.3rem;"></i>Approve</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Reject POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="rejectmodal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger"></div>
                <form action="profile_approval.php" method="POST">

                    <div class="modal-body">
                        <h5 class="text-danger">Reject User</h5>
                        <input type="hidden" name="reject_id" id="reject_id">
                        <p style="margin-bottom: 0;">You will NOT give access to <input type="text" name="reject_name" id="reject_name" style="border: 0 solid;" readonly></p>
                        <p>You cannot change once you Reject.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="reject_user" class="btn btn-danger btn-sm"><i class='bx bx-message-square-x text-white' style="margin-right: 0.3rem;"></i>Reject</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            $('.rejectbtn').on('click', function () {

                $('#rejectmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#reject_id').val(data[0]);
                $('#reject_name').val(data[1]);

            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.approvetbtn').on('click', function () {

                $('#approvetmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#approve_id').val(data[0]);
                $('#approve_name').val(data[1]);

            });
        });
    </script>
</body>
</html>