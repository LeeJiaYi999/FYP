<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM schedule WHERE Schedule_id  = '$id' LIMIT 1";
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "UPDATE schedule SET checkin_time = '" . $_POST['checkin'] . "',checkout_time = '" . $_POST['checkout'] . "',status = '" . $_POST['schedule_name'] . "' WHERE Schedule_id ='" . $current_data['Schedule_id'] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !");</script>';
        }
}
?>

<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Schedule Details</title>
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
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Schedule Details</li>
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
                                    <h3 class="box-title">Schedule Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Schedule ID</label>
                                                    <input type="text" class="form-control" name="schedule_id" id="schedule_id" placeholder="Position id" disabled value="<?php
                                                    echo $current_data["Schedule_id"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Schedule Name</label>
                                                    <input type="text" class="form-control" name="schedule_name" id="schedule_name" placeholder="Enter Schedule Name" required readonly value="<?php
                                                    echo $current_data["status"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Check In Time</label>
                                                    <input type="time" min="00:00" max="24:00" class="form-control" name="checkin" id="checkin" placeholder="Check In Time" required readonly value="<?php
                                                    echo $current_data["checkin_time"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Check Out Time</label>
                                                    <input type="time" min="00:00" max="24:00" class="form-control" name="checkout" id="checkout" placeholder="Check Out Time" required readonly value="<?php
                                                    echo $current_data["checkout_time"];
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="button" id="btnmodify" name="btnmodify" class="btn btn-primary">Modify</button>
                                        <button type="button" id="btnsave" name="action"  onclick="save()" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-default btn-flat pull-left" id="btn_cancel" onclick="location.href = 'scheduleList.php'"><i class="fa fa-close"></i> Cancel</button>
                                    </div>
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
                    $("input[type=time]").removeAttr("readonly");
                })

                $("#btnsave").on("click", function () {

                    $("textarea[type=textarea]").prop("readonly", true);
                    $("input[type=text]").prop("readonly", true);
                    $("input[type=date]").prop("readonly", true);
                    $("select[type=select]").prop("readonly", true);
                    $("input[type=time]").prop("readonly", true);
                })


            })
            
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