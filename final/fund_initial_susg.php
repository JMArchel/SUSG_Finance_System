<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login");
    exit;
}

include "database.php";

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

if (isset($_POST['add_data'])) 
{
    $date = $_POST['date'];
    $description = $_POST['description'];
    $debit_credit = $_POST['debit_credit'];
    $value = $_POST['value'];

    $sql = "INSERT INTO `fund_initial_susg`(`date`, `description`, `$debit_credit`)
    VALUES ('$date','$description',$value);";
    if(mysqli_query($conn,$sql))
    {
        header("location: fund_initial_susg");
    }
    mysqli_close($conn);
}

if (isset($_POST['delete_data']))
{
    $idd = $_POST['delete_id'];

    $sql = "DELETE FROM `fund_initial_susg` WHERE `id`= $idd;";
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
<h5 class="title-name fixed-top">Initial SUSG Fund</h5>
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
        <div class="col-7">
            <p class="text-left subheading">Adjustments for the School Year's Enrollees</p>
            <div>
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th class="hleft">Date</th>
                            <th>Description</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center <?php if ($position == 0) {
                                echo 'hright';
                            }?>">Credit</th>
                            <?php if ($position !=0) { ?>
                            <th colspan="2" class="text-center hright">Action</th><?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $initialsusgfund=mysqli_query($conn,"SELECT `id`,DATE_FORMAT(`date`,'%M %e, %Y') AS date_mey,`description`,`debit`,`credit` FROM fund_initial_susg ORDER BY `date` ASC;");
                            while ($row=mysqli_fetch_array($initialsusgfund))
                            {
                                echo "<tr>";
                                    echo "<td style='display:none;'>"; echo $row["id"];  echo "</td>";
                                    echo "<td style='width:150px;'>"; echo $row["date_mey"];  echo "</td>";
                                    echo "<td>"; echo $row["description"];  echo "</td>";
                                    echo "<td class='text-center' style='width:150px;'>"; 
                                        if ($row["debit"]!=null){echo number_format($row["debit"],2,'.',',');}
                                    echo "</td>";
                                    echo "<td class='text-center' style='width:150px;'>";
                                        if ($row["credit"]!=null){echo number_format($row["credit"],2,'.',',');}
                                    echo "</td>";
                                    if ($position != 0) {
                                    echo "<td style='width:72px;'>";
                                        ?>
                                            <a href="fund_initial_susg_edit.php?id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-primary btn-sm" style="font-size: 10px; margin-right: 4px;"><i class='bx bx-message-square-edit icons'></i> Edit</button></a>
                                        <?php
                                    echo "</td>";
                                    echo "<td style='width:85px;'>";
                                        ?>
                                            <button type="button" class="btn btn-danger btn-sm deletebtn" style="font-size: 10px; margin-right: 4px;"><i class='bx bx-message-square-x icons'></i> Delete </button>
                                        <?php
                                    echo "</td>";
                                    }
                                echo "</tr>";
                            }
                            if ($position != 0) {?>
                            <tr>
                                <td colspan="6" style="padding: 0px;"><button type="button" class="btn btn-success btn" data-toggle="modal" data-target="#addModal" style="font-size: 10px; width:100%;"><i class='bx bx-message-square-add icons' style="margin-right:3px;"></i>Add</button></td>
                            </tr> <?php 
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--add modal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success"></div>
                <form action="fund_initial_susg.php" method="post">
                    <div class="modal-body">
                        <div class="form-container">
                            <h5 class="text-success">SUSG Funds</h5>
                            <p>Additional Entry for Adjustments</p> 
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>    
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                            <label style="padding-top:1rem;">Choose & Provide Value</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="debit_credit" id="inlineRadio1" value="debit" required>
                                    <label class="form-check-label" for="inlineRadio1" style="padding-top:0px;">Debit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="debit_credit" id="inlineRadio2" value="credit" required>
                                    <label class="form-check-label" for="inlineRadio2" style="padding-top:0px;">Credit</label>
                                </div>
                            </div>
                            <div class="form-group input-group" style="padding-bottom: 1rem;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" name="value" class="form-control" min="0.00" step="0.01" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 3px;">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_data" class="btn btn-success btn-sm" value="submit"><i class='bx bx-message-square-add icons_1' style="margin-right: 0.3rem;"></i>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger"></div>
                <form action="fund_initial_susg.php" method="POST">

                    <div class="modal-body">
                        <h5 class="text-danger">Delete</h5>
                        <input type="hidden" name="delete_id" id="delete_id">
                        <p>Are you sure you want to delete the selected data? You will not be able to retrieve it back.</p> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="delete_data" class="btn btn-danger btn-sm"><i class='bx bx-message-square-x icons_1' style="margin-right: 0.3rem;"></i>Delete</button>
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

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
</body>
</html>
