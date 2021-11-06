<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM position WHERE position_id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
    } else {
        echo '<script>alert("Extract data error !");window.location.href = "home.php";</script>';
    }
} else {
    
}
?>

<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Position Details</title>
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
                        Position
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Position Details</li>
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
                                    <h3 class="box-title">Position Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="position_id">Position ID</label>
                                                    <input type="text" class="form-control" name="position_id" id="position_id" placeholder="Position id" disabled value="<?php
                                                    echo $current_data["position_id"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="position_name">Position Name</label>
                                                    <input type="text" class="form-control" name="position_name" id="position_name" placeholder="Enter Position name" readOnly value="<?php
                                                    echo $current_data["position_name"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Annual Leave Available</label>
                                                    <input type="number" class="form-control" name="annual_leave" id="annual_leave" placeholder="Enter Annual Leave Available" readOnly value="<?php
                                                    echo $current_data["annual_leave"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sick Leave Available</label>
                                                    <input type="number" class="form-control" name="sick_leave" id="sick_leave" placeholder="Enter Sick Leave Available" readOnly value="<?php
                                                    echo $current_data["sick_leave"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Compassionate Leave Available</label>
                                                    <input type="number" class="form-control" name="compassionate_leave" id="compassionate_leave" placeholder="Enter Compassionate Leave Available" readOnly value="<?php
                                                    echo $current_data["compassionate_leave"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Maternity Leave Available</label>
                                                    <input type="number" class="form-control" name="maternity_leave" id="maternity_leave" placeholder="Enter Maternity Leave Available" readOnly value="<?php
                                                    echo $current_data["Maternity Leave"];
                                                    ?>">
                                                </div>
                                                <div class="box-footer">
                                                    <button type="button" class="btn btn-default btn-flat pull-left" id="btn_cancel" onclick="location.href = 'positionList.php'"><i class="fa fa-close"></i> Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <script>

                                                        $(document).ready(function () {

                                                            $("#btnmodify").on("click", function () {

                                                                $("textarea[type=textarea]").removeAttr("readonly");
                                                                $("input[type=text]").removeAttr("readonly");
                                                                $("input[type=date]").removeAttr("readonly");
                                                                $("select[type=select]").removeAttr("readonly");
                                                                $("select[type=time]").removeAttr("readonly");
                                                                $("select[type=number]").removeAttr("readonly");
                                                            })

                                                            $("#btnsave").on("click", function () {

                                                                $("textarea[type=textarea]").prop("readonly", true);
                                                                $("input[type=text]").prop("readonly", true);
                                                                $("input[type=date]").prop("readonly", true);
                                                                $("select[type=select]").prop("readonly", true);
                                                                $("select[type=time]").prop("readonly", true);
                                                                $("select[type=number]").prop("readonly", true);
                                                            })


                                                        })
        </script>
    </body>
</html>