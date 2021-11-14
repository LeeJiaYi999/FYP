<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        include("sidebar.php");
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="right-side">
                <!-- Content Header (Page header) -->

                <?php
                if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                ?>
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="home.php">Dashboard</a></li>
                    </ol>
                </section>
                <?php endif; ?>
                <?php
                if ($_SESSION["User"]["employee_type"] === "Employee"):
                ?>
                <section class="content-header">
                    <h1>
                        Welcome to Employee Management System
                    </h1>
                </section>
                <?php endif; ?>
                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM employee")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>
                                    <p>Total Employees</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-stalker"></i>
                                </div>
                                <a href="employeeList.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM attendance")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>
                                    <p>Total Attendance</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="viewAttendanceList.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM `attendance` WHERE `status` = 'On Time'")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>             
                                    <p>On Time</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clock"></i>
                                </div>
                                <a href="viewAttendanceList.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM `attendance` WHERE `status` = 'Late'")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>
                                    <p>Late</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert-circled"></i>
                                </div>
                                <a href="viewAttendanceList.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM `leave`")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>
                                    <p>Total Leave</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-calendar"></i>
                                </div>
                                <a href="leaveHistory.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM `leave` WHERE `status` = 'Approve'")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>
                                    <p>Approved Leave</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark"></i>
                                </div>
                                <a href="leaveHistory.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM `leave` WHERE `status` = 'Reject'")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>             
                                    <p>Rejected Leave</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-close"></i>
                                </div>
                                <a href="leaveHistory.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- ./col -->
                        <?php
                        if ($_SESSION["User"]["employee_type"] === "Department Head"):
                        ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3><?php
                                        $employee = $conn->query("SELECT * FROM `leave` l,`employee` e WHERE e.`employee_id` = l.`employee_id` AND `status` = 'Pending' AND e.department_name = '{$_SESSION["User"]["department_name"]}'")->num_rows;
                                        echo number_format($employee);
                                        ?></h3>
                                    <p>Leave Pending</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert"></i>
                                </div>
                                <a href="leaveApplication.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                </section>
            </aside>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>       
        <script>
            $(function () {
                $('#select_year').change(function () {
                    window.location.href = 'home.php?year=' + $(this).val();
                });
            });
        </script>

    </body>
</html>