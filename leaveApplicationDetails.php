<?php
session_start();
include("db_connection.php");

$sql = "SELECT * FROM `leave` WHERE leave_id = '" . $_GET['id'] . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $data = $row;
        break;
    }
} else {
    echo '<script>alert("Extract data error !")</script>';
    echo '<script>window.location.href = "leaveApplication.php";</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE `leave` SET `status`='{$_POST['status']}',`Approve_by`='{$_SESSION["User"]["employee_id"]}',`reason`='{$_POST['reason']}' WHERE `leave_id` = '{$data["leave_id"]}'";
    if ($conn->query($sql)) {
        if ($_POST['status'] == "Approve") {
            if ($_POST['leave_type'] == "Annual Leave") {
                $sql2 = "UPDATE `employee` SET `Annual_Leave` = `Annual_Leave` - {$_POST['leave_day']} WHERE `employee_id` = '{$_POST['eid']}'";
            } else if($_POST['leave_type'] == "Sick Leave"){
                $sql2 = "UPDATE `employee` SET `Sick_Leave` = `Sick_Leave` - {$_POST['leave_day']} WHERE `employee_id` = '{$_POST['eid']}'";
            } else if($_POST['leave_type'] == "Compassionate Leave"){
                $sql2 = "UPDATE `employee` SET `Compassionate_Leave` = `Compassionate_Leave` - {$_POST['leave_day']} WHERE `employee_id` = '{$_POST['eid']}'";
            }else{
                $sql2 = "UPDATE `employee` SET `Maternity Leave` = `Maternity Leave` - {$_POST['leave_day']} WHERE `employee_id` = '{$_POST['eid']}'";
            }
            
            if ($conn->query($sql2)) {
                echo '<script>alert("Approve successfully\n Back to home page !");window.location.href = "home.php";</script>';
            } else {
                echo '<script>alert("Update fail !");</script>';
            }
        } else {
            echo '<script>alert("Reject successfully\n Back to home page !");window.location.href = "home.php";</script>';
        }
    } else {
        echo '<script>alert("Update fail !");</script>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Leave Application Details</title>
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
                                    <h3 class="box-title">Leave Application Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control" name="eid" id="eid" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["employee_id"];
                                                    }
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="ename" id="ename" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["employee_name"];
                                                    }
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave reason</label>
                                                    <input type="text" class="form-control" name="Leave_reason" id="Leave_reason" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["leave_description"];
                                                    }
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Day</label>
                                                    <input type="text" class="form-control" name="leave_day" id="leave_day" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["leave_day"];
                                                    }
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="text" class="form-control" name="sdate" id="sdate" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["start_date"];
                                                    }
                                                    ?>" readonly>
                                                </div> 
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="text" class="form-control" name="edate" id="edate" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["end_date"];
                                                    }
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Type</label>
                                                    <input type="text" class="form-control" name="leave_type" id="leave_type" value="<?php
                                                    if (isset($data)) {
                                                        echo $data["leave_type"];
                                                    }
                                                    ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="Approve">Approve</option>
                                                        <option value="Reject">Reject</option>
                                                    </select>
                                                </div>

                                                <div class="form-group" id="reason_box">
                                                    <label>Reason</label>
                                                    <input type="text" class="form-control" name="reason" id="reason">
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" class="btn btn-success btn-flat" onclick="submitForm()"><i class="fa fa-check-square-o"></i> Submit</button>
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

        <script>
                                            function submitForm() {
                                                if (document.getElementById("reason").value === "") {
                                                    alert("Please provide reason when Approve or Reject");
                                                } else {
                                                    document.getElementById("form").submit();
                                                }
                                            }

        </script>
    </body>
</html>