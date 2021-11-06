<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM project WHERE project_id = '$id' LIMIT 1";
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
    $sql = "INSERT INTO task(project_id, task_id, task_title, employee_id, task_description, due_date, assign_date, progress) "
            . "VALUES ('" . $_POST['project_id'] . "','" . $_POST['task_id'] . "','" . $_POST['task_title'] . "','" . $_POST['employee_id'] . "','" . $_POST['task_description'] . "'"
            . ",'" . $_POST['due_date'] . "','" . $_SESSION["date"] . "','0')";
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
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Project ID</label>
                                                        <input type="text" class="form-control" name="project_id" id="project_id" value="<?php
                                                        echo $current_data["project_id"];
                                                        ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Project Title</label>
                                                        <input type="text" class="form-control" name="project_title" id="project_title" placeholder="project title" readonly value="<?php
                                                        echo $current_data["project_title"];
                                                        ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Project Description</label>
                                                        <textarea class="form-control" name="project_description"  id="project_description" rows="3" placeholder="project description" readonly><?php
                                                            echo $current_data["project_description"];
                                                            ?></textarea>
                                                    </div> 

                                                    <h3>Staff assign:</h3>

                                                    <div class="row">   
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Employee ID</label>
                                                                <select class="form-control" name="employee_id" id="employee_id" onchange="select_id_display_emp()" onclick="select_id_display_emp()">
                                                                    <option></option>
                                                                    <?php
////                                                                
                                                                    if ($_SESSION["User"]["employee_type"] == "Admin") {
                                                                        if ($current_data["department_name"] == "Cross Department") {
                                                                            $sql = "SELECT * FROM employee";
                                                                        } else {
                                                                            $sql = "SELECT * FROM employee WHERE department_name = '" . $current_data["department_name"] . "'";
                                                                        }
                                                                    } else {
                                                                        $sql = "SELECT * FROM employee WHERE department_name = '" . $_SESSION["User"]["department_name"] . "'";
                                                                    }

                                                                    $result = $conn->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = mysqli_fetch_array($result)) {
                                                                            echo "<option value=" . $row["employee_id"] . ">" . $row["employee_id"] . "</option>";
                                                                        }
                                                                    } else {
                                                                        echo '<script>alert("No available employee!")</script>';
                                                                    }
////                                                               
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
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Department</label>
                                                                <input type="text" class="form-control" name="department_name" id="department_name" placeholder="department name" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Join Date</label>
                                                                <input type="date" class="form-control" name="join_date" id="join_date" placeholder="join date" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Professional Level</label>
                                                                <input type="text" class="form-control" name="professional_level" id="professional_level" placeholder="professional level" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4"></div>
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
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Task Difficulty</label>
                                                                <select class="form-control" name="difficulty" id="difficulty">
                                                                    <option>Easy</option>
                                                                    <option>Moderate</option>
                                                                    <option>Difficult</option>
                                                                </select>
                                                            </div> 
                                                        </div> 
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <div class="from-group">
                                                                    <label>Due Date</label>
                                                                    <input type="date" class="form-control" name="due_date" id="due_date" placeholder="due date">
                                                                </div>
                                                            </div><!-- /.form group -->
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" onclick="add()" id="btnadd" >Add</button>
                                    </div>
                            </div><!-- /.box -->
                            </form>
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
                                                var currentTime = new Date()
                                                var currentYear = currentTime.getFullYear();
                                                while (Array_account) {
                                                    if (Array_account[x][0].toString() === document.getElementById("employee_id").value) {
                                                        var joinDate = Array_account[x][20].toString();
//                                                        var joinYear = joinDate.getFullYear();
                                                        document.getElementById("employee_name").value = Array_account[x][1].toString();
                                                        document.getElementById("department_name").value = Array_account[x][12].toString();
                                                        document.getElementById("join_date").value = joinDate;         //[Need to put join date]
                                                        
//                                                        if (joinYear - currentYear) >= 5) {  //[Need to put join date (the correct array place)]
//                                                            document.getElementById("professional_level").value = "Expert";
//                                                        } else if ((Date.getFullYear(Array_account[x][20].toString()) - currentYear) >= 2 && (Date.getFullYear(Array_account[x][20].toString()) - currentYear) < 5) {
//                                                            document.getElementById("professional_level").value = "Senior";
//                                                        } else {
//                                                            document.getElementById("professional_level").value = "Freshman";
//                                                        }
                                                    }
                                                    x++;
                                                }
                                            }
//                                                
        </script>

    </body>
</html>


