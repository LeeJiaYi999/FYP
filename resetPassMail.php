<?php
   session_start();
   include 'db_connection.php';
   //$rand = rand(100000, 999999);
   $_SESSION["Vcode"] = rand(100000, 999999);
   $rand = $_SESSION["Vcode"];
   $email = $_SESSION['Email'];
   $ssql = "select * from employee where email ='" . $_SESSION['Email'] . "'";
   $res = mysqli_query($conn, $ssql);
   $newrow = mysqli_fetch_array($res);
   $username = $newrow['employee_name'];
   
    use PHPMailer\PHPMailer\PHPMailer;
    //use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'wonglee.edu@gmail.com';                     // SMTP username
        $mail->Password   = 'wong@lee1999';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('wonglee.edu@gmail.com', 'noreply@verification code');
        $mail->addAddress("$email", "$username");     // Add a recipient
    //    $mail->addAddress('ellen@example.com');               // Name is optional
    //    $mail->addReplyTo('info@example.com', 'Information');
    //    $mail->addCC('cc@example.com');
    //    $mail->addBCC('bcc@example.com');

        // Attachments
    //    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'noreply@verification code';
        $mail->Body    = "<b><h3>Hello <b>$username<b> ,</b></h3>\n Your verification code is <b>$rand</b>. Please contact us if you didn't request it !" ;
        $mail->AltBody = 'Test';

        $mail->send();
        //echo 'Message has been sent';
        //echo $rand;
       header("location:verifyCode.php");
    } 
    catch (Exception $e) {
//   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    //header("Location: Member/Verification_Code.php");
    ?>