<?php
session_start();
include("db_connection.php");
$sql = "SELECT position_id FROM position ORDER BY position_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['position_id'], 1)) + 1;
        $newid = "P{$latestnum}";
        break;
    }
} else {
    $newid = "P1001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO `position`(`position_id`, `position_name`, `annual_leave`, `sick_leave`, `compassionate_leave`,`Maternity Leave`) "
            . "VALUES ('" . $_POST['position_id'] . "','" . $_POST['position_name'] . "','" . $_POST['annual_leave'] . "','" . $_POST['sick_leave'] . "','" . $_POST['compassionate_leave'] . "','" . $_POST['maternity_leave'] . "')";
    if ($conn->query($sql)) {
        echo '<script>alert("Create Successfully !");window.location.href = "home.php";</script>';

    }else{
        echo '<script>alert("Create Fail !");</script>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Position</title>
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
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add New Position</li>
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
                                    <h3 class="box-title">Add Position</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Position ID</label>
                                                    <input type="text" class="form-control" name="position_id" id="position_id" placeholder="Enter Position id" value="<?php echo $newid ?>" readOnly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Position Name</label>
                                                    <input type="text" class="form-control" name="position_name" id="position_name" placeholder="Enter Position name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Annual Leave Available</label>
                                                    <input type="number" class="form-control" name="annual_leave" id="annual_leave" placeholder="Enter Annual Leave Available">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sick Leave Available</label>
                                                    <input type="number" class="form-control" name="sick_leave" id="sick_leave" placeholder="Enter Sick Leave Available">
                                                </div>
                                                <div class="form-group">
                                                    <label>Compassionate Leave Available</label>
                                                    <input type="number" class="form-control" name="compassionate_leave" id="compassionate_leave" placeholder="Enter Compassionate Leave Available">
                                                </div>
                                                <div class="form-group">
                                                    <label>Maternity Leave Available</label>
                                                    <input type="number" class="form-control" name="maternity_leave" id="maternity_leave" placeholder="Enter Maternity Leave Available">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                            <button type="button" class="btn btn-primary" onclick="save()" id="btnsave">Add</button>
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
        
        <script>
            function save() {
                var valid = true;
                var error = "";

                if (document.getElementById("position_name").value === "") {
                    valid = false;
                    error += "Please Enter Position Name !\n";
                }

                if (document.getElementById("annual_leave").value === "") {
                    valid = false;
                    error += "Please Enter Annual Leave !\n";
                }

                if (document.getElementById("sick_leave").value === "") {
                    valid = false;
                    error += "Please Enter Sick Leave !\n";
                }
                if (document.getElementById("compassionate_leave").value === "") {
                    valid = false;
                    error += "Please Enter Compassionate Leave !\n";
                }
                if (document.getElementById("maternity_leave").value === "") {
                    valid = false;
                    error += "Please Enter Maternity Leave !\n";
                }
                if (valid) {
                    document.getElementById("form").submit();

                } else {
                    alert(error);
                }
            }

        </script>

    </body>
</html>