<?php
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    if ($type == "employee") {
        $sql = "SELECT * FROM `employee`";
        $title = "Employee Report";
    } else if ($type == "attendance") {
        $sql = "SELECT * FROM `attendance`";
        $title = "Attendance Report";
    } else if ($type == "leave") {
        $sql = "SELECT * FROM `leave`";
        $title = "Leave Report";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Report</title>
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
                        Report
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Report</a></li>
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
                                    <h3 class="box-title">Report</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post" id="form">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label style="padding-left: 10px">Report type : </label>
                                                <div class="form-group" style="padding-left: 10px">
                                                    <select class="custom-select" style="width:200px" name="type" id="type" onchange="changetype(this.value)">
                                                        <option value="employee" <?php
                                                        if (isset($type)) {
                                                            if ($type == "employee") {
                                                                echo "selected";
                                                            }
                                                        }
                                                        ?>>Employee</option>
                                                        <option value="attendance" <?php
                                                        if (isset($type)) {
                                                            if ($type == "attendance") {
                                                                echo "selected";
                                                            }
                                                        }
                                                        ?>>Attendance</option>
                                                        <option value="leave" <?php
                                                        if (isset($type)) {
                                                            if ($type == "leave") {
                                                                echo "selected";
                                                            }
                                                        }
                                                        ?>>Leave</option>
                                                    </select>
                                                    <div class="from-group">
                                                        <label>Start Date:</label>
                                                        <input type="date" class="form-control" name="sdate" onChange="update_day()" id="sdate" placeholder="Enter Start Date">
                                                    </div>
                                                    <div class="from-group">
                                                        <label>End Date:</label>
                                                        <input type="date" class="form-control" name="edate" onChange="update_day()" id="edate" placeholder="Enter End Date">
                                                    </div>
                                                    <button class="btn btn-primary" type="button" style="width:100px;padding-left: 10px" onclick="generate_report()">Generate</button>
                                                    &emsp;
                                                    <?php
                                                    if (isset($title)) {
                                                        echo '<button class="btn btn-success" type="button" style="width:200px" onclick="print()">Print report</button>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                </form>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->

                    </div>   <!-- /.row -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php
                                if (isset($title)) {
                                    echo $title;
                                }
                                ?></h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped projects" id="data">
                                <thead>
                                    <?php
                                    if (isset($type)) {
                                        if ($type == "employee") {
                                            echo '<tr>
                                        <th style="width: 10%;text-align: center">
                                            Employee ID
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Employee Name
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Position
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            IC Number
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Gender
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Employee Type
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Email
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Phone Number
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Department Name
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Salary Amount
                                        </th>
                                    </tr>';
                                        } else if ($type == "attendance") {
                                            echo '<tr>
                                        <th style="width: 10%;text-align: center">
                                            Employee ID
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Employee Name
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Check In Time
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Check Out Time
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                             Attendance Date
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                             Status
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                             Reason
                                        </th>
                                        <th style="width: 20%;text-align: center">
                                             Description
                                        </th>
                                         <th style="width: 10%;text-align: center">
                                             Overtime
                                        </th>
                                    </tr>';
                                        } else if ($type == "leave") {
                                            echo '<tr>
                                        <th style="width: 10%;text-align: center">
                                            Employee ID
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Employee Name
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Start Date
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            End Date
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Leave Day
                                        </th>
                                        <th style="width: 20%;text-align: center">
                                            Leave Description
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Leave Type
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Status
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            Approve By
                                        </th>
                                    </tr>';
                                        }
                                    }
                                    ?>

                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($type)) {
                                        if ($type == "employee") {
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_id"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_name"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["position"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["ic_no"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["gender"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_type"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["email"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["phone_no"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["department_name"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["salary_amount"] . "</a></td>"
                                                    . "</tr>";
                                                }
                                            }
                                        } else if ($type == "attendance") {
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_id"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_name"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["checkin_time"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["checkout_time"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["attendance_date"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["status"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["reason"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["description"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["overtime"] . "</a></td>"
                                                    . "</tr>";
                                                }
                                            }
                                        } else if ($type == "leave") {
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_id"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["employee_name"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["start_date"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["end_date"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["leave_day"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["leave_description"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["leave_type"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["leave_type"] . "</a></td>"
                                                    . "<td style='text-align: center'><a>" . $row["Approve_by"] . "</a></td>"
                                                    . "</tr>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <?php
                                    if (isset($type)) {
                                        if ($type == "employee") {
                                            echo '<tr><th style="width: 10%;text-align: center">' . $result->num_rows . '</th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        </tr>';
                                        } else if ($type == "attendance") {
                                            echo '<tr><th style="width: 10%;text-align: center">' . $result->num_rows . '</th>

                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 20%;text-align: center">
                                            
                                        </th>
                                        </tr>';
                                        } else if ($type == "leave") {
                                            echo '<tr><th style="width: 10%;text-align: center">' . $result->num_rows . '</th>

                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 20%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>
                                        <th style="width: 10%;text-align: center">
                                            
                                        </th>

                                        </tr>';
                                        }
                                    }
                                    ?>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
                                                        function generate_report() {
                                                            var fulfill = true;
                                                            var message = "";
                                                            if (document.getElementById("type").value === "") {
                                                                var dateformat = /^\d{2}\/\d{2}\/\d{4}$/;

                                                                if (!document.getElementById("datefrom") || document.getElementById("datefrom") === "") {
                                                                    fulfill = false;
                                                                    message += "Invalid date from!\n"
                                                                } else {
                                                                    if (!document.getElementById("datefrom").value.match(dateformat)) {
                                                                        fulfill = false;
                                                                        message += "Invalid date from!\n"
                                                                    }
                                                                }

                                                                if (!document.getElementById("dateto") || document.getElementById("dateto") === "") {
                                                                    fulfill = false;
                                                                    message += "Invalid date to!\n"
                                                                } else {
                                                                    if (!document.getElementById("dateto").value.match(dateformat)) {
                                                                        fulfill = false;
                                                                        message += "Invalid date to!\n"
                                                                    }
                                                                }

                                                                var datefrom = new Date(document.getElementById("datefrom").value);
                                                                var dateto = new Date(document.getElementById("dateto").value);


                                                                if (datefrom > dateto) {
                                                                    fulfill = false;
                                                                    message += "Date from cannot over than date to!\n"
                                                                }
                                                            }


                                                            if (fulfill) {
                                                                document.getElementById("form").submit();
                                                            } else {
                                                                alert(message);
                                                            }
                                                        }

                                                        function changetype(value) {
                                                            if (value === "leave") {
                                                                document.getElementById("datefrom").disabled = false;
                                                                document.getElementById("dateto").disabled = false;
                                                            } else {
                                                                document.getElementById("datefrom").disabled = true;
                                                                document.getElementById("dateto").disabled = true;
                                                                document.getElementById("datefrom").value = "";
                                                                document.getElementById("dateto").value = "";
                                                            }
                                                        }

                                                        function print() {
                                                            var divToPrint = document.getElementById("data");
                                                            newWin = window.open("");
                                                            newWin.document.write(divToPrint.outerHTML);
                                                            newWin.print();
                                                            newWin.close();
                                                        }
        </script>
    </body>
</html>

