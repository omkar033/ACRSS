<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendor/autoload.php';

if(isset($_POST["register"]))
{
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mail = new PHPMailer(true);

    try{
        $mail->SMTPDebug = 0;

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'omkargavhane33';

        $mail->Password = 'frukkdigicikbelf';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->SMTPSecure = 'tls';

        $mail->Port = 587;
        $mail->setFrom('omkargavhane33@gmail.com','Omkar Gavhane');

        $mail->addAddress($email,$name);
        $mail-> addReplyTo('omkargavhane33@gmail.com',"Omkar");

        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Email verification';
        $mail->Body = '<p>Your verification code is: <b style="font: size 30px;">' . $verification_code . '</b></p>';

        $mail->send();

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $conn =mysqli_connect("localhost", "root", "", "acrss_db");

        $sql = "INSERT INTO register(name, phone, email, password, verification_code, email_verified_at) VALUES ('" . $name . "','" . $phone . "','" . $email . "','" . $password . "','" . $verification_code . "','".$email_verified_at."')";
        mysqli_query($conn, $sql);

        header("Location: email_verification.php?email=" . $email);
        exit();
    }
    catch(Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
      body  {
    background-image: url('uploads/cover.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh; /* Ensures the background covers the entire viewport height */
}
        /* Style for the login form container */
.container {
    margin-top: 100px;
}

/* Style for the form */
.form {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}


/* Style for the form header */
.form h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Style for the form input fields */
.form-control {
    margin-bottom: 15px;
}
.error{
    background: #f2dede;
    color: #a94442;
    padding: 10px;
    width: 90%;
    border-radius: 5px;
    margin: 20px auto;
    text-decoration: none;
}
.success{
    background: #d4edda;
    color: #40754c;
    padding: 10px;
    width: 90%;
    border-radius: 5px;
    margin: 20px auto;
    text-decoration: none;
}

/* Style for the login button */
.button {
    background-color: #007bff;
    color: #fff;
    border: none;
}

/* Style for the forgot password link */
.forget-pass a {
    color: #007bff;
}

/* Style for the signup link */
.login-link a {
    color: #007bff;
}

/* Center aligning the form */
.form.login-form {
    text-align: center;
}

    </style>
</head>
<body>

    <div class="container">
        <?php if(isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>
        <?php if(isset($_GET['success'])) { ?>
            <p class="success">
                <?php echo $_GET['success']; ?>
            </p>
        <?php } ?>
    <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup.php" method="POST" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="phone" name="phone" id="phone" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="register" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>