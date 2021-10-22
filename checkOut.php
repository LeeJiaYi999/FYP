<?php
session_start();
include("db_connection.php");

$sql = "SELECT * FROM attendance WHERE employee_id = '" . $_SESSION["User"]["employee_id"] . "' AND attendance_date = '" . $_SESSION["date"] . "' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        if ($row["checkout_time"] === "" || !$row["checkout_time"]) {
            $logOut = true;
        } else {
            $logOut = false;
        }
        $data = $row;
        break;
    }
} else {
    echo '<script>alert("You have no yet Check In\n Back to home page !");window.location.href = "home.php";</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE `attendance` SET checkout_time= '" . $_POST['checkout'] . "' WHERE 1";
    if ($conn->query($sql)) {
        echo '<script>alert("Check Out successfully\n Back to home page !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Check Out fail !");</script>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Attendance Check Out</title>
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
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Check Out Attendance
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Check Out</a></li>
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
                                    <h3 class="box-title">Check Out Attendance Form </h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id="form" method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: center">
                                                    <label>Check In Time</label>
                                                    <input style="text-align: center" type="text" class="form-control" name="checkin" id="checkin" placeholder="Check In Time" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["checkin_time"];
                                                    }
                                                    ?>" readOnly/>
                                                </div>                                            
                                                <div class="form-group" style="text-align: center">
                                                    <label>Status</label>
                                                    <input style="text-align: center" type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["status"];
                                                    }
                                                    ?>" readOnly/>
                                                </div>
                                                <div class="form-group" style="text-align: center">
                                                    <label>Attendance Date</label>
                                                    <input style="text-align: center" type="text" class="form-control" name="adate" id="adate" placeholder="Attendance Date" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["attendance_date"];
                                                    }
                                                    ?>" readOnly/>
                                                </div>
                                                <div class="form-group" style="text-align: center">
                                                    <label>Check Out Time</label>
                                                    <input style="text-align: center" type="text" class="form-control" name="checkout" id="checkout" id="checkout" placeholder="Pending" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["checkout_time"];
                                                    }
                                                    ?>" readOnly/>
                                                </div>


                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" style="width:100%" id="btn_CheckIn" class="btn btn-primary" style="width:100%" onclick="checkOut()" <?php
                                                if (!$logOut) {
                                                    echo "disabled";
                                                }
                                                ?>>Check Out</button>
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

<script>
                                            function checkOut() {
                                                var today = new Date();
                                                var time = today.getHours() + ":" + today.getMinutes();
                                                document.getElementById("checkout").value = time;
                                                document.getElementById("form").submit();
                                            }
</script>

