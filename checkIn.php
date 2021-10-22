<?php
session_start();
include("db_connection.php");

$sql = "SELECT * FROM attendance WHERE employee_id = '" . $_SESSION["User"]["employee_id"] . "' AND attendance_date = '" . $_SESSION["date"] . "' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<script>var checkIn = true;</script>';;
        $data = $row;
        break;
    }
} else {
    echo '<script>var checkIn = false;</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO attendance(checkin_time, checkout_time, attendance_date, employee_id, employee_name, status) VALUES ('" . $_POST['checkin'] . "',null,'" . $_SESSION["date"] . "','" . $_SESSION["User"]["employee_id"] . "','" . $_SESSION["User"]["employee_name"] . "','" . $_POST["status"] . "')";
    if ($conn->query($sql)) {
        echo '<script>alert("Check In successfully\n Back to home page !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Check In fail !");</script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Attendance Check In</title>
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
                        Check In Attendance
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Check In</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" <?php if (isset($data)) {
                                                            echo "style='color:red'";
                                                        }?>>Check In Attendance Form <?php if (isset($data)) {
                                                            echo "( You have already Check In today)";
                                                        }?></h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form id="form" method="post">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="text-align: center">
                                                        <label>Check In Time</label>
                                                        <input  style="text-align: center" type="text" class="form-control" name="checkin" id="checkin" placeholder="Pending" value="<?php
                                                        if (isset($data)) {
                                                            echo $data["checkin_time"];
                                                        }
                                                        ?>" readonly/>
                                                    </div>   
                                                    <div class="form-group"  style="text-align: center">
                                                        <label>Status</label>
                                                        <input   style="text-align: center"type="text" class="form-control" name="status" id="status" placeholder="Pending" value="<?php
                                                        if (isset($data)) {
                                                            echo $data["status"];
                                                        }
                                                        ?>" readonly/>
                                                    </div>

                                                    <div class="form-group"  style="text-align: center">
                                                        <label>Attendance Date</label>
                                                        <input  style="text-align: center" type="text" class="form-control" name="adate" id="adate" placeholder="Pending" value="<?php
                                                        if (isset($data)) {
                                                            echo $data["attendance_date"];
                                                        }
                                                        ?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="button" id="btn_CheckIn" class="btn btn-primary" style="width:100%" onclick="checkIn()" <?php if(isset($data)){echo "disabled";}?>>Check In</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </div>
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
<script>

                                                function checkIn() {
                                                    var today = new Date();
                                                    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                                                    var time = today.getHours() + ":" + today.getMinutes();
                                                    if (today.getHours() > 8) {
                                                        document.getElementById("status").value = "Late";
                                                    } else {
                                                        document.getElementById("status").value = "On time";
                                                    }
                                                    document.getElementById("adate").value = date;
                                                    document.getElementById("checkin").value = time;
                                                    document.getElementById("form").submit();
                                                }
</script>
