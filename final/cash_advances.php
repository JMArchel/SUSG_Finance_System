<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: account_login");
    exit;
}

include "database.php";

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
    <title>Cash Advacnces</title>
</head>
<?php include("sidebar.php"); ?>
<body class="body-top">
<h5 class="title-name fixed-top">Cash Advances</h5>
    <div class="row d-flex justify-content-center">
        <div class="col-11">
            <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th class="hleft">Internal Number</th>
                            <th class='text-center' style="width: 7rem;">Date</th>
                            <th class='text-center'>Comm. & Funds</th>
                            <th class='text-center'>Description</th>
                            <th class='text-center' style="width: 6.5rem;">CA Amount</th>
                            <th class='text-center' style="width: 6.5rem;">CA Expenses</th>
                            <th class='text-center' style="width: 9rem;">Remitted Amount</th>
                            <th class='text-center'>Status</th>
                            <th class='text-center'>Notes</th>
                            <?php if ($position !=0) { ?>
                            <th class="text-center hright">Action</th><?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $cash_advances=mysqli_query($conn,"SELECT cash_advances.id AS id, cash_advances.internal_number as internal_number, `date_of_sa`, `ca_amount`, `ca_status`, `notes`,committee_fund.comm_fund AS comm_fund, committee_fund.description AS description, SUM(committee_fund.amount) AS ca_expense, (ca_amount-SUM(committee_fund.amount)) AS remitted FROM cash_advances INNER JOIN committee_fund ON cash_advances.internal_number=committee_fund.internal_number WHERE 'CA'=LEFT(cash_advances.internal_number,2) GROUP BY cash_advances.internal_number;");
                            while ($row=mysqli_fetch_array($cash_advances))
                            {
                                echo "<tr>";
                                    echo "<td style='display:none;'>"; echo $row["id"];  echo "</td>";
                                    echo "<td style='width:150px;'>"; echo $row["internal_number"];  echo "</td>";
                                    echo "<td class='text-center'>"; echo $row["date_of_sa"];  echo "</td>";
                                    echo "<td>"; echo substr($row["comm_fund"],0,15) .'...';  echo "</td>";
                                    echo "<td>"; echo substr($row["description"], 0, 20) .'...';  echo "</td>";
                                    echo "<td style='text-align: end;margin: 0 auto;'>";
                                        echo number_format($row["ca_amount"],2,'.',',');
                                    echo "</td>";
                                    echo "<td style='text-align: end;margin: 0 auto;'>";
                                        if ($row["ca_expense"]!=null){echo number_format($row["ca_expense"],2,'.',',');}
                                    echo "</td>";
                                    echo "<td style='text-align: end;margin: 0 auto;'>";
                                        if ($row["ca_expense"]!=null){echo number_format($row["remitted"],2,'.',',');}
                                    echo "</td>";
                                    echo "<td class='text-center'>"; 
                                        if ($row["ca_status"]!=9){echo '<span class="badge text-bg-secondary">'.$row["ca_status"].'</span>';}
                                        else {echo '<span class="badge text-bg-dark">'.$row["ca_status"].'</span>';}
                                    echo "</td>";
                                    echo "<td>"; echo $row["notes"];  echo "</td>";
                                    if ($position != 0) {
                                    echo "<td style='width:140px;'>";
                                        ?>
                                            <button type="button" class="btn btn-primary btn-sm" style="font-size: 10px; margin-right: 4px;"><i class='bx bx-message-square-edit icons'></i> View</button></a>
                                            <button type="button" class="btn btn-danger btn-sm" style="font-size: 10px;"><i class='bx bx-message-square-x icons'></i>Delete</button></a>
                                        <?php
                                    echo "</td>";
                                    }
                                echo "</tr>";
                            }
                            if ($position != 0) {?>
                            <tr>
                                <td colspan="10" style="padding: 0px;"><button type="button" class="btn btn-success btn" style="font-size: 10px; width:100%;"><i class='bx bx-message-square-add icons' style="margin-right:3px;"></i>Add</button></td>
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