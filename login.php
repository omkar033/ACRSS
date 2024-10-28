<?php
session_start();
if(isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = mysqli_connect("localhost", "root", "", "acrss_db"); 

    $sql = "SELECT * FROM register WHERE email= '" . $email . "'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0)
    {
        header("Location: login.php?error=Email not found");
        exit();
    }

    $user = mysqli_fetch_object($result);

    if(!($password==($user->password)))
    
    {
        header("Location: login.php?error=Password is incorrect");
        exit();
    }

    if($user->email_verified_at == null)
    {
        header("Location: login.php?error=Please verify your email <a href='email_verification.php?email=" . $email ."'>form here</a>");
        exit();
    }
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name; // Assuming name is a field in your 'register' table

    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Login Form</title>
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
.success{
    background: #d4edda;
    color: #40754c;
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
   
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="" method="POST">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your email and password.</p>
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
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                    <div class="d-flex align-items-center justify-content-end">
                        <input class="form-control button" type="submit" name="login"  value="Login" >
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup.php">Signup now</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
