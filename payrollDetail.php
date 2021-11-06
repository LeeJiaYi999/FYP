<?php
session_start();
include("db_connection.php");
$employee_amount = 0;
$gross_salary = 0;
$epf = 0;
$sosco = 0;
$eis = 0;
$net_salary = 0;

$sql = "SELECT * FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $leave = 0;
        $sql2 = "SELECT * FROM `leave` WHERE leave_type = 'Unpaid Leave' AND employee_id = '" . $row['employee_id'] . "' AND status = 'Approve'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $leave += intval($row2["leave_day"]);
            }
        }
        $daily_salary = round(floatval($row["salary_amount"]) / 28, 2);
        $unpaid_salary = round($daily_salary * $leave, 2);
        $salary_amount = round(floatval($row["salary_amount"]) - $unpaid_salary, 2);
        $personal_epf = round($salary_amount * 0.09, 2);
        $personal_sosco = round($salary_amount * 0.005, 2);
        $personal_eis = round($salary_amount * 0.002, 2);
        $personal_tax = round($salary_amount * 0.12, 2);
        $final_salary = round($salary_amount - $personal_epf - $personal_sosco - $personal_eis - $personal_tax, 2);

        $sql3 = "SELECT payroll_id FROM payroll ORDER BY payroll_id DESC LIMIT 1";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
            while ($row3 = mysqli_fetch_array($result3)) {
                $latestnum = ((int) substr($row3['payroll_id'], 3)) + 1;
                $newid = "PAY{$latestnum}";
                break;
            }
        } else {
            $newid = "PAY10001";
        }
        $sql4 = "INSERT INTO `payroll`(`payroll_id`, `salary_amount`, `employee_id`, `extra_leave`, `salary_total`, `epf`, `sosco`, `eis`, `tax`, `date` )"
                . "VALUES ('" . $newid . "','" . $row["salary_amount"] . "','" . $row['employee_id'] . "','" . $unpaid_salary . "','" . $final_salary . "','" . $personal_epf . "','" . $personal_sosco . "','" . $personal_eis . "','" . $personal_tax . "','" . $_SESSION["date"] . "')";
        $conn->query($sql4);
    }
}

$sql = "SELECT `tpayroll_id` FROM `total_payroll` ORDER BY `tpayroll_id` DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['tpayroll_id'], 2)) + 1;
        $newid2 = "TP{$latestnum}";
        break;
    }
} else {
    $newid2 = "TP1001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO `total_payroll`(`tpayroll_id`, `total_epf`, `total_sosco`, `total_eis`, `total_net_salary`, `total_gross_salary`)"
            . "VALUES ('" . $newid2 . "','" . $_POST['epf'] . "','" . $_POST['sosco'] . "','" . $_POST['eis'] . "','" . $_POST['net_salary'] . "','" . $_POST['gross_salary'] . "')";
    if ($conn->query($sql)) {
        echo '<script>alert("Create Successfully !");window.location.href = "home.php";</script>';

    }else{
        echo '<script>alert("Create Fail !");</script>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Payroll Details</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <?php
        include("sidebar.php");
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Payroll Details
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="taskList.php">Payroll List</a></li>
                        <li class="active">Payroll Details</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Payroll</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Month</label>
                                                        <input type="month" class="form-control"  name="month" id="month">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Employee Amount</label>
                                                        <input type="text" class="form-control"  name="employee_amount" id="employee_amount" placeholder="Employee total amount" readonly value="<?php
                                                        $sql = "SELECT COUNT(`employee_id`) as count FROM employee";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo $row["count"];
                                                            }
                                                        }
                                                        ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Gross Salary Amount</label>
                                                        <input type="text" class="form-control"  name="gross_salary" id="gross_salary" placeholder="Gross salary" readonly value="<?php
                                                        $sql = "SELECT SUM(`salary_amount`) as salary_amount FROM payroll";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo $row["salary_amount"];
                                                            }
                                                        }
                                                        ?>">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>EPF (9%)</label>
                                                                <input type="text" class="form-control"  name="epf" id="epf" placeholder="EPF deduction" readonly value="<?php
                                                                $sql = "SELECT SUM(`epf`) as epf FROM payroll";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        echo $row["epf"];
                                                                    }
                                                                }
                                                                ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>SOSCO (0.5%)</label>
                                                                <input type="text" class="form-control"  name="sosco" id="sosco" placeholder="SOSCO deduction" readonly value="<?php
                                                                $sql = "SELECT SUM(`sosco`) as sosco FROM payroll";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        echo $row["sosco"];
                                                                    }
                                                                }
                                                                ?>">
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>EIS (0.2%)</label>
                                                                <input type="text" class="form-control"  name="eis" id="eis" placeholder="EIS deduction" readonly value="<?php
                                                                $sql = "SELECT SUM(`eis`) as eis FROM payroll";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        echo $row["eis"];
                                                                    }
                                                                }
                                                                ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Net Salary Amount</label>
                                                        <input type="text" class="form-control"  name="net_salary" id="net_salary" placeholder="Net salary" readonly value="<?php
                                                        $sql = "SELECT SUM(`salary_total`) as salary_total FROM payroll";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo $row["salary_total"];
                                                            }
                                                        }
                                                        ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" id="btnadd" name="btnadd" class="btn btn-primary">Pay</button>
                                        </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!--/.col (left) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>


