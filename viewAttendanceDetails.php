<?php
session_start();
include("db_connection.php");
?>

<html>
<body> 
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Attendance Details</title>
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

        <?php include("sidebar.php");
        ?>
        <?php
//        $attdate = date("d-m-y");
//        echo $attdate;
//        echo"<br>";
//        date_default_timezone_set("Malaysia");
//        $ctime = date("h:i:s A", time());
//        echo $ctime;
//        
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">View Attendance Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control" name="eid" id="eid">
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="ename" id="ename">
                                                </div>
                                                <div class="form-group">
                                                    <label>Check In Time</label>
                                                    <input type="text" class="form-control" name="cin" id="cin">
                                                </div>
                                                <div class="form-group">
                                                    <label>Check Out Time</label>
                                                    <input type="text" class="form-control" name="cout" id="cout">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input type="text" class="form-control" name="status" id="status">
                                                </div>
                                                <div class="form-group">
                                                    <label>Attendance Date</label>
                                                    <input type="text" class="form-control" name="adate" id="adate">
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                       <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                                       <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                                       <button type="button" class="btn btn-default btn-flat pull-left" name="Cancel"><i class="fa fa-close"></i> Cancel</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->

                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>

    </body>
</html>