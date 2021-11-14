<?php
session_start();
include("db_connection.php");

$sql = "SELECT * FROM employee WHERE employee_id = '" . $_SESSION['User']["employee_id"] . "' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<script>var Annual_Leave = ' . json_encode($row["Annual_Leave"]) . ';</script>';
        echo '<script>var Sick_Leave = ' . json_encode($row["Sick_Leave"]) . ';</script>';
        echo '<script>var Compassionate_Leave = ' . json_encode($row["Compassionate_Leave"]) . ';</script>';
        echo '<script>var Maternity_Leave = ' . json_encode($row["Maternity Leave"]) . ';</script>';
        $current_data = $row;
        break;
    }
} else {
    echo '<script>var available_Leave = ' . json_encode($_SESSION['User']["leave_available"]) . ';</script>';
    echo '<script>var sick_leave = ' . json_encode($_SESSION['User']["sick_leave"]) . ';</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO `leave`(leave_day, start_date, end_date, leave_description, employee_id, leave_type ,employee_name ,status) VALUES ('" . $_POST['lday'] . "','" . $_POST['sdate'] . "','" . $_POST['edate'] . "','" . $_POST['ldescription'] . "','" . $_SESSION["User"]["employee_id"] . "','" . $_POST['leave_type'] . "','" . $_SESSION["User"]["employee_name"] . "','Pending')";
    if ($conn->query($sql)) {
        echo '<script>alert("Waiting admin response !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Apply Leave Fail !");window.location.href = "home.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Apply Leave</title>
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
                        Apply Leave
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="applyLeave.php">Apply Leave</a></li>
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
                                    <h3 class="box-title">Apply Leave Form</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>Annual leave left : <?php echo $current_data["Annual_Leave"] ?>  Sick leave left : <?php echo $current_data["Sick_Leave"] ?>  Compassionate Leave left : <?php echo $current_data["Compassionate_Leave"] ?>  <?php
                                                    if ($current_data["gender"] == "Female") {
                                                        echo "Maternity Leave left : {$current_data["Maternity Leave"]}";
                                                    }
                                                    ?></h4>
                                                <div class="form-group">
                                                    <label>Leave Description</label>
                                                    <input type="text" class="form-control" name="ldescription" id="ldescription" placeholder="Enter Leave Description">
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Type</label>
                                                    <select class="form-control" id="leave_type" name="leave_type">
                                                        <option value="">--Select--</option>
                                                        <option value="Annual Leave">Annual Leave</option>
                                                        <option value="Sick Leave">Sick Leave</option>
                                                        <option value="Compassionate Leave">Compassionate Leave</option>
                                                        <?php
                                                        if ($current_data["gender"] == "Female") {
                                                            echo "<option value='Maternity Leave'>Maternity Leave</option>";
                                                        }
                                                        ?>
                                                        <option value="Unpaid Leave">Unpaid Leave</option>
                                                    </select>
                                                </div>
                                                <div class="from-group">
                                                    <label>Start Date:</label>
                                                    <input type="date" class="form-control" name="sdate" onChange="update_day()" id="sdate" placeholder="Enter Start Date">
                                                </div>
                                                <div class="from-group">
                                                    <label>End Date:</label>
                                                    <input type="date" class="form-control" name="edate" onChange="update_day()" id="edate" placeholder="Enter End Date">
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Day</label>
                                                    <input type="text" class="form-control" name="lday" id="lday" placeholder="Leave Day" readOnly>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" onclick="apply()" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->

                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <!--            <footer class="main-footer">
                            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                            All rights reserved.
                            <div class="float-right d-none d-sm-inline-block">
                                <b>Version</b> 3.0.0
                            </div>
                        </footer>-->

        </div>


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <script>
                                            var confirm_date = 0;
                                            function update_day() {
                                                var today = new Date();
                                                var sdate = new Date(document.getElementById("sdate").value);
                                                var edate = new Date(document.getElementById("edate").value);
                                                var diffTime = Math.abs(edate - sdate) + 1;
                                                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                                if (document.getElementById("sdate").value !== "" && document.getElementById("edate").value !== "") {
                                                    if (sdate <= edate) {
                                                        if (diffDays) {
                                                            document.getElementById("lday").value = diffDays;
                                                            confirm_date = diffDays;
                                                        }
                                                    } else {
                                                        alert("End date must larger than start date !");
                                                        document.getElementById("edate").value = "";
                                                    }
                                                } else if (today.getDate() > sdate.getDate()) {
                                                    alert("Start date must be exceed today !");
                                                    document.getElementById("sdate").value = "";
                                                }
                                            }

                                            function apply() {
                                                var valid = true;
                                                var error = "";
                                                if (document.getElementById("leave_type").value === "") {
                                                    error += "Please select a leave type !\n";
                                                    valid = false;
                                                } else {
                                                    if (document.getElementById("leave_type").value === "Annual Leave") {
                                                        if (confirm_date > Annual_Leave) {
                                                            error += "You doent have the extra annual leave !\n";
                                                            valid = false;
                                                        }
                                                    } else if (document.getElementById("leave_type").value === "Sick Leave") {
                                                        if (confirm_date > Sick_Leave) {
                                                            error += "You doent have the extra sick leave !\n";
                                                            valid = false;
                                                        }
                                                    } else if (document.getElementById("leave_type").value === "Compassionate Leave") {
                                                        if (confirm_date > Compassionate_Leave) {
                                                            error += "You doent have the extra sick leave !\n";
                                                            valid = false;
                                                        }
                                                    } else if (document.getElementById("leave_type").value === "Maternity Leave") {
                                                        if (confirm_date > Maternity_Leave) {
                                                            error += "You doent have the extra sick leave !\n";
                                                            valid = false;
                                                        }
                                                    }
                                                }

                                                if (document.getElementById("sdate").value === "" || document.getElementById("edate").value === "") {
                                                    error += "Please select the date for start date and end date !\n";
                                                    valid = false;
                                                }

                                                if (document.getElementById("ldescription").value === "") {
                                                    error += "Please provide descrition for the leave !\n";
                                                    valid = false;
                                                }

                                                if (valid) {
                                                    if (confirm("Are you sure u want to submit this application ?")) {
                                                        document.getElementById("form").submit();
                                                    }
                                                } else {
                                                    alert(error);
                                                }
                                            }

        </script>
    </body>
</html>

