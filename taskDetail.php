
<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Update Task</title>
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
                        Task
                        <small>[Detail]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="taskList.php">Task List</a></li>
                        <li class="active">Update Task</li>
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
                                    <h3 class="box-title">Update Task</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Project ID</label>
                                                    <input type="text" class="form-control" placeholder="project id" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Description</label>
                                                    <textarea class="form-control" rows="3" placeholder="Enter description" disabled></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="projectname">Task Progress</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="projectname" class="form-control" id="exampleInputEmail1" placeholder="%" disabled>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label>%</label>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Task ID</label>
                                                    <input type="text" class="form-control" placeholder="task id" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Task Description</label>
                                                    <textarea class="form-control" rows="3" placeholder="Enter description" disabled></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Due Date:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" disabled data-mask/>
                                                    </div><!-- /.input group -->
                                                </div><!-- /.form group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-md-1"><button type="Modify" class="btn btn-primary" style="width:100%">Modify</button></div>
                                            <div class="col-md-1"><button type="Cancel" class="btn btn-primary" style="width:100%">Cancel</button></div>
                                            <div class="col-md-1"><button type="Delete" class="btn btn-primary" style="width:100%">Delete</button></div>                                              
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
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>


