<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login");
    exit;
}
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sy = $_POST['schoolyear'];
    if($sy=="latest"){
        header("location: general_information");
    }
    else{
        $connection = mysqli_connect('localhost','root','', 'susg_user') or die('connection failed');
        $school_year=mysqli_query($connection,"SELECT CONCAT(`year_1`,'-',`year_2`) AS choosenyear FROM `database_year` WHERE `year_1`= $sy;");
        $school_year = mysqli_fetch_array($school_year);
        $_SESSION['school_year'] = $school_year['choosenyear'];
        header("location: general_information");
    }
    mysqli_close($conn);
}


//session for database
$selected_sy = $_SESSION['school_year'];

//reference for pettycash,cash advance-expense, reimbursements and requisitions
function amount($a, $b)
{
    return "SELECT SUM(amount) AS amounts
    FROM (
        SELECT internal_number,description,amount FROM com_advocacy UNION
        SELECT internal_number,description,amount FROM com_cheering UNION
        SELECT internal_number,description,amount FROM com_comso UNION
        SELECT internal_number,description,amount FROM com_dorm_life UNION
        SELECT internal_number,description,amount FROM com_educational_services UNION
        SELECT internal_number,description,amount FROM com_environmental UNION
        SELECT internal_number,description,amount FROM com_finance UNION
        SELECT internal_number,description,amount FROM com_health UNION
        SELECT internal_number,description,amount FROM com_hert UNION
        SELECT internal_number,description,amount FROM com_high_school_affairs UNION
        SELECT internal_number,description,amount FROM com_infomedia UNION
        SELECT internal_number,description,amount FROM com_marketing UNION
        SELECT internal_number,description,amount FROM com_miss_silliman UNION
        SELECT internal_number,description,amount FROM com_research UNION
        SELECT internal_number,description,amount FROM com_resolutions UNION
        SELECT internal_number,description,amount FROM com_secretariat UNION
        SELECT internal_number,description,amount FROM com_social_services UNION
        SELECT internal_number,description,amount FROM com_socio_cultural UNION
        SELECT internal_number,description,amount FROM com_special_projects UNION
        SELECT internal_number,description,amount FROM com_spiritual_life UNION
        SELECT internal_number,description,amount FROM com_sports UNION
        SELECT internal_number,description,amount FROM com_straw UNION
        SELECT internal_number,description,amount FROM fund_assembly_general UNION
        SELECT internal_number,description,amount FROM fund_assembly_sponsorship UNION
        SELECT internal_number,description,amount FROM fund_comelec UNION
        SELECT internal_number,description,amount FROM fund_gender_inclusivity UNION
        SELECT internal_number,description,amount FROM fund_president_discretionary UNION
        SELECT internal_number,description,amount FROM fund_vice_president_discretionary
    ) AS TotalAmount WHERE '$a'=LEFT(internal_number,$b);";
}

function unli()
{
    return "SELECT internal_number
    FROM (
        SELECT internal_number,description,amount FROM com_advocacy UNION
        SELECT internal_number,description,amount FROM com_cheering UNION
        SELECT internal_number,description,amount FROM com_comso UNION
        SELECT internal_number,description,amount FROM com_dorm_life UNION
        SELECT internal_number,description,amount FROM com_educational_services UNION
        SELECT internal_number,description,amount FROM com_environmental UNION
        SELECT internal_number,description,amount FROM com_finance UNION
        SELECT internal_number,description,amount FROM com_health UNION
        SELECT internal_number,description,amount FROM com_hert UNION
        SELECT internal_number,description,amount FROM com_high_school_affairs UNION
        SELECT internal_number,description,amount FROM com_infomedia UNION
        SELECT internal_number,description,amount FROM com_marketing UNION
        SELECT internal_number,description,amount FROM com_miss_silliman UNION
        SELECT internal_number,description,amount FROM com_research UNION
        SELECT internal_number,description,amount FROM com_resolutions UNION
        SELECT internal_number,description,amount FROM com_secretariat UNION
        SELECT internal_number,description,amount FROM com_social_services UNION
        SELECT internal_number,description,amount FROM com_socio_cultural UNION
        SELECT internal_number,description,amount FROM com_special_projects UNION
        SELECT internal_number,description,amount FROM com_spiritual_life UNION
        SELECT internal_number,description,amount FROM com_sports UNION
        SELECT internal_number,description,amount FROM com_straw UNION
        SELECT internal_number,description,amount FROM fund_assembly_general UNION
        SELECT internal_number,description,amount FROM fund_assembly_sponsorship UNION
        SELECT internal_number,description,amount FROM fund_comelec UNION
        SELECT internal_number,description,amount FROM fund_gender_inclusivity UNION
        SELECT internal_number,description,amount FROM fund_president_discretionary UNION
        SELECT internal_number,description,amount FROM fund_vice_president_discretionary
    ) AS TotalAmount WHERE 'CA'=LEFT(internal_number,2) AND amount IS null ORDER BY internal_number;";
}

//initial_fund & fund_last_administration
$initialfunds=mysqli_query($conn,"SELECT (t1.`last_fund`+(SUM(t2.`credit`)-SUM(t2.`debit`))) AS total_initialfunds FROM fund_last_administration t1, fund_initial_susg t2;");
$totalinitialfunds = mysqli_fetch_array($initialfunds);
$totalinitialfunds = $totalinitialfunds['total_initialfunds'];

//cashgenerated-cashdeposited
$depositedcashgenerated=mysqli_query($conn,"SELECT SUM(`deposited_amount`) AS total_depositedcashgenerated FROM cash_generated;");
$totaldepositedcashgenerated = mysqli_fetch_array($depositedcashgenerated);
$totaldepositedcashgenerated = $totaldepositedcashgenerated['total_depositedcashgenerated'];

//sponsorship-cashdeposited
$depositedsponsorship=mysqli_query($conn,"SELECT SUM(`deposited_value`) AS total_depositedsponsorship FROM sponsorships;");
$totaldepositedsponsorship = mysqli_fetch_array($depositedsponsorship);
$totaldepositedsponsorship = $totaldepositedsponsorship['total_depositedsponsorship'];

//petty cash
$pettycash=mysqli_query($conn,amount('PC',2));
$totalpettycash = mysqli_fetch_array($pettycash);
$totalpettycash = $totalpettycash['amounts'];

//cash advances- cash expenses
$cashexpenses=mysqli_query($conn, amount('CA',2));
$totalcashexpenses = mysqli_fetch_array($cashexpenses);
$totalcashexpenses = $totalcashexpenses['amounts'];

//cash advances- cash unliquidated
$internalnum=mysqli_query($conn, unli());
$abc = "";
$totalunliquidated=0;
if ($internalnum !=null) {
    while ($rew = mysqli_fetch_array($internalnum)) {
        $abc .= " internal_number='" . $rew['internal_number'] . "'";
        $abc .= " OR";
    }
    if($abc!=""){
        $abc= rtrim($abc, "OR");
        $unliqui = "SELECT SUM(`ca_amount`) as unliquidated FROM cash_advances WHERE" . $abc . ";";
        $unliquidated=mysqli_query($conn,$unliqui);
        $totalunliquidated = mysqli_fetch_array($unliquidated);
        $totalunliquidated = $totalunliquidated['unliquidated'];
    }
}

//requisitions
$requisitions=mysqli_query($conn,amount('REQ',3));
$totalrequisitions = mysqli_fetch_array($requisitions);
$totalrequisitions = $totalrequisitions['amounts'];

//reimbursements
$reimbursements=mysqli_query($conn,amount('REI',3));
$totalreimbursements = mysqli_fetch_array($reimbursements);
$totalreimbursements = $totalreimbursements['amounts'];

//remainingbudget
$totalremainingbudget = $totalinitialfunds + $totaldepositedcashgenerated + $totaldepositedsponsorship - $totalpettycash - $totalcashexpenses - $totalunliquidated - $totalrequisitions - $totalreimbursements;
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/general_information.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="images/susg-finance-icon.png">
    <link rel="icon" href="images/susg-finance-icon.png">
    <title>General Information</title>
</head>
<?php include("sidebar.php"); ?>
<body class="body-top">
<button type="button" class="info" data-toggle="modal" data-target="#infoModal" style="border: 0px; background-color: #ffcf49;"><p class="schoolyear fixed-top">SY <?php echo $selected_sy; ?></p></button>
	<div class="container">
        <div class="text-center">
            <h3>SILLIMAN UNIVERSITY STUDENT GOVERNMENT</h3>
            <h4>CONSOLIDATED ACCOUNT INFORMATION</h4>
            <h5>School Year <?php echo $selected_sy; ?>
            <h5>Perpetual (Running Balance)</h5>
        </div>
        <div class="d-flex justify-content-center" style="padding-top:2rem;">
            <div class="col-4" style="margin-right: 1.5rem;">
                <table class="table table-borderless table-hover">
                    <tr>
                        <th style="width:70%">Total Initial Funds</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalinitialfunds,2,'.',','); ?></td>
                    </tr>
                    <tr>
                        <th>Deposited Cash Generated</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totaldepositedcashgenerated,2,'.',','); ?></td>
                    </tr>
                    <tr>
                        <th>Deposited Cash Sponsorships</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totaldepositedsponsorship,2,'.',','); ?></td>
                    </tr>
                    <tr>
                        <th>Total Petty Cash Expenses</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalpettycash,2,'.',','); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-4" style="margin-left: 1.5rem;">
                <table class="table table-borderless table-hover">
                    <tr>
                        <th style="width:70%">Total CA Expenses</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalcashexpenses,2,'.',','); ?></td>
                    </tr>
                    <tr>
                        <th>Total Unliquidated CAs</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalunliquidated,2,'.',','); ?></td>
                    </tr>
                    <tr>
                        <th>Total Requisitions</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalrequisitions,2,'.',','); ?></td>
                    </tr>
                    <tr>
                        <th>Total Reimbursements</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalreimbursements,2,'.',','); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-4">
                <table class="table table-borderless table-hover">
                    <tr>
                        <th style="width:70%">Total Remaining Budget</th>
                        <td>₱</td>
                        <td class="value"><?php echo number_format($totalremainingbudget,2,'.',','); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="padding: 1rem 0 0 0;">
            <div class="alert alert-custom" role="alert">
                <p><strong>Notes:</strong><br> <i class='bx bx-note'></i>
                All transactions in the Internal System are relfections in the main SUSG Business and Finance Account (Acc No: 304.0253).</p><hr>
                <p style="margin-bottom: 0px;">
                <i class='bx bx-label'></i> MSC, Cheering, and ComSO have separate accounts for their operations and/or sales.<br>
                <i class='bx bx-label'></i> The Legislative will only simply approve the overall budget allocations at the beginning of the semester.<br>
                <i class='bx bx-label'></i> Once the budget is approved, the money is then transferred to their respective accounts.<br>
                <i class='bx bx-label'></i> By this time, the committees will have full discretion on how to spend the budget.</p>
            </div>
        </div>
	</div>
    <!--schoolyear info-->
<div class="modal fade modal-sm" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#ffc526;"></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="modal-body">
                    <div class="form-container">
                        <div class="form-group row">
                            <h5>School Year</h5>
                            <p>Choose from the choices.</p>
                            <div class="col-sm-12">
                                <select name="schoolyear" class="form-group form-select form-control">
                                    <option selected value="latest"><?php echo $selected_sy; ?><i class='bx bxs-group'></i> </option>
                                    <?php
                                        $year_1 = intval(substr($selected_sy, 0, 4));
                                        $year1=mysqli_query($connuser,"SELECT `year_1`,`year_2`, CONCAT(`year_1`,'-',`year_2`) AS yearoption FROM `database_year` WHERE `year_1`!=$year_1 ORDER BY `year_1` ASC;");
                                        while ($row=mysqli_fetch_array($year1))
                                        { ?>
                                            <option value="<?php echo $row['year_1']; ?>"><?php echo $row['yearoption']; ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="modal-footer" style="padding: 3px;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" value="submit"><i class='bx bx-message-square-edit icons_1' style="margin-right: 0.3rem;"></i>Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>