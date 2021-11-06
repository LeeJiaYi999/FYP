<?php
session_start();
include("db_connection.php");
$sql = "SELECT employee_id FROM employee ORDER BY employee_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['employee_id'], 1)) + 1;
        $newid = "E{$latestnum}";
        break;
    }
} else {
    $newid = "E101";
}

$e_array = array();
$sql = "SELECT `email` FROM `employee`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($e_array, $row);
    }
}
echo '<script>var e_array = ' . json_encode($e_array) . ';</script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $image = $_FILES["img"];
    if ($image) {
        $newimg = "image/{$_POST['eid']}";
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $newimg)) {
            echo '<script>console.log("ok")</script>';
        } else {
            echo '<script>console.log("no")</script>';
        }
//        move_uploaded_file($_FILES["img"]["tmp_name"], $newimg);
    } else {
        $newimg = null;
    }

    $sql = "INSERT INTO `employee`(`employee_id`, `employee_name`, `image`, `password`, `position`, `ic_no`, `gender`, `employee_type`, `email`, `birth_date`, `phone_no`, `address`, `department_name`, `salary_amount`, `Annual_Leave`, `Sick_Leave`, `Compassionate_Leave`, `Maternity Leave`, `Schedule_id`, `join_date`, `account_status`) "
            . "VALUES ('{$_POST['eid']}','{$_POST['ename']}','{$newimg}','{$_POST['password']}','{$_POST['position']}','{$_POST['ic']}','{$_POST['gender']}','{$_POST['etype']}','{$_POST['email']}','{$_POST['bdate']}','{$_POST['phone']}','{$_POST['address']}','{$_POST['dname']}','{$_POST['salary']}',{$_POST['annual_leave']},{$_POST['sick_leave']},{$_POST['compassionate_leave']},{$_POST['maternity_leave']},'{$_POST['sname']}','{$_SESSION['date']}','Active')";

    if ($conn->query($sql)) {
        echo '<script>alert("Create Successfully !");window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Create Fail !");</script>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Recruitment</title>
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
                        Recruitment
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Recruitment</a></li>
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
                                    <h3 class="box-title">Register New Employee</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post" id="form" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control" name="eid" id="eid" placeholder="Employee ID" value="<?php echo $newid ?>" readOnly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="ename" id="ename" placeholder="Enter Eployee Name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>IC Number/Passport</label>
                                                    <input type="text" class="form-control" name="ic" id="ic" placeholder="Enter IC Number">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender" id="gender" onchange="select_positionname_check()">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Employee Type</label>
                                                    <select class="form-control" name="etype">
                                                        <option value="Admin">Admin</option>
                                                        <option value="Employee">Employee</option>
                                                        <option value="Department Head">Department Head</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Schedule Name</label>
                                                    <select class="form-control" name="sname" id="sname" onchange="select_schedulename_check()">
                                                        <option value="">--Select--</option>
                                                        <?php
                                                        $sql = "SELECT * FROM schedule";
                                                        $result = $conn->query($sql);
                                                        $s_array = array();
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                array_push($s_array, $row);
                                                                echo "<option value=" . $row["Schedule_id"] . ">" . $row["status"] . "</option>";
                                                            }
                                                        } else {
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        echo '<script>var s_array = ' . json_encode($s_array) . ';</script>';
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Check In Time</label>
                                                            <input type="text" class="form-control" name="checkin" id="checkin" placeholder="Pending" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Check Out Time</label>
                                                            <input type="text" class="form-control" name="checkout" id="checkout" placeholder="Pending" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Position Name</label>
                                                    <select class="form-control" name="pname" id="pname" onchange="select_positionname_check()">
                                                        <option value="">--Select--</option>
                                                        <?php
                                                        $sql = "SELECT * FROM position";
                                                        $result = $conn->query($sql);
                                                        $p_array = array();
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<option value=" . $row["position_id"] . ">" . $row["position_name"] . "</option>";
                                                                array_push($p_array, $row);
                                                            }
                                                        } else {
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        echo '<script>var p_array = ' . json_encode($p_array) . ';</script>';
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="from-group">
                                                    <label>Birth Date</label>
                                                    <input type="date" class="form-control" name="bdate" id="bdate" placeholder="Enter Birthdate">
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                                                </div>
                                                <div class="form-group">
                                                    <label>Annual Leave Available</label>
                                                    <input type="text" class="form-control" name="annual_leave" id="annual_leave" placeholder="Pending" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sick Leave Available</label>
                                                    <input type="text" class="form-control" name="sick_leave" id="sick_leave" placeholder="Pending" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Compassionate Leave Available</label>
                                                    <input type="text" class="form-control" name="compassionate_leave" id="compassionate_leave" placeholder="Pending" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Maternity Leave Available</label>
                                                    <input type="text" class="form-control" name="maternity_leave" id="maternity_leave" placeholder="Pending" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Salary Amount (RM)</label>
                                                    <input type="number" class="form-control" name="salary" id="salary" placeholder="Enter Salary Amount">
                                                    <input type="text" class="form-control" name="position" id="position" style="display:none">
                                                </div>
                                                <div class="form-group">
                                                    <label>Department Name</label>
                                                    <select class="form-control" name="dname">
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
                                                    <textarea class="form-control" name="address" id="address" rows="5" placeholder="Enter Address"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="button" class="btn btn-primary" onclick="save()" id="btnsave" >Submit</button>
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
                                            var position = "";
                                            var loadFile = function (event) {
                                                var image = document.getElementById('img_display');
                                                image.src = URL.createObjectURL(event.target.files[0]);
                                            };
                                            function save() {
                                                var valid = true;
                                                var error = "";
                                                if (document.getElementById("ename").value === "") {
                                                    valid = false;
                                                    error += "Please enter Name !\n";
                                                }

                                                if (document.getElementById("password").value === "") {
                                                    valid = false;
                                                    error += "Please enter Password !\n";
                                                } else {
                                                    if (document.getElementById("password").value.length < 6) {
                                                        valid = false;
                                                        error += "Password is not strong recommend over 6 digit !\n";
                                                    }
                                                }

                                                if (document.getElementById("ic").value === "") {
                                                    valid = false;
                                                    error += "Please enter IC or Passport!\n";
                                                }

                                                if (document.getElementById("email").value === "") {
                                                    valid = false;
                                                    error += "Please enter Email !\n";
                                                } else {
                                                    var email = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/;
                                                    if (!document.getElementById("email").value.match(email)) {
                                                        valid = false;
                                                        error += "Invalid Email !\n";
                                                    } else {
                                                        for (i = 0; i < e_array.length; i++) {
                                                            if (e_array[i][0] === document.getElementById("email").value) {
                                                                valid = false;
                                                                error += "Email already registered!\n";
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }

                                                if (document.getElementById("pname").value === "") {
                                                    valid = false;
                                                    error += "Please select Position !\n";
                                                }

                                                if (document.getElementById("bdate").value === "") {
                                                    valid = false;
                                                    error += "Please enter Birth date !\n";
                                                }

                                                if (document.getElementById("phone").value === "") {
                                                    valid = false;
                                                    error += "Please enter Phone !\n";
                                                } else {
                                                    var phone_number = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
                                                    if (!document.getElementById("phone").value.match(phone_number)) {
                                                        valid = false;
                                                        error += "Invalid Phone !\n";
                                                    }
                                                }

                                                if (document.getElementById("salary").value === "") {
                                                    valid = false;
                                                    error += "Please enter Salary !\n";
                                                }
                                                
                                                if (document.getElementById("address").value === "") {
                                                    valid = false;
                                                    error += "Please enter Address !\n";
                                                }

                                                if (valid) {
                                                    if (confirm("Confirm to recruitment ?")) {
                                                        document.getElementById("position").value = position;
                                                        if (document.getElementById("gender").value === "Male") {
                                                            document.getElementById("maternity_leave").value = "0";
                                                        }
                                                        document.getElementById("form").submit();
                                                    }
                                                } else {
                                                    alert(error);
                                                }
                                            }

                                            function select_schedulename_check() {
                                                for (i = 0; i < s_array.length; i++) {
                                                    console.log(s_array[i][0]);
                                                    console.log(document.getElementById("sname").value);
                                                    if (s_array[i][0] === document.getElementById("sname").value) {
                                                        document.getElementById("checkin").value = s_array[i][1].toString();
                                                        document.getElementById("checkout").value = s_array[i][2].toString();
                                                        break;
                                                    } else {
                                                        document.getElementById("checkin").value = null;
                                                        document.getElementById("checkout").value = null;
                                                    }
                                                }
                                            }

                                            function select_positionname_check() {
                                                if (!document.getElementById("pname").value) {
                                                    document.getElementById("annual_leave").value = null;
                                                    document.getElementById("sick_leave").value = null;
                                                    document.getElementById("compassionate_leave").value = null;
                                                    document.getElementById("maternity_leave").value = null;
                                                } else {
                                                    for (i = 0; i < p_array.length; i++) {
                                                        console.log(p_array[i]);
                                                        if (p_array[i][0] === document.getElementById("pname").value) {
                                                            document.getElementById("annual_leave").value = p_array[i][2].toString();
                                                            document.getElementById("sick_leave").value = p_array[i][3].toString();
                                                            document.getElementById("compassionate_leave").value = p_array[i][4].toString();
                                                            if (document.getElementById("gender").value === "Male") {
                                                                document.getElementById("maternity_leave").value = "Not allow !";
                                                            } else {
                                                                document.getElementById("maternity_leave").value = p_array[i][5].toString();
                                                            }
                                                            position = p_array[i][1];
                                                            break;
                                                        }
                                                    }
                                                }

                                            }
        </script>
    </body>
</html>