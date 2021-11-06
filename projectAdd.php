
<?php
session_start();
include("db_connection.php");
$sql = "SELECT project_id FROM project ORDER BY project_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['project_id'], 1)) + 1;
        $newid = "P{$latestnum}";
        break;
    }
} else {
    $newid = "P1001";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO project(project_id, department_name, project_title, project_description, due_date, assign_date) "
            . "VALUES ('" . $_POST['project_id'] . "','" . $_POST['department'] . "','" . $_POST['project_title'] . "','" . $_POST['project_description'] . "'"
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
        <title>Add Project</title>
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
                        Project
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="employeeMain.php">Project List Table</a></li>
                        <li class="active">Add New Project</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add New Project</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Project ID</label>
                                                    <input type="text" class="form-control" name="project_id" id="project_id" placeholder="project id" value="<?php echo $newid ?>" readonly/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control" name="department" id='department'>
                                                        <?php
                                                        if ($_SESSION["User"]["employee_type"] === "Admin") {
                                                            if ($current_data["department_name"] != "Cross Department") {
                                                                echo "<option value='Cross Department'>Cross Department</option>";
                                                            } else if ($current_data["department_name"] == "Cross Department") {
                                                                echo "<option value='Cross Department' selected>Cross Department</option>";
                                                            }

                                                            $sql = "SELECT * FROM department";
                                                            $result = $conn->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {
                                                                    if ($current_data["department_name"] == $row["department_name"]) {
                                                                        echo "<option value=" . $row["department_name"] . " selected>" . $row["department_name"] . "</option>";
                                                                    } else {
                                                                        echo "<option value=" . $row["department_name"] . ">" . $row["department_name"] . "</option>";
                                                                    }
                                                                }
                                                            } else {
                                                                echo '<script>alert("No available department!")</script>';
                                                            }
                                                            
                                                        } else {
                                                            echo "<option value=" . $_SESSION["User"]["department_name"] . ">" . $_SESSION["User"]["department_name"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>                                               
                                                <div class="form-group">
                                                    <label>Project Title</label>
                                                    <input type="text" class="form-control" name="project_title" id="project_title" placeholder="Enter project title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Project Description</label>
                                                    <textarea class="form-control" name="project_description" id="project_description" rows="3" placeholder="Enter description"></textarea>
                                                </div>
                                                <div class="from-group">
                                                    <label>Due Date</label>
                                                    <input type="date" class="form-control" name="due_date" id="due_date" placeholder="Enter due date">
                                                </div>
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

    </body>
</html>
