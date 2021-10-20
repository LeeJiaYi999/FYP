<?php
session_start();
include("db_connection.php");
$sql = "SELECT training_id FROM training ORDER BY training_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['training_id'], 2)) + 1;
        $newid = "TR{$latestnum}";
        break;
    }
} else {
    $newid = "TR1001";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO training(training_id, training_description, department, question, answer) "
            . "VALUES ('" . $_POST['training_id'] . "','" . $_POST['training_description'] . "','" . $_POST['department'] . "','" . $_POST['question'] . "'"
            . ",'" . $_POST['answer'] . "')";
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
        <title>Add Training Sessions</title>
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
                        Training Sessions
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="trainingMain.php">Training Session List</a></li>
                        <li class="active">Training Sessions Add</li>
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
                                    <h3 class="box-title">Training Sessions</h3>
                                </div><!-- /.box-header -->
                                <form>
                                    <!--<form role="form">-->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Training ID</label>
                                                    <input type="text" class="form-control" name="training_id" id="training_id" placeholder="training id" readonly/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control">
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
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Training Description</label>
                                                    <textarea class="form-control" name="training_description" id="training_description" rows="3" placeholder="description" ></textarea>
                                                </div>    
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>1. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>2. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>3. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>4. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>5. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>6. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>7. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>8. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>9. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <div class="row">
                                            <div class="col-xs-1">
                                                <label>10. </label>
                                            </div>
                                            <div class="col-xs-11">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer"/>
                                        </div>
                                        &nbsp;

                                        <button type="submit" class="btn btn-primary" onclick="add()" id="btnadd" >Add</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>

