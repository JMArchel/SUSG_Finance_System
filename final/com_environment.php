<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login");
    exit;
}

include "database.php";

//firstexpense
$firstsemexpenses=mysqli_query($conn,"SELECT SUM(`amount`) AS total_amount FROM committee_fund WHERE comm_fund='environment' AND 1=SUBSTRING(`internal_number`,LOCATE('-',`internal_number`)+1,1);");
$firstsemexpenses = mysqli_fetch_array($firstsemexpenses);
$firstsemexpenses = $firstsemexpenses['total_amount'];

//secondexpense
$secondsemexpenses=mysqli_query($conn,"SELECT SUM(`amount`) AS total_amount FROM committee_fund WHERE comm_fund='environment' AND 2=SUBSTRING(`internal_number`,LOCATE('-',`internal_number`)+1,1);");
$secondsemexpenses = mysqli_fetch_array($secondsemexpenses);
$secondsemexpenses = $secondsemexpenses['total_amount'];

//totalexpense
$totalexpenses = $firstsemexpenses + $secondsemexpenses;

$position= ($_SESSION["position"]);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/fund_comm.css">
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>Environment Committee</title>
</head>
<?php include("sidebar.php"); ?>
<body class="body-top">
<h5 class="title-name fixed-top">Environment Committee</h5>
    <div class="row d-flex justify-content-center">
        <div class="col-4">
            <div class="card" style="margin-bottom:2rem; height:9rem;">
                <div class="card-body">
                    <table class="table table-borderless table-hover">
                        <tr>
                            <td class="left" style="width:70%; padding-left: 2rem;">1st Semester</td>
                            <td>₱</td>
                            <td class="right value"><?php echo number_format($firstsemexpenses,2,'.',','); ?></td>
                        </tr>
                        <tr>
                            <td class="left" style="width:70%; padding-left: 2rem;">2nd Semester</td>
                            <td>₱</td>
                            <td class="right value"><?php echo number_format($secondsemexpenses,2,'.',','); ?></td>
                        </tr>
                        <tr>
                            <th class="left" style="width:70%; padding-left: 2rem;">TOTAL EXPENSE</th>
                            <td>₱</td>
                            <td class="right value"><strong><?php echo number_format($totalexpenses,2,'.',','); ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th class="hleft">Internal Number</th>
                            <th>Description</th>
                            <th class="text-center <?php if ($position == 0) {
                                echo 'hright';
                            }?>">Amount</th>
                            <?php if ($position !=0) { ?>
                            <th class="text-center hright">Action</th><?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $environment=mysqli_query($conn,"SELECT `id`,`internal_number`,`description`,`amount` FROM committee_fund WHERE comm_fund='environment';");
                            while ($row=mysqli_fetch_array($environment))
                            {
                                echo "<tr>";
                                    echo "<td style='width:150px;'>"; echo $row["internal_number"];  echo "</td>";
                                    echo "<td>"; echo $row["description"];  echo "</td>";
                                    echo "<td class='text-center' style='width:150px;'>";
                                        if ($row["amount"]!=null){echo number_format($row["amount"],2,'.',',');}
                                    echo "</td>";
                                    if ($position != 0) {
                                    echo "<td style='width:138px;'>";
                                        ?>
                                            <button type="button" class="btn btn-primary btn-sm" style="font-size: 10px; margin-right: 4px;"><i class='bx bx-message-square-edit icons'></i> Edit</button></a>
                                            <button type="button" class="btn btn-danger btn-sm" style="font-size: 10px;"><i class='bx bx-message-square-x icons'></i>Delete</button></a>
                                        <?php
                                    echo "</td>";
                                    }
                                echo "</tr>";
                            }
                            if ($position != 0) {?>
                            <tr>
                                <td colspan="5" style="padding: 0px;"><button type="button" class="btn btn-success btn" style="font-size: 10px; width:100%;"><i class='bx bx-message-square-add icons' style="margin-right:3px;"></i>Add</button></td>
                            </tr> <?php 
                        }?>
                    </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>