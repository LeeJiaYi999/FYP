<?php
session_start();
include("db_connection.php");
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Announcement Details</title>
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
                        Anouncement Details
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="taskList.php">Announcement List</a></li>
                        <li class="active">Announcement Details</li>
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
                                    <h3 class="box-title">Announcement</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <label>Announcement ID</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="ID" disabled>
                                                </div>  
                                                <div class="col-md-1">
                                                    <label>Post Date</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Date" disabled>
                                                </div>  
                                            </div>

                                        </div>
                                        &nbsp;
                                        <div class="form-group">
                                            <label>Announcement Description</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter description"></textarea>
                                        </div>

                                    </div>
                                    <div class="box-footer">
                                        <button type="modify" class="btn btn-primary">Modify</button>
                                        <button type="delete" class="btn btn-primary">Delete</button>
                                        <button type="cancel" class="btn btn-primary">Cancel</button>
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


