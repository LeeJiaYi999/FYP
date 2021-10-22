<?php
session_start();
include("db_connection.php");
$sql = "SELECT question_id FROM question ORDER BY question_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['question_id'], 1)) + 1;
        $newid = "Q{$latestnum}";
        break;
    }
} else {
    $newid = "Q1001";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO question(question_id, question_description, training_id, answer) "
            . "VALUES ('" . $_POST['question_id'] . "','" . $_POST['question_description'] . "','" . $_POST['training_id'] . "','" . $_POST['answer'] . "')";
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
        <title>Add Question</title>
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
                        Question
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="questionList.php">Question List</a></li>
                        <li class="active">Add New Question</li>
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
                                    <h3 class="box-title">Add New Question</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Training ID</label>
                                                    <select class="form-control" name="training_id" id="training_id">
                                                        <?php
                                                        $sql = "SELECT * FROM training";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<option value=" . $row["training_id"] . ">" . $row["training_id"] . "</option>";
                                                            }
                                                        } else {
                                                            echo '<script>alert("Invalid input !")</script>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Question ID</label>
                                                    <input type="text" class="form-control" name="question_id" id="question_id" placeholder="question id" value="<?php echo $newid ?>" readonly/>
                                                </div>                                         
                                                <div class="form-group">
                                                    <label>Question Description</label>
                                                    <textarea class="form-control" name="question_description" id="question_description" rows="3" placeholder="description" ></textarea>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Answer</label>
                                                    <textarea class="form-control" name="answer" id="answer" rows="3" placeholder="description" ></textarea>
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

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>