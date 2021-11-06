<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE employee_id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
    } else {
        echo '<script>alert("Extract data error !\nContact management for maintainence");window.location.href = "admin_list.php";</script>';
    }
} else {
    
}

$Array_payroll = array();
$sql = "SELECT * FROM payroll";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_payroll, $row);
    }
}
echo '<script>var Array_payroll = ' . json_encode($Array_payroll) . ';</script>';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Personal Payroll Details</title>
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
                        Personal Payroll Details
                        <small>[View]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="taskList.php">Payroll List</a></li>
                        <li class="active">Personal Payroll Details</li>
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
                                    <h3 class="box-title">Personal Payroll</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control"  name="employee_id" id="employee_id" placeholder="Employee ID" readonly value="<?php
                                                    echo $current_data["employee_id"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control"  name="employee_name" id="employee_name" placeholder="Employee Name" readonly value="<?php
                                                    echo $current_data["employee_name"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control"  name="department_name" id="department_name" placeholder="Department" readonly value="<?php
                                                    echo $current_data["department_name"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Position</label>
                                                    <input type="text" class="form-control"  name="position" id="position" placeholder="Position" readonly value="<?php
                                                    echo $current_data["position"];
                                                    ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Month</label>
                                                        <input type="month" class="form-control"  name="month" id="month" onchange="select_month_display_detail()" onclick="select_month_display_detail()">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Gross Salary Amount</label>
                                                        <input type="text" class="form-control"  name="gross_salary" id="gross_salary" placeholder="Gross salary" readonly >
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>EPF (9%)</label>
                                                                <input type="text" class="form-control"  name="epf" id="epf" placeholder="EPF deduction" readonly value="<?php
                                                                $salary_amount = floatval($current_data["salary_amount"]);
                                                                $epf = $salary_amount * 0.09;
                                                                echo $epf;
                                                                ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>SOSCO (0.5%)</label>
                                                                <input type="text" class="form-control"  name="sosco" id="sosco" placeholder="SOSCO deduction" readonly value="<?php
                                                                $salary_amount = floatval($current_data["salary_amount"]);
                                                                $sosco = $salary_amount * 0.005;
                                                                echo $sosco;
                                                                ?>">
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>EIS (0.2%)</label>
                                                                <input type="text" class="form-control"  name="eis" id="eis" placeholder="EIS deduction" readonly value="<?php
                                                                $salary_amount = floatval($current_data["salary_amount"]);
                                                                $eis = $salary_amount * 0.002;
                                                                echo $eis;
                                                                ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Tax Amount (12%)</label>
                                                                <input type="text" class="form-control"  name="tax" id="tax" placeholder="Tax" readonly value="<?php
                                                                $salary_amount = floatval($current_data["salary_amount"]);
                                                                $tax = $salary_amount * 0.12;
                                                                echo $tax;
                                                                ?>"> 
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Unpaid Leave</label>
                                                                <input type="text" class="form-control"  name="unpaid_leave" id="unpaid_leave" placeholder="unpaid leave" readonly value="<?php
                                                                $leave = 0;
                                                                $sql = "SELECT * FROM `leave` WHERE leave_type = 'Unpaid Leave' AND employee_id = '" . $current_data["employee_id"] . "' AND status = 'Approve'";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        $leave += intval($row["leave_day"]);
                                                                    }
                                                                    $unpaid_salary = round($leave * (floatval($current_data["salary_amount"]) / 28), 2);
                                                                    echo $unpaid_salary;
                                                                }
                                                                ?>"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Net Salary Amount</label>
                                                        <input type="text" class="form-control"  name="net_salary" id="net_salary" placeholder="Net salary" readonly value="<?php
                                                               $net_salary = $salary_amount - $epf - $sosco - $eis - $tax - $unpaid_salary;
                                                               echo $net_salary;
                                                               ?>">
                                                    </div>
                                                </div>
                                            </div>
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

        <script>

                                                            $(document).ready(function () {
                                                                $("#btnmodify").on("click", function () {

                                                                    $("textarea[type=textarea]").removeAttr("readonly");
                                                                })

                                                                $("#btnsave").on("click", function () {

                                                                    $("textarea[type=textarea]").prop("readonly", true);
                                                                })
                                                            })

                                                            function select_month_display_detail() {
                                                                var x = 0;
                                                                while (Array_payroll) {
                                                                    if (DATE_FORMAT(Array_payroll[x][9].toString(), '%Y%m') === DATE_FORMAT(document.getElementById("month").value, '%Y%m')) {
                                                                        document.getElementById("gross_salary").value = Array_payroll[x][1].toString();
                                                                        document.getElementById("epf").value = Array_payroll[x][5].toString();
                                                                        document.getElementById("sosco").value = Array_payroll[x][6].toString();
                                                                        document.getElementById("eis").value = Array_payroll[x][7].toString();
                                                                        document.getElementById("tax").value = Array_payroll[x][8].toString();
                                                                        document.getElementById("net_salary").value = Array_payroll[x][4].toString();
                                                                    }
                                                                    x++;
                                                                }
                                                            }
        </script>
    </body>
</html>


