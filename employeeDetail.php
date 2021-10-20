<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE employee_id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
    } else {
        echo '<script>alert("Extract data error !\nContact IT department for maintainence");window.location.href = "admin_list.php";</script>';
    }
} else {
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == "save") {
        $sql = "UPDATE employee SET employee_name='" . $_POST['ename'] . "',image=null,leave_available='" . $_POST['leave'] . "',salary_amount='" . $_POST['salary'] . "',department_name='" . $_POST['department'] . "',"
                . "ic_no='" . $_POST['ic'] . "',email='" . $_POST['email'] . "',phone_no='" . $_POST['phone'] . "',address='" . $_POST['address'] . "',employee_type='" . $_POST['employee_type'] . "',birth_date='" . $_POST['bdate'] . "' WHERE employee_id='" . $current_data['employee_id'] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !");</script>';
        }
    } else {
        $sql = "DELETE FROM `employee` WHERE `employee_id`= '" . $current_data['employee_id'] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Delete Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Delete fail !");</script>';
        }
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Employee Details</title>
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
                        Employee Details
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="employeeMain.php">Employee Main</a></li>
                        <li class="active">Employee Details</li>
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
                                    <h3 class="box-title">Employee Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="col-md-12">
                                                    <img class="img-fluid mb-12" src="<?php
                                                    if (isset($current_data)) {
                                                        echo $current_data["img"];
                                                    }
                                                    ?>" alt="Photo" style="width: 100%;height:300px;padding-top: 10px" id="img_display" name="img_display">
                                                </div>
                                                <div class="col-md-12" >
                                                    <div class="form-group" style="padding-top: 15px">
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*" onchange="loadFile(event)" class="custom-file-input" id="img" name="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" class="form-control" name="eid" id="eid" placeholder="Employee ID" disabled value="<?php
                                                    echo $current_data["employee_id"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="Employee Name" readonly value="<?php
                                                    echo $current_data["employee_name"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>IC Number</label>
                                                    <input type="text" class="form-control" name="ic" id="ic" placeholder="Enter IC Number" readonly value="<?php
                                                    echo $current_data["ic_no"];
                                                    ?>">
                                                </div> 
                                                <div class="from-group">
                                                    <label>Birth Date</label>
                                                    <input type="date" class="form-control" name="bdate" id="bdate" placeholder="Enter Birthdate" readonly value="<?php
                                                    echo $current_data["birth_date"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Type</label>
                                                    <select type="select" class="form-control" name="employee_type" readonly value="<?php
                                                    echo $current_data["employee_type"];
                                                    ?>">
                                                        <option>Admin</option>
                                                        <option>Employee</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" readonly value="<?php
                                                    echo $current_data["email"];
                                                    ?>">
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select type="select" class="form-control" name="gender" id="gender" readonly value="<?php
                                                    echo $current_data["gender"];
                                                    ?>">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" readonly value="<?php
                                                    echo $current_data["phone_no"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Available</label>
                                                    <input type="text" class="form-control" name="leave" id="leave" placeholder="Enter Leave Available" readonly value="<?php
                                                    echo $current_data["leave_available"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Salary Amount</label>
                                                    <input type="text" class="form-control" name="salary" id="salary" placeholder="Enter Salary Amount" readonly value="<?php
                                                    echo $current_data["salary_amount"];
                                                    ?>">
                                                </div>
                                                <input type="text" class="form-control" name="submit_type" id="submit_type" placeholder="Enter Salary Amount" style="display:none">
                                                <div class="form-group">
                                                    <label>Department Name</label>
                                                    <select type="select" class="form-control" name="department" readonly>
                                                        <?php
                                                        $sql = "SELECT * FROM department";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<option value=" . $row["department_name"] . ">" . $row["department_name"] . "</option>";
                                                            }
                                                        } else {
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" type="textarea" name="address" id="address" rows="3" placeholder="Enter Address" readonly ><?php
                                                        echo $current_data["address"];
                                                        ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" id="btnmodify" name="btnmodify" class="btn btn-primary">Modify</button>
                                        <button type="submit" id="btnsave" name="action" class="btn btn-primary" value="save">Save</button>
                                        <button class="btn btn-primary" name="action" value="delete">Delete</button>
                                        <button class="btn btn-primary">Cancel</button>
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

        <script>var loadFile = function (event) {
                                                                    var image = document.getElementById('img_display');
                                                                    image.src = URL.createObjectURL(event.target.files[0]);
                                                                };
        </script>

        <script>

            $(document).ready(function () {

                $("form textarea[type=textarea]").prop("readonly", true);
                $("form input[type=text]").prop("readonly", true);
                $("form input[type=date]").prop("readonly", true);
                $("form select[type=select]").prop("readonly", true);

                $("#btnmodify").on("click", function () {

                    $("textarea[type=textarea]").removeAttr("readonly");
                    $("input[type=text]").removeAttr("readonly");
                    $("input[type=date]").removeAttr("readonly");
                    $("select[type=select]").removeAttr("readonly");
                })

                $("#btnsave").on("click", function () {

                    $("textarea[type=textarea]").prop("readonly", true);
                    $("input[type=text]").prop("readonly", true);
                    $("input[type=date]").prop("readonly", true);
                    $("select[type=select]").prop("readonly", true);
                })

            })

        </script>
    </body>
</html>