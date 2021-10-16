<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Employee Main</title>
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
                        Employee Management
                        <small>[Main]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Management</li>
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
                                    <h3 class="box-title">Find Employee</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
<!--                                <form role="form">-->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control">
                                                        <option>Sales</option>
                                                        <option>Marketing</option>
                                                        <option>Production</option>
                                                        <option>Accounting</option>
                                                        <option>General</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <select class="form-control">
                                                        <option>Sales</option>
                                                        <option>Marketing</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee First Name</label>
                                                    <input type="fname" class="form-control" placeholder="first name" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Last Name</label>
                                                    <input type="lname" class="form-control" placeholder="last name" disabled/>
                                                </div>
                                            </div>

                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                            <button class="btn btn-primary" onclick="location.href = 'employeeModify&Delete.php'">Confirm</button>
                                    </div>
<!--                                </form>-->

                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>
