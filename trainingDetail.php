<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM training WHERE training_id = '$id' LIMIT 1";
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
        $sql = "UPDATE training SET department_name='" . $_POST['departmment'] . "',training_description='" . $_POST['training_description'] . "' WHERE training_id='" . $_SESSION["training_id"] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !");</script>';
        }
    } else {
        $sql = "DELETE FROM `training` WHERE `training_id`= '" . $current_data['training_id'] . "'";
        if ($conn->query($sql)) {
            $sql = "DELETE FROM `question` WHERE `training_id`= '" . $current_data['training_id'] . "'";
            if ($conn->query($sql)) {
                echo '<script>alert("Delete Successfully !");window.location.href = "home.php";</script>';
            } else {
                echo '<script>alert("Delete fail !");</script>';
            }
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
        <title>Update Training</title>
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
                        Training Session
                        <small>[Detail]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="employeeMain.php">Training List</a></li>
                        <li class="active">Update Training</li>
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
                                    <h3 class="box-title">Update Training</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Training ID</label>
                                                    <input type="text" class="form-control" name="training_id" id="training_id" placeholder="training id" disabled value="<?php
                                                    echo $current_data["training_id"];
                                                    ?>">
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Create Date</label>
                                                    <input type="date" class="form-control" name="create_date" id="create_date" placeholder="create_date" disabled value="<?php
                                                    echo $current_data["create_date"];
                                                    ?>">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control" type="select" name="department" readonly>
                                                        <?php
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
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Training Description</label>
                                                    <textarea class="form-control" type="textarea" name="training_description" id="training_description" rows="3" placeholder="description" readonly><?php
                                                        echo $current_data["training_description"];
                                                        ?></textarea>
                                                </div>    
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <?php
                                        if ($_SESSION["User"]["employee_type"] === "Admin") {
                                            echo'
                                        <button type="button" id="btnmodify" name="btnmodify" class="btn btn-primary">Modify</button>
                                        <button type="submit" id="btnsave" name="action" class="btn btn-primary" value="save">Save</button>
                                        <button class="btn btn-primary" name="action" value="delete">Delete</button>
                                        <button class="btn btn-primary">Cancel</button>';
                                        }
                                        ?>

                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                        <!-- right column -->
                    </div>   <!-- /.row -->
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