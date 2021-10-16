<?php
session_start();
include("db_connection.php");

echo '<script>var available_Leave = ' . json_encode($_SESSION['User']["leave_available"]) . ';</script>';
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
                                <form role="form">
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
                                                    <input type="date" class="form-control" name="sdate" onclick="update_day()" id="sdate" placeholder="Enter Start Date">
                                                </div>
                                                <div class="from-group">
                                                    <label>End Date:</label>
                                                    <input type="date" class="form-control" name="edate" onclick="update_day()" id="edate" placeholder="Enter End Date">
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Type</label>
                                                    <select class="form-control">
                                                        <option>Annual Leave</option>
                                                        <option>Unpaid Leave</option>
                                                    </select>
                                                </div> 

                                            </div>

                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                                                            console.log(edate.getDate().toString());
                                                            var Difference_In_Time = edate.getDate() - sdate.getDate();
                                                            // To calculate the no. of days between two dates
                                                            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                                                            console.log(Difference_In_Days.toString());
                                                            document.getElementById("lday").value = Difference_In_Days.toString();
                                                        }

        </script>


    </body>
</html>

