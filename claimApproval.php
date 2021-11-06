<?php
session_start();
include("db_connection.php");
if (isset($_GET["type1"])) {
    $sql = "SELECT * FROM claim WHERE status = 'Pending' AND employee_id = '" . $_SESSION['User']['employee_id'] . "'";
} elseif (isset($_GET["type2"])) {
    $sql = "SELECT * FROM claim WHERE status != 'Pending' AND employee_id = '" . $_SESSION['User']['employee_id'] . "'";
} elseif (isset($_GET["type3"])) {
    $sql = "SELECT * FROM claim WHERE status = 'Pending'";
} else {
    $sql = "SELECT * FROM claim WHERE status != 'Pending'";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Claim List</title>
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
                        Claims Table
                        <small>[List]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Claims Table</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">                           
                            <div class="box">
                                <div class="box-header">
                                    <?php
                                    if (isset($_GET["type1"])) {
                                        echo'<h3 class="box-title">Personal Pending Claims</h3>';
                                    } elseif (isset($_GET["type2"])) {
                                       echo'<h3 class="box-title">Personal Claims History</h3>'; 
                                    } elseif (isset($_GET["type3"])) {
                                        echo'<h3 class="box-title">All Pending Claims</h3>'; 
                                    } else {
                                        echo'<h3 class="box-title">All Claims History</h3>'; 
                                    }
                                    ?>
                                                                       
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Claim ID</th>
                                                <th>Employee ID</th>
                                                <th>Claim Description</th>
                                                <th>Claim Amount</th>
                                                <th>Claim Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>
                                                    <td>" . $row["claim_id"] . "</td>
                                                    <td>" . $row["employee_id"] . "</td>
                                                    <td>" . $row["claim_description"] . "</td>
                                                    <td>" . $row["claim_amount"] . "</td>
                                                    <td>" . $row["claim_date"] . "</td>
                                                    <td>" . $row["status"] . "</td>
                                                <td><a class='btn btn-warning' style='width: 100%' href='claimDetail.php?id=" . $row["claim_id"] . "'><i class='fa fa-camera'></i></a></td>
                                            </tr>";
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