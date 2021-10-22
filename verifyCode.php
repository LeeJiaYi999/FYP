<?php 

session_start();
$vcode = $_SESSION["Vcode"];
require "db_connection.php";
$email = "";
$name = "";
$errors = array();

 
    if(isset($_POST['check_code'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        if($vcode == $otp_code)
        {
            echo 'Successfully !';
            $_SESSION['Vinfo'] = "Your Verify code is <b>Match</b>, You can continue to reset the password !";
            header("location:resetPassword.php");
        }
        else
        {
            echo 'Please enter the valid verify code !';
        }
    }

?>
<?php 
//session_start();
$email = $_SESSION['Email'];
if($email == false){
  header('Location: index.php');
}
?>


<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Verify Code</title>
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
            <div class="header">Verify Code</div>
            <form  method="post">
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
                        <input type="number" name="otp" class="form-control" placeholder="Enter verify code" required="required"/>
                    </div>         
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="check_code" class="btn bg-olive btn-block">Continue</button>  
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>