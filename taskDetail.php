<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM task WHERE task_id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
        $sql2 = "SELECT * FROM project WHERE project_id = '" . $current_data['project_id'] . "' LIMIT 1";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $project_data = $row2;
                break;
            }
        } else {
            echo '<script>alert("Extract data error !\nContact IT department for maintainence");";</script>';
        }
    } else {
        echo '<script>alert("Extract data error !\nContact IT department for maintainence");window.location.href = "admin_list.php";</script>';
    }
} else {
    
}

if ($_SESSION['User']["employee_type"] === "Admin") {
    echo '<script>var staff = false;</script>';
} else {
    echo '<script>var staff = true;</script>';
}

$Array_account = array();
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_account, $row);
    }
}
echo '<script>var Array_account = ' . json_encode($Array_account) . ';</script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == "save") {
        $sql = "UPDATE task SET task_title='" . $_POST['task_title'] . "',task_description='" . $_POST['task_description'] . "',due_date='" . $_POST['due_date'] . "',assign_date='" . $_POST['assign_date'] . "',employee_id='" . $_POST['employee_id'] . "',"
                . "progress='" . $_POST['progress'] . "' WHERE task_id='" . $current_data['task_id'] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !");</script>';
        }
    } else {
        $sql = "DELETE FROM `task` WHERE `task_id`= '" . $current_data['task_id'] . "'";
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
        <title>Update Task</title>
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
                        Task
                        <small>[Detail]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="taskList.php">Task List</a></li>
                        <li class="active">Update Task</li>
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
                                    <h3 class="box-title">Update Task</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Project ID</label>
                                                    <input type="text" class="form-control" name="project_id" id="project_id" placeholder="project id" disabled value="<?php
                                                    echo $current_data["project_id"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Title</label>
                                                    <input type="text" class="form-control" name="project_title" id="project_title" placeholder="project title" disabled value="<?php
                                                    echo $project_data["project_title"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Description</label>
                                                    <textarea class="form-control" name="project_description" id="project_description" rows="3" placeholder="Enter description" disabled ><?php
                                                        echo $project_data["project_description"];
                                                        ?></textarea>
                                                </div>
                                                <div class="row">   
                                                    <div class="col-md-3">
                                                        <label></label>
                                                        <h4>Staff assign:</h4>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Employee ID</label>
                                                            <select class="form-control" type="select" name="employee_id" id="employee_id" onchange="select_id_display_emp()" onclick="select_id_display_emp()" readonly value="<?php
                                                            echo $current_data["employee_id"];
                                                            ?>">
                                                                <option></option>
                                                                <?php
                                                                $sql = "SELECT * FROM employee";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        if ($current_data["employee_id"] == $row["employee_id"]) {
                                                                            echo "<option value=" . $row["employee_id"] . " selected>" . $row["employee_id"] . "</option>";
                                                                        } else {
                                                                            echo "<option value=" . $row["employee_id"] . ">" . $row["employee_id"] . "</option>";
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '<script>alert("Invalid input !")</script>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Employee Name</label>
                                                            <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="employee name" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="projectname">Task Progress</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" class="form-control" name="progress"  id="progress" placeholder="%" disabled value="<?php
                                                            echo $current_data["progress"];
                                                            ?>">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label><h4>%</h4></label>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Task ID</label>
                                                    <input type="text" class="form-control" name="task_id" id="task_id" placeholder="task id" disabled value="<?php
                                                    echo $current_data["task_id"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Task Title</label>
                                                    <input type="text" class="form-control" name="task_title" id="task_title" placeholder="task title" readonly value="<?php
                                                    echo $current_data["task_title"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Task Description</label>
                                                    <textarea type="textarea" class="form-control" name="task_description" id="task_description" rows="3" placeholder="description" readonly ><?php
                                                        echo $current_data["task_description"];
                                                        ?></textarea>
                                                </div>
                                                <div class="from-group">
                                                    <label>Assign Date</label>
                                                    <input type="date" class="form-control" name="assign_date" id="assign_date" placeholder="assign date" readonly value="<?php
                                                    echo $current_data["assign_date"];
                                                    ?>">
                                                </div>
                                                <div class="from-group">
                                                    <label>Due Date</label>
                                                    <input type="date" class="form-control" name="due_date" id="due_date" placeholder="due date" readonly value="<?php
                                                    echo $current_data["due_date"];
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" id="btnmodify" name="btnmodify" class="btn btn-primary">Modify</button>
                                        <button type="submit" id="btnsave" name="action" class="btn btn-primary" value="save">Save</button>
                                        <?php
                                        if ($_SESSION["User"]["employee_type"] === "Admin") {
                                            echo"
                                        <button class='btn btn-primary' name='action' value='delete'>Delete</button>";
                                        }
                                        ?>
                                        <button class="btn btn-primary">Cancel</button>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!--/.col (left) -->
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
                                                                        if (staff) {
                                                                            document.getElementById("progress").disabled = false;
                                                                        } else {
                                                                            document.getElementById("progress").disabled = false;
                                                                            $("textarea[type=textarea]").removeAttr("readonly");
                                                                            $("input[type=text]").removeAttr("readonly");
                                                                            $("input[type=date]").removeAttr("readonly");
                                                                            $("select[type=select]").removeAttr("readonly");
                                                                        }
                                                                    })

                                                                    $("#btnsave").on("click", function () {
                                                                        $("textarea[type=textarea]").prop("readonly", true);
                                                                        $("input[type=text]").prop("readonly", true);
                                                                        $("input[type=date]").prop("readonly", true);
                                                                        $("select[type=select]").prop("readonly", true);
//                                                                       
                                                                    })


                                                                })

                                                                function select_id_display_emp() {
                                                                    var x = 0;
                                                                    while (Array_account) {
                                                                        if (Array_account[x][0].toString() === document.getElementById("employee_id").value) {
                                                                            document.getElementById("employee_name").value = Array_account[x][1].toString();
                                                                        }
                                                                        x++;
                                                                    }
                                                                }
        </script>

    </body>
</html>