<?php
session_start();
include("db_connection.php");
$sql = "SELECT announcement_id FROM announcement ORDER BY announcement_id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $latestnum = ((int) substr($row['announcement_id'], 1)) + 1;
        $newid = "A{$latestnum}";
        break;
    }
} else {
    $newid = "A10001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO announcement(announcement_id, announcement_description, post_date) VALUES ('" . $_POST['announcement_id'] . "','" . $_POST['announcement_description'] . "','" . $_SESSION["date"] . "')";

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
                        Announcement
                        <small>[Add]</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="employeeMain.php">Announcement List</a></li>
                        <li class="active">Add New Announcement</li>
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
                                    <h3 class="box-title">Add New Announcement</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Announcement ID</label>
                                                    <input type="text" class="form-control" name="announcement_id" id="announcement_id" placeholder="announcement ID" value="<?php echo $newid ?>" readOnly>
                                                </div>                                           
                                                <div class="form-group">
                                                    <label>Announcement Description</label>
                                                    <textarea class="form-control" name="announcement_description" rows="3" placeholder="Enter description"></textarea>
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


