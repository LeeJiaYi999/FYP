<?php
session_start();
include("db_connection.php");

$empId = $_SESSION["User"]["employee_id"];
$trainId = $_GET['id'];
$sql = "SELECT answer_id FROM answer WHERE employee_id= '$empId' AND training_id= '$trainId'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<script>alert("You have done this training before!\nEach person could only participate once.");window.location.href = "home.php";</script>';
} else {
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
}

$correct_amount = 0;
echo '<script>var correct_amount = ' . json_encode($correct_amount) . ';</script>';

$sql = "SELECT answer_id FROM answer ORDER BY answer_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['answer_id'], 2)) + 1;
        $newid = "AN{$latestnum}";
        break;
    }
} else {
    $newid = "AN1001";
}

$Array_question = array();
$sql = "SELECT * FROM question WHERE training_id= '$trainId'";
$Result = $conn->query($sql);
if ($Result->num_rows > 0) {
    while ($row = mysqli_fetch_array($Result)) {
        array_push($Array_question, $row);
    }
}
echo '<script>var Array_question = ' . json_encode($Array_question) . ';</script>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO answer(answer_id, employee_id, training_id, correct_amount) "
            . "VALUES ('" . $newid . "','" . $_SESSION["User"]["employee_id"] . "','" . $_POST['training_id'] . "','" . $_POST['correct_amount'] . "')";
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
        <title>Training Question Form</title>
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
                        Training Question
                        <small>[Form]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Training Question Form</li>
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
                                    <h3 class="box-title">Training Question</h3>
                                </div><!-- /.box-header -->
                                <form>
                                    <!--<form role="form">-->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Training ID</label>
                                                    <input type="text" class="form-control" name="training_id" id="training_id" placeholder="training id" readonly value="<?php
                                                    echo $current_data["training_id"];
                                                    ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control" name="department_name" id="department_name" placeholder="department_name" disabled value="<?php
                                                    echo $current_data["department_name"];
                                                    ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Training Description</label>
                                                    <textarea class="form-control" name="training_description" id="training_description" rows="3" placeholder="description" readonly><?php
                                                        echo $current_data["training_description"];
                                                        ?></textarea>
                                                </div>    
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <?php
                                        $i = 0;
                                        foreach ($Array_question as $x) {
                                            echo'
                                                <label>' . $i + 1 . '.' . $x[1] . '</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="' . $x[3] . '" placeholder="Enter your answer"/>
                                                </div>
                                                &nbsp;
                                            ';
                                            $i = $i + 1;
                                        }
                                        ?>


                                        <button type="button" class="btn btn-primary" onclick="check_ans()" id="btnadd" >Add</button>
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

        <script>
                                            function check_ans() {
                                                var correct_answer = 0;
                                                for (i = 0; i < Array_question.length; i++) {
                                                    if (Array_question[i][3] === document.getElementById(Array_question[i][3]).value) {
                                                        correct_answer++;
                                                    }
                                                }
                                                correct_amount = correct_answer / i *100;
                                                alert("Total correct answer =" + correct_answer + " (" + correct_amount + "%)");
                                            }

        </script>
    </body>
</html>

