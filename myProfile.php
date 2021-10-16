<?php
session_start();
include("db_connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "UPDATE employee SET employee_name='".$_POST['ename']."',image=null,password='".$_POST['password']."',"
            . "ic_no='".$_POST['ic']."',email='".$_POST['email']."',phone_no='".$_POST['phone']."',address='".$_POST['address']."' WHERE employee_id='".$_SESSION["User"]["employee_id"]."'";
    if($conn->query($sql)){
        header("location: home.php");
        
    }else{
        echo '<script>alert("Update fail !\nContact IT department for maintainence");'
        . 'var currentURL = window.location.href;window.location.href = currentURL;</script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Profile</title>
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
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">My Profile</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <img class="img-fluid mb-12" src="<?php
                                                    if (isset($current_data)) {
                                                        echo $current_data["img"];
                                                    }
                                                    ?>" alt="Photo" style="width: 100%;height:300px;padding-top: 10px" id="img_display" name="img_display">
                                                </div>
                                                <div class="col-md-12" >
                                                    <div class="form-group" style="padding-top: 15px">
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*" onchange="loadFile(event)" class="custom-file-input" id="img" name="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" class="form-control" name="ename" id="ename" placeholder="Enter Eployee Name" required="required" 
                                                           value="<?php
                                                    echo $_SESSION["User"]["employee_name"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="password" id="lname" placeholder="Enter Password" required="required" 
                                                           value="<?php
                                                    echo $_SESSION["User"]["password"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>IC Number</label>
                                                    <input type="text" class="form-control" name="ic" id="ic" placeholder="Enter IC Number" required="required" 
                                                           value="<?php
                                                    echo $_SESSION["User"]["ic_no"];
                                                    ?>">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required="required" 
                                                           value="<?php
                                                    echo $_SESSION["User"]["email"];
                                                    ?>">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required="required" 
                                                           value="<?php
                                                    echo $_SESSION["User"]["phone_no"];
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter Address" required="required"><?php
                                                        echo $_SESSION["User"]["address"];
                                                        ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                        <!-- right column -->

                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>

</body>
</html>