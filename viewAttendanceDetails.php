<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM attendance WHERE attendance_id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
    } else {
        echo '<script>alert("Successfully!");window.location.href = "home.php";</script>';
    }
} else {
    echo '<script>alert("Fail!");window.location.href = "home.php";</script>';
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "UPDATE attendance SET checkin_time='" . $_POST['cin'] . "',checkout_time='" . $_POST['cout'] . "',status='" . $_POST['status'] . "',attendance_date='" . $_POST['adate'] . "' WHERE attendance_id='" . $current_data["attendance_id"] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !")</script>';
        }
    }
?>

<html>
    <body> 

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

        <?php include("sidebar.php"); ?>
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
                                <form method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control" name="eid" id="eid" value="<?php
                                                    echo $current_data["employee_id"];
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="ename" id="ename" value="<?php
                                                    echo $current_data["employee_name"];
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Check In Time</label>
                                                    <input type="time" class="form-control" name="cin" id="cin" value="<?php
                                                    echo $current_data["checkin_time"];
                                                    ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Check Out Time</label>
                                                    <input type="time" class="form-control" name="cout" id="cout" value="<?php
                                                    echo $current_data["checkout_time"];
                                                    ?>" disabled>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input type="text" class="form-control" name="status" id="status" value="<?php
                                                    echo $current_data["status"];
                                                    ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Attendance Date</label>
                                                    <input type="text" class="form-control" name="adate" id="adate" value="<?php
                                                    echo $current_data["attendance_date"];
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Reason</label>
                                                    <input type="text" class="form-control" name="reason" id="reason" value="<?php
                                                    echo $current_data["reason"];
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" class="form-control" name="description" id="description" value="<?php
                                                    echo $current_data["description"];
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group" style="text-align: center">
                                                    <label>Overtime Hours</label>
                                                    <input type="text" class="form-control" name="overtime" id="overtime" placeholder="Overtime" value="<?php        
                                                        echo $current_data["overtime"];
                                                    ?>" readOnly/>
                                                </div>

                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="text" class="form-control" name="type" id="type" style="display:none" value="update" readonly>
                                        <button type="button" class="btn btn-success btn-flat" id="btn_modify" onclick="modify()"><i class="fa fa-check-square-o"></i> Modify</button>
                                        <button type="button" class="btn btn-success btn-flat" id="btn_update" onclick="update()"><i class="fa fa-check-square-o"></i> Update</button>
                                        <button type="button" class="btn btn-default btn-flat pull-left" id="btn_cancel" onclick="location.href = 'viewAttendanceList.php'"><i class="fa fa-close"></i> Cancel</button>
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
                                            function modify() {
                                                document.getElementById("cin").disabled = false;
                                                document.getElementById("cout").disabled = false;
                                                document.getElementById("status").disabled = false;
                                            }

                                            function update() {
                                                if (document.getElementById("cin").value === "" || document.getElementById("cout").value === "" || document.getElementById("status").value === "") {
                                                    alert("Please fill in the blank !");
                                                } else {
                                                    document.getElementById("form").submit();
                                                }
                                            }


</script>