<?php
session_start();
include("db_connection.php");
$Array_project = array();
$sql = "SELECT * FROM project";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_project, $row);
    }
}
echo '<script>var Array_project = ' . json_encode($Array_project) . ';</script>';

$Array_account = array();
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_account, $row);
    }
}
echo '<script>var Array_account = ' . json_encode($Array_account) . ';</script>';

$sql = "SELECT task_id FROM task ORDER BY task_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['task_id'], 1)) + 1;
        $newid = "T{$latestnum}";
        break;
    }
} else {
    $newid = "T1001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO task(project_id, task_id, task_title, employee_id, task_description, due_date, assign_date) "
            . "VALUES ('" . $_POST['project_id'] . "','" . $_POST['task_id'] . "','" . $_POST['task_title'] . "','" . $_POST['employee_id'] . "','" . $_POST['task_description'] . "'"
            . ",'" . $_POST['due_date'] . "','" . $_SESSION["date"] . "')";
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
        <title>Add Task</title>
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
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="employeeMain.php">Task List Table</a></li>
                        <li class="active">Add New Task</li>
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
                                    <h3 class="box-title">Add New Task</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Project ID</label>
                                                    <select class="form-control" name="project_id" id="project_id" onchange="select_id_display_details()" onclick="select_id_display_details()" >
                                                        <?php
                                                        $sql = "SELECT * FROM project";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<option value=" . $row["project_id"] . ">" . $row["project_id"] . "</option>";
                                                            }
                                                        } else {
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Project Title</label>
                                                    <input type="text" class="form-control" name="project_title" id="project_title" placeholder="project title" readonly/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Description</label>
                                                    <textarea class="form-control" name="project_description"  id="project_description" rows="3" placeholder="project description" readonly></textarea>
                                                </div>                                           
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Task ID</label>
                                                    <input type="text" class="form-control" name ="task_id"  id ="task_id" placeholder="project id" value="<?php echo $newid ?>" readonly/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="taskname">Task Title</label>
                                                    <input type="text" class="form-control" name="task_title" id="task_title" placeholder="Enter task title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Task Description</label>
                                                    <textarea class="form-control" name="task_description" rows="3" placeholder="Enter description"></textarea>
                                                </div>

                                                <div class="row">   
                                                    <div class="col-md-3">
                                                        <label></label>
                                                        <h4>Staff assign:</h4>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Employee ID</label>
                                                            <select class="form-control" name="employee_id" id="employee_id" onchange="select_id_display_emp()" onclick="select_id_display_emp()">
                                                                <option></option>
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
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Employee Name</label>
                                                            <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="employee name" readonly/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="from-group">
                                                        <label>Due Date</label>
                                                        <input type="date" class="form-control" name="due_date" id="due_date" placeholder="due date">
                                                    </div>
                                                </div><!-- /.form group -->
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" onclick="add()" id="btnadd" >Add</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                        <!-- right column -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <script>
                                            function select_id_display_details() {
                                                var i = 0;
                                                while (Array_project) {
                                                    if (Array_project[i][0].toString() === document.getElementById("project_id").value) {
                                                        document.getElementById("project_title").value = Array_project[i][1].toString();
                                                        document.getElementById("project_description").value = Array_project[i][2].toString();
                                                    }
                                                    i++;
                                                }
                                            }

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


