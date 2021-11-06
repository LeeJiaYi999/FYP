<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Leave Application</title>
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

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Leave Application Table
                        <small>[List]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Leave Application</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">                           
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Employee Leave Application</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Leave Day</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Leave Type</th>
                                                <th>Status</th>
                                                <th>Leave Description</th>
                                                <th>Approved By</th>
                                                <th>Reason</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($_SESSION["User"]["employee_type"] === "Admin"){
                                                $sql = "SELECT * FROM `leave`";
                                            }else{
                                                $sql = "SELECT DISTINCT * FROM `leave` l,`employee` e WHERE e.`employee_id` = l.`employee_id` AND (`status` = 'Approve' OR `status` = 'Reject') AND e.department_name = '{$_SESSION["User"]["department_name"]}'";
                                            }
//                                            $sql = "SELECT * FROM `leave` WHERE `status` = 'Approve' OR `status` = 'Reject'";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    if ($row["status"] === "Reject") {
                                                        $color = "red";
                                                    } else {
                                                        $color = "green";
                                                    }
                                                    echo
                                                    "<tr><td>" . $row["employee_id"] . "</td>
                                                <td>" . $row["employee_name"] . "</td>
                                                <td>" . $row["leave_day"] . "</td>
                                                <td>" . $row["start_date"] . "</td>
                                                <td>" . $row["end_date"] . "</td>
                                                <td>" . $row["leave_type"] . "</td>
                                                <td style='color: $color'>" . $row["status"] . "</td>
                                                <td>" . $row["leave_description"] . "</td>
                                                <td>" . $row["Approve_by"] . "</td>
                                                <td>" . $row["reason"] . "</td>
                                                <td><a class='btn btn-warning' style='width: 100%' href='changeLeaveHistory.php?id=" . $row["leave_id"] . "'><i class='fa fa-camera'></i></a></td></tr>";
                                                }
                                            } else {
                                                echo '<script>alert("No available data !")</script>';
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function () {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>