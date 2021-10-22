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
    echo '<script>alert("No available data !")</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE `leave` SET `status`= '" . $_POST['status'] . "' WHERE leave_id = " . $_GET['id'] . "";
    if ($conn->query($sql)) {
        if ($_POST['status'] == "Approve") {
            $sql = "UPDATE `employee` SET `leave_available`=`leave_available` - " . $_POST['leave_day'] . " WHERE `employee_id` = '" . $_POST['eid'] . "'";
            $conn->query($sql);
        }else{
            $sql = "UPDATE `employee` SET `leave_available`=`leave_available` + " . $_POST['leave_day'] . " WHERE `employee_id` = '" . $_POST['eid'] . "'";
            $conn->query($sql);
        }
        echo '<script>alert("Submit successfully\n Back to home page !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Update fail !");window.location.href = "home.php";</script>';
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
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" class="btn btn-success btn-flat" onclick="update()"><i class="fa fa-check-square-o"></i> Update</button>
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
        function update(){
            if(document.getElementById("status").value === ""){
                    alert("Please fill up all the input !");
                }else{
                    document.getElementById("form").submit();
                }
            
        }
        
        </script>
    </body>
</html>