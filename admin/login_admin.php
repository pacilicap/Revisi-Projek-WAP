<?php
session_start();

if(!isset($_SESSION['log_admin'])){
} else {
    header('location:index.php');
};

include '../dbconnect.php';
date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);
    $queryuser = mysqli_query($conn,"SELECT * FROM login WHERE email='$email' AND role='Admin' ");
    $cariuser = mysqli_fetch_assoc($queryuser);

    if( password_verify($pass, $cariuser['password']) ) {
        $_SESSION['id'] = $cariuser['userid'];
        $_SESSION['role'] = $cariuser['role'];
        $_SESSION['notelp'] = $cariuser['notelp'];
        $_SESSION['name'] = $cariuser['namalengkap'];
        $_SESSION['log_admin'] = "Logged";
        header('location:index.php');
    } else {
     echo 'Username atau password salah';
     header("location:login_admin.php");
 }       
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bukapedia - Masuk Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: #302c2c;
        }
        .login-form {
            width: 340px;
            margin: 50px auto;
            font-size: 15px;
        }
        .login-form form {
            margin-top: 100px;
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {        
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <form action="" method="post">
            <h2 class="text-center">Login Admin</h2>       
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Masuk" class="btn btn-primary btn-block">
            </div>      
        </form>
    </div>
</body>
</html>