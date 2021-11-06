<?php
session_start();
include("db_connection.php");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Employee List</title>
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
                        Employee List Table
                        <small>[List]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee List Table</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">                           
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All Employee Details</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Employee Type</th>
                                                <th>Email</th>
                                                <th>Account Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($_SESSION["User"]["employee_type"] == "Admin") {
                                                $sql = "SELECT * FROM employee";
                                            }else{
                                                 $sql = "SELECT * FROM employee WHERE department_name = '" . $_SESSION["User"]["department_name"] . "'";
                                            }
                                            
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                    <td>" . $row["employee_id"] . "</td>
                                                    <td>" . $row["employee_name"] . "</td>
                                                    <td>" . $row["department_name"] . "</td>
                                                    <td>" . $row["employee_type"] . "</td>
                                                    <td>" . $row["email"] . "</td>
                                                    <td>" . $row["account_status"] . "</td>
                                                <td><a class='btn btn-warning' style='width: 100%' href='employeeDetail.php?id=".$row["employee_id"]."'><i class='fa fa-camera'></i></a></td>
                                            </tr>";
                                                }
                                            } else {
                                                echo '<script>alert("No available data !")</script>';
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="box-footer">
                                                <label>Add a new employee?</label>
                                                <button class="btn btn-primary" onclick="location.href = 'recruitment.php'">Add</button>
                                            </div>
                                        </div>
                                    </div>
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