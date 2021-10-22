<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM announcement WHERE announcement_id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
    } else {
        echo '<script>alert("Extract data error !\nContact management for maintainence");window.location.href = "admin_list.php";</script>';
    }
} else {
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == "save") {
        $sql = "UPDATE announcement SET announcement_description='" . $_POST['announcement_description'] . "' WHERE announcement_id='" . $current_data['announcement_id'] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !");</script>';
        }
    } else {
        $sql = "DELETE FROM `announcement` WHERE `announcement_id`= '" . $current_data['announcement_id'] . "'";
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
        <title>Announcement Details</title>
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
                        Announcement Details
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="taskList.php">Announcement List</a></li>
                        <li class="active">Announcement Details</li>
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
                                    <h3 class="box-title">Announcement</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <label>Announcement ID</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"  name="announcement_id" id="announcement_id" placeholder="ID" readonly value="<?php
                                                    echo $current_data["announcement_id"];
                                                    ?>">
                                                </div>  
                                                <div class="col-md-1">
                                                    <label>Post Date</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="post_date" id="post_date" placeholder="Date" readonly value="<?php
                                                    echo $current_data["post_date"];
                                                    ?>">
                                                </div>  
                                            </div>

                                        </div>
                                        &nbsp;
                                        <div class="form-group">
                                            <label>Announcement Description</label>
                                            <textarea class="form-control" type="textarea" name="announcement_description" id="announcement_description" rows="3" placeholder="Enter description" readonly><?php
                                                echo $current_data["announcement_description"];
                                                ?></textarea>
                                        </div>

                                    </div>
                                    <?php
                                    if ($_SESSION["User"]["employee_type"] === "Admin") {
                                        echo"
                                    <div class = 'box-footer'>
                                    <button type = 'button' id = 'btnmodify' name = 'btnmodify' class = 'btn btn-primary'>Modify</button>
                                    <button type = 'submit' id = 'btnsave' name = 'action' class = 'btn btn-primary' value = 'save'>Save</button>
                                    <button class = 'btn btn-primary' name = 'action' value = 'delete'>Delete</button>
                                    <button class = 'btn btn-primary'>Cancel</button>
                                    </div>";
                                    }
                                    ?>
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

                    $("textarea[type=textarea]").removeAttr("readonly");
                })

                $("#btnsave").on("click", function () {

                    $("textarea[type=textarea]").prop("readonly", true);
                })
            })
        </script>
    </body>
</html>


