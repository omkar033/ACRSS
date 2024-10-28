<?php

if(isset($_POST['verify_email'])){
    $email = $_POST["email"];
    $verification_code=$_POST["verification_code"];

    $conn = mysqli_connect("localhost", "root", "", "acrss_db");

    $sql = "UPDATE register SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code ."'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) == 0){
        header("Location: email-verification.php?error=verification code is invalid");

        exit();
    }

    header("Location: login.php?success=Your email has been verified successfully");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>verification Form</title>
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
.error{
    background: #f2dede;
    color: #a94442;
    padding: 10px;
    width: 90%;
    border-radius: 5px;
    margin: 20px auto;
    text-decoration: none;
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
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form method="POST" autocomplete="">
                    <h2 class="text-center">Email Verification</h2>
                    <p class="text-center">
                        <?php
                    if(isset($_GET["error"])){
                        echo $_GET["error"];
                    }
                    ?>
                    </p>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="email" value="<?php echo $_GET['email'];?>" required>
                        <input class="form-control" type="text" name="verification_code" placeholder="Enter Verification Code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="verify_email" value="Verify">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>