<?php
session_start();
include("db_connection.php");
$sql = "SELECT schedule_id FROM schedule ORDER BY schedule_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['schedule_id'], 1)) + 1;
        $newid = "S{$latestnum}";
        break;
    }
} else {
    $newid = "S1001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO schedule(schedule_id, checkin_time, checkout_time, status) "
            . "VALUES ('" . $_POST['schedule_id'] . "','" . $_POST['checkin'] . "','" . $_POST['checkout'] . "','" . $_POST['schedule_name'] . "')";
    if ($conn->query($sql)) {
        echo '<script>alert("Create Successfully !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Create Fail !");</script>';
    }
}
?>

<html>
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
                        Schedule
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add New Schedule</li>
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
                                <form method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="department_id">Schedule ID</label>
                                                    <input type="text" class="form-control" name="schedule_id" id="schedule_id" placeholder="Enter Schedule id" value="<?php echo $newid ?>" readOnly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="schedulename">Schedule Name</label>
                                                    <input type="text" class="form-control" name="schedule_name" id="schedule_name" placeholder="Enter Schedule name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Check In Time</label>
                                                    <input type="time" min="00:00" max="24:00" class="form-control" name="checkin" id="checkin" placeholder="Check In Time"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Check Out Time</label>
                                                    <input type="time" min="00:00" max="24:00" class="form-control" name="checkout" id="checkout" placeholder="Check Out Time"/>
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

                if (document.getElementById("schedule_name").value === "") {
                    valid = false;
                    error += "Please enter Schedule Name !\n";
                }

                if (document.getElementById("checkin").value === "") {
                    valid = false;
                    error += "Please enter Check In Time !\n";
                }

                if (document.getElementById("checkout").value === "") {
                    valid = false;
                    error += "Please enter Check Out Time !\n";
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