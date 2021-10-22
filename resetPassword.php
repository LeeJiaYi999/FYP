<?php 
session_start();
include 'db_connection.php';
$email = "";
$name = "";
$errors = array();


    if(isset($_POST['change_password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Both password was not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = $password;
            $update_pass = "UPDATE employee SET password = '$encpass' WHERE email = '".$_SESSION['Email']."'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Password changed! Please login with your new password.";
                $_SESSION['info'] = $info;
                
                header('Location: index.php');
            }else{
                $errors['db_error'] = "Failed to change password!";
            }
        }
    }

?>
<?php 
$email = $_SESSION['Email'];
if($email == false){
  header('Location: index.php');
}
?>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Reset Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <!--test-->
        <div class="form-box" id="login-box">
            <div class="header">Reset Password</div>
            <form  method="post">
                <?php 
                    if($_SESSION['Vinfo'] != ""){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['Vinfo']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter New Password" required="required"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required="required"/>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="change_password" class="btn bg-olive btn-block">Confirm</button>  
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>