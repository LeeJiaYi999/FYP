<?php
session_start();
include("db_connection.php");
echo '<script>var available_Leave = ' . json_encode($_SESSION['User']["leave_available"]) . ';</script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO `leave`(leave_day, start_date, end_date, leave_description, employee_id, leave_type ,employee_name ,status) VALUES ('" . $_POST['lday'] . "','" . $_POST['sdate'] . "','" . $_POST['edate'] . "','" . $_POST['ldescription'] . "','" . $_SESSION["User"]["employee_id"] . "','" . $_POST['leave_type'] . "','" . $_SESSION["User"]["employee_name"] . "','Pending')";
    if ($conn->query($sql)) {
        echo '<script>alert("Waiting admin response !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Apply Leave Fail !");window.location.href = "home.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Apply Leave</title>
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
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Apply Leave
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Apply Leave</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Apply Leave Form</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Leave Description</label>
                                                    <input type="text" class="form-control" name="ldescription" id="ldescription" placeholder="Enter Leave Description">
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Day</label>
                                                    <input type="text" class="form-control" name="lday" id="lday" placeholder="Leave Day" readOnly>
                                                </div>
                                                <div class="from-group">
                                                    <label>Start Date:</label>
                                                    <input type="date" class="form-control" name="sdate" onChange="update_day()" id="sdate" placeholder="Enter Start Date">
                                                </div>
                                                <div class="from-group">
                                                    <label>End Date:</label>
                                                    <input type="date" class="form-control" name="edate" onChange="update_day()" id="edate" placeholder="Enter End Date">
                                                </div>
                                                <div class="from-group">
                                                    <label>Leave type:</label>
                                                    <input type="text" class="form-control" name="leave_type" id="leave_type" placeholder="Pending" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" onclick="apply()" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->

                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.0
                </div>
            </footer>

        </div>


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <script>
                                            function update_day() {
                                                var sdate = new Date(document.getElementById("sdate").value);
                                                var edate = new Date(document.getElementById("edate").value);
                                                var diffTime = Math.abs(edate - sdate) + 1;
                                                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                                if (sdate <= edate) {
                                                    if (diffDays) {
                                                        document.getElementById("lday").value = diffDays;
                                                        if (available_Leave < diffDays) {
                                                            document.getElementById("leave_type").value = "Unpaid Leave";
                                                        } else {
                                                            document.getElementById("leave_type").value = "Annual Leave";
                                                        }
                                                    }
                                                } else {
                                                    alert("End date must larger than start date !");
                                                }
                                            }

                                            function apply() {
                                                if (document.getElementById("sdate").value === "" || document.getElementById("edate").value === "" || document.getElementById("ldescription").value === "" || document.getElementById("lday").value === "" || document.getElementById("lday").value === "") {
                                                    alert("Please fill up all the input !");
                                                } else {
                                                    document.getElementById("form").submit();
                                                }
                                            }

        </script>
    </body>
</html>

