<?php
session_start();
include("db_connection.php");

$sql = "SELECT * FROM attendance WHERE employee_id = '" . $_SESSION["User"]["employee_id"] . "' AND attendance_date = '" . $_SESSION["date"] . "' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<script>var checkInIs = true;</script>';
        $data = $row;
        break;
    }
} else {
    $sql = "SELECT e.`employee_id`, s.* FROM `employee` e, `schedule` s WHERE e.`Schedule_id` = s.`Schedule_id` AND `employee_id` = '" . $_SESSION["User"]["employee_id"] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo '<script>var checkInIs = false;</script>';
            echo '<script>var checkInTime = ' . json_encode($row["checkin_time"]) . ';</script>';
            break;
        }
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO `attendance`(`checkin_time`, `attendance_date`, `employee_id`, `employee_name`, `status`, `reason`) VALUES ('" . $_POST['checkin'] . "','" . $_POST['adate'] . "','" . $_SESSION["User"]["employee_id"] . "','" . $_SESSION["User"]["employee_name"] . "','" . $_POST["status"] . "','" . $_POST["reason"] . "')";
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
    <body onload="load_form()">
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
                                        <h3 class="box-title" <?php
                                        if (isset($data)) {
                                            echo "style='color:red'";
                                        }
                                        ?>>Check In Attendance Form <?php
                                                if (isset($data)) {
                                                    echo "( You have already Check In today)";
                                                }
                                                ?></h3>
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

                                                    <div class="form-group"  style="text-align: center" id="reason_box" <?php if (isset($data)) {
                                                            if($data["status"] === "Late"){
                                                                echo "style='display:block'";
                                                            }else{
                                                                echo "style='display:none'";
                                                            }
                                                        }?>>
                                                        <label style="color:red">Reason</label>
                                                        <input   type="text" class="form-control" name="reason" id="reason" value="<?php
                                                        if (isset($data)) {
                                                            echo $data["reason"];
                                                        }
                                                        ?>" <?php if (isset($data)) {
                                                            echo "readonly";
                                                        }?> placeholder="Provide reason"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="button" id="btn_CheckIn" class="btn btn-primary" style="width:100%" onclick="checkIn()" <?php
                                                    if (isset($data)) {
                                                        echo "disabled";
                                                    }
                                                    ?>>Check In</button>
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
                                                var setCurrentHour = 0;
                                                var setCurrentMin = 0;
                                                function load_form() {
                                                    if (!checkInIs) {
                                                        var today = new Date();
                                                        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                                                        var time = today.getHours() + ":" + today.getMinutes();
                                                        var checkInHour = parseInt(checkInTime.substring(0, 2));
                                                        var checkInMin = parseInt(checkInTime.substring(3, 5));

                                                        setCurrentHour = today.getHours();
                                                        setCurrentMin = today.getMinutes();
                                                        if (today.getHours() > checkInHour) {
                                                            document.getElementById("status").value = "Late";
                                                        } else if (today.getHours() === checkInHour && today.getMinutes() > checkInMin) {
                                                            document.getElementById("status").value = "Late";
                                                        } else {
                                                            document.getElementById("status").value = "On time";
                                                        }
                                                        document.getElementById("adate").value = date;
                                                        document.getElementById("checkin").value = time;
                                                        if (document.getElementById("status").value === "Late") {
                                                            document.getElementById("reason_box").style.display = "block";
                                                        } else {
                                                            document.getElementById("reason_box").style.display = "none";
                                                        }
                                                    }else{
                                                        if (lateOntime) {
                                                            document.getElementById("reason_box").style.display = "block";
                                                            document.getElementById("reason").readonly = true;
                                                        } else {
                                                            document.getElementById("reason_box").style.display = "none";
                                                        }
                                                    }
                                                }

                                                function checkIn() {
                                                    var today = new Date();
                                                    if (setCurrentHour < today.getHours()) {
                                                        alert("Reload the form ...");
                                                        location.reload();
                                                    } else {
                                                        if ((today.getMinutes() - setCurrentMin) > 2) {
                                                            alert("Reload the form ...");
                                                            location.reload();
                                                        } else {
                                                            if (document.getElementById("status").value === "Late") {
                                                                if (document.getElementById("reason").value === "") {
                                                                    alert("Please provide reason for late !");
                                                                } else {
                                                                    document.getElementById("form").submit();
                                                                }
                                                            } else {
                                                                document.getElementById("form").submit();
                                                            }
                                                        }
                                                    }
                                                }
</script>
