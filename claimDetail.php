<?php
session_start();
include("db_connection.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM claim WHERE claim_id = '$id' LIMIT 1";
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
        $sql = "UPDATE claim SET claim_description='" . $_POST['claim_description'] . "',claim_amount='" . $_POST['claim_amount'] . "',status='" . $_POST['status'] . "',document='" . $_POST['document'] . "' WHERE claim_id='" . $current_data['claim_id'] . "'";
        if ($conn->query($sql)) {
            echo '<script>alert("Update Successfully !");window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Update fail !");</script>';
        }
    } else {
        $sql = "DELETE FROM `claim` WHERE `claim_id`= '" . $current_data['claim_id'] . "'";
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
        <title>Claim Detail</title>
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
                        Expenses Claim
                        <small>[Modify&Delete]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Expenses Claim Details</li>
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
                                    <h3 class="box-title">Expenses Claim Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Claim ID</label>
                                                            <input type="text" class="form-control" name="claim_id" id="claim_id" placeholder="Claim ID" disabled value="<?php
                                                            echo $current_data["claim_id"];
                                                            ?>">
                                                        </div>  
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Employee ID</label>
                                                            <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Employee ID" disabled value="<?php
                                                            echo $current_data["employee_id"];
                                                            ?>">
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label>Claim Description</label>
                                                            <textarea class="form-control" type="textarea" name="claim_description" rows="3" placeholder="Enter description" readonly><?php
                                                                echo $current_data["claim_description"];
                                                                ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="from-group">
                                                            <label>Claim Date</label>
                                                            <input type="date" class="form-control" name="claim_date" id="claim_date" placeholder="claim date" disabled value="<?php
                                                            echo $current_data["claim_date"];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Claim Amount</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">RM</span>
                                                            <input type="text" name="claim_amount" id="claim_amount" class="form-control" disabled value="<?php
                                                            echo $current_data["claim_amount"];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" type="select" name="status" readonly>
                                                                <?php
                                                                $sql = "SELECT * FROM claim WHERE claim_id = '$id' LIMIT 1";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        echo "<option value=" . $row["status"] . " selected>" . $row["status"] . "</option>";
                                                                        echo "<option>Approve</option>";
                                                                        echo "<option>Reject</option>";
                                                                    }
                                                                } else {
                                                                    echo '<script>alert("Invalid input !")</script>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="document">Proof Document</label>
                                                    <input type="file" name="document" id="document">
                                                    <p class="help-block">Upload the relevant document here.</p>
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
//                                                                       
                })


            })
        </script>
    </body>
</html>