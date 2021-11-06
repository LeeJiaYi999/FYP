<?php
session_start();
include("db_connection.php");
$sql = "SELECT claim_id FROM claim ORDER BY claim_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['claim_id'], 1)) + 1;
        $newid = "C{$latestnum}";
        break;
    }
} else {
    $newid = "C20001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO claim(claim_id, claim_description, claim_amount, document, employee_id, claim_date, status) VALUES ('" . $_POST['claim_id'] . "','" . $_POST['claim_description'] . "','" . $_POST['claim_amount'] . "', null ,'" . $_SESSION["User"]["employee_id"] . "','" . $_SESSION["date"] . "','Pending')";

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
        <title>Claim Expenses</title>
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
                        Expenses
                        <small>[Claim]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Claim Expenses</li>
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
                                    <h3 class="box-title">Claim Expenses</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Claim ID</label>
                                                    <input type="text" class="form-control" name="claim_id" id="claim_id" placeholder="Claim ID" value="<?php echo $newid ?>" readOnly>
                                                </div>       
                                                <label>Claim Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">RM</span>
                                                    <input type="text" name="claim_amount" id="claim_amount" class="form-control">
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label>Claim Description</label>
                                                    <textarea class="form-control" name="claim_description" rows="3" placeholder="Enter description"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="proof">Proof Document</label>
                                                    <input type="file" name="document" id="document">
                                                    <p class="help-block">Upload the relevant document here.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" onclick="add()" id="btnadd" >Submit</button>
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
