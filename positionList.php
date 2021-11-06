<?php
session_start();
include("db_connection.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Position List</title>
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
                        Position List Table
                        <small>[List]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Position List Table</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">                           
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Available Position List</h3>    
                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Position ID</th>
                                                <th>Position Name</th>
                                                <th>Annual Leave</th>
                                                <th>Sick Leave</th>
                                                <th>Compassionate Leave</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM position";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                <td>" . $row["position_id"] . "</td>
                                                <td>" . $row["position_name"] . "</td>
                                                <td>" . $row["annual_leave"] . "</td>
                                                <td>" . $row["sick_leave"] . "</td>
                                                <td>" . $row["compassionate_leave"] . "</td>
                                                <td><a class='btn btn-warning' style='width: 100%' href='positionDetails.php?id=" . $row["position_id"] . "'><i class='fa fa-camera'></i></a></td>
                                            </tr>";
                                                }
                                            } else {
                                                echo '<script>alert("No available data !")</script>';
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <label>Create a new position?</label>
                                    <button class="btn btn-primary" onclick="location.href = 'positionAdd.php'">Add</button>
                                </div>
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