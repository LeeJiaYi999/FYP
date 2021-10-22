<?php
session_start();
include("db_connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE department SET department_name='" . $_POST['departmentname'] . "',department_description='" . $_POST['departmentdescription'] . "' WHERE 1";
    if ($conn->query($sql)) {
        $_SESSION["department_name"] = $_POST['departmentname'];
        $_SESSION["department_description"] = $_POST['departmentdescription'];
        echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Update fail !");</script>';
    }
}
?>

<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Add Department</title>
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
                        Department
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add New Department</li>
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
                                    <h3 class="box-title">Add Department</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="departmentname">Department Name</label>
                                                    <input type="text" class="form-control" name="departmentname" id="departmentname" placeholder="Enter department name" required="required" 
                                                           value="<?php
                                                           echo $_SESSION["department_name"];
                                                           ?>">
                                                </div>        
                                                <div class="form-group">
                                                    <label>Department Description</label>
                                                    <textarea class="form-control" name="departmentdescription" id="departmentdescription" rows="3" placeholder="Enter description" required="required" 
                                                           value="<?php
                                                           echo $_SESSION["department_description"];
                                                           ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                            <button type="add" class="btn btn-primary">Add</button>
                                    </div>
                                </form>

                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->
                    </div>   <!-- /.row -->
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

