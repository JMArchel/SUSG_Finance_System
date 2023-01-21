<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login");
    exit;
}

include "database.php";
$id=$_GET["id"];
//lastadministration
$lastadmin=mysqli_query($conn,"SELECT `last_fund` FROM `fund_last_administration`;");
$lastadmin = mysqli_fetch_array($lastadmin);
$lastadmin = $lastadmin['last_fund'];

//adjustment
$adjustment=mysqli_query($conn,"SELECT ((SUM(`credit`))-(SUM(`debit`))) AS adjustments FROM fund_initial_susg;");
$adjustment = mysqli_fetch_array($adjustment);
$adjustment = $adjustment['adjustments'];

//initial_fund & fund_last_administration
$totalinitialfunds = $lastadmin + $adjustment;

//latest date
$latestdate=mysqli_query($conn,"SELECT  DATE_FORMAT(`date`,'%M %e, %Y') AS date_mey FROM fund_initial_susg ORDER BY `date` DESC LIMIT 1;");
$latestdate= mysqli_fetch_array($latestdate);

$description = "";
$position= ($_SESSION["position"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idd = $_POST['id'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $debit_credit = $_POST['debit_credit'];
    $value = $_POST['value'];
    
    if ($debit_credit == "credit") {
        $sql = "UPDATE `fund_initial_susg` SET `date`='$date',`description`='$description',`credit`=$value,`debit`=null WHERE `id`=$idd;";
    } else{
        $sql = "UPDATE `fund_initial_susg` SET `date`='$date',`description`='$description',`credit`=null,`debit`=$value WHERE `id`=$idd;";
    }
    
    echo $sql;
    if(mysqli_query($conn,$sql))
    {
        header("location: fund_initial_susg");
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/fund_comm.css">
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>Initial SUSG Funds</title>
</head>
<?php include("sidebar.php"); ?>
<body class="body-top">
<h5 class="title-name fixed-top">Initial SUSG Fund - Edit</h5>
    <div class="row d-flex justify-content-center">
        <div class="col-4">
            <div class="card" style="margin-bottom:2rem; height:9rem;">
                <div class="card-body">
                    <table class="table table-borderless table-hover">
                        <tr>
                                <td class="left">From Last Administration</td>
                                <td>₱</td>
                                <td class="right value"><?php echo number_format($lastadmin,2,'.',','); ?></td>
                            </tr>
                        <tr>
                                <td class="left">From Enrollees as of <?php echo $latestdate['date_mey']; ?></td>
                                <td>₱</td>
                                <td class="right value"><?php echo number_format($adjustment,2,'.',','); ?></td>
                            </tr>
                        <tr>
                                <th class="left">TOTAL INITIAL FUNDS</th>
                                <td>₱</td>
                                <td class="right value"><strong><?php echo number_format($totalinitialfunds,2,'.',','); ?></strong></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-5">
            <p class="text-left subheading">Adjustments for the School Year's Enrollees</p>
            <div class="edit-header bg-primary text-primary">-</div>
            <div class="edit-body">
                <?php 
                    $initialsusgfund=mysqli_query($conn,"SELECT `id`,`date`,`description`,`debit`,`credit`,CONCAT(COALESCE(`debit`,''),COALESCE(`credit`,'')) AS debit_credit FROM `fund_initial_susg` WHERE `id`=$id;");
                    while ($row=mysqli_fetch_array($initialsusgfund))
                    { ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-container">
                        <h5>SUSG Funds</h5>
                        <p>Edit Entry for Adjustments</p> 
                        <div class="form-group">
                            <input type="number" name="id" class="form-control" value="<?php echo $row['id'];?>" required hidden>
                        </div>
                        <div class="row">
                        <div class="form-group col-4">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $row['date'];?>" required>
                        </div>    
                        <div class="form-group col-8">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="1"><?php echo $row['description'];?></textarea>
                        </div>
                        </div>
                        <label style="padding-top:1rem;">Choose & Provide Value</label>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="debit_credit" id="inlineRadio1" value="debit" <?php if($row['debit']!=null) {echo "checked";}?> required>
                                <label class="form-check-label" for="inlineRadio1" style="padding-top:0px;">Debit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="debit_credit" id="inlineRadio2" value="credit" <?php if($row['credit']!=null) {echo "checked";}?> required>
                                <label class="form-check-label" for="inlineRadio2" style="padding-top:0px;">Credit</label>
                            </div>
                        </div>
                        <div class="form-group input-group" style="padding-bottom: 1rem;">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="number" name="value" class="form-control" min="0.00" step="0.01" value="<?php echo $row['debit_credit'];?>" required>
                        </div>
                        <div>
                            <a href="fund_initial_susg" type="button" class="btn btn-secondary btn-sm" >Close</a>
                            <button type="submit" class="btn btn-primary btn-sm" value="submit"><i class='bx bx-message-square-edit icons_1' style="margin-right: 0.3rem;"></i>Edit</button>
                        </div>
                    </div>
                </form>
                    <?php }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
