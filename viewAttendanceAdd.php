<?php
session_start();
include("db_connection.php");
$Array_account = array();
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_account, $row);
    }
}
echo '<script>var Array_account = ' . json_encode($Array_account) . ';</script>';

$sql = "SELECT attendance_id FROM attendance ORDER BY attendance_id DESC LIMIT 1";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO attendance(checkin_time, checkout_time, attendance_date, employee_id, employee_name, status) "
            . "VALUES ('" . $_POST['checkin'] . "','" . $_POST['checkout'] . "','" . $_POST['adate'] . "'"
            . ",'" . $_POST['eid'] . "','" . $_POST['ename'] . "','" . $_POST['status'] . "')";
    if ($conn->query($sql)) {
        echo '<script>alert("Create Attendance Successfully !");window.location.href = "viewAttendanceList.php";</script>';

    }else{
        echo '<script>alert("Create Attendance Fail !");window.location.href = "viewAttendanceList.php";</script>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Attendance</title>
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
        <?php
//        $attdate = date("d-m-y");
//        echo $attdate;
//        echo"<br>";
//        date_default_timezone_set("Malaysia");
//        $ctime = date("h:i:s A", time());
//        echo $ctime;
//        
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Attendance Add
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Attendance History</a></li>
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
                                    <h3 class="box-title">Create Attendance</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <select class="form-control" name="eid" id="eid" onchange="select_id_check_name()" onclick="select_id_check_name()">
                                                        <?php
                                                        $sql = "SELECT * FROM employee";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<option value=" . $row["employee_id"] . ">" . $row["employee_id"] . "</option>";
                                                            }
                                                        } else {
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="ename" id="ename" placeholder="" readOnly/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Check In Time</label>
                                                    <input type="time" min="00:00" max="24:00" class="form-control" name="checkin" id="checkin" placeholder="Check In Time"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Check Out Time</label>
                                                    <input type="time" min="00:00" max="24:00" class="form-control" name="checkout" id="checkout" placeholder="Check Out Time"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="On time">On time</option>
                                                        <option value="Late">Late</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Attendance Date</label>
                                                    <input type="date" class="form-control" name="adate" id="adate" placeholder="Attendance Date"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" class="btn btn-primary" onclick="add()">Submit</button>
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
            function select_id_check_name(){
                var i = 0;
                while (Array_account) {
                    if (Array_account[i][0].toString() === document.getElementById("eid").value) {
                        document.getElementById("ename").value = Array_account[i][1].toString();
                    }
                    i++;
                }
            }
            
            function add(){
                if(document.getElementById("checkin").value === "" || document.getElementById("checkout").value === "" || document.getElementById("adate").value === "" || document.getElementById("ename").value === "" ){
                    alert("Please fill up all the input !");
                }else{
                    document.getElementById("form").submit();
                }
            }
        </script>

    </body>
</html>