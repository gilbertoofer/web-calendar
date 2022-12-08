<?php
session_start();

require_once  "../vendor/autoload.php";
use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;



use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;


$mAuthSign = new AuthSign();

if($mAuthSign->bExistsSession()){

    echo $_SESSION['emailSignin'];
    header("Location:" ."../index.php");
}


?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Login |  Webcalendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <link rel="shortcut icon" href="" type="image/x-icon">

    <!-- Bootstrap CSS -->

    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="">
</head>

<body>
<center>
<h1 class="" >Login | Webcalendar</h1>
</center>
<!-- Start coding here -->
<div class="" style="margin:auto;">
    <div class="" style="...">
        <h2>SignIn</h2>
        <form action="authActions.php" method="post" enctype="multipart/form-data">
            <div class="">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="emailSignin" class="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="passSignin" class="" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name="signin" class="">Submit</button>
        </form>
    </div>
    <div class="" style="...">
        <h2>Signup</h2>
        <form action="authActions.php" method="post" enctype="multipart/form-data">
            <div class="">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="emailSignup" class="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="passSignup" class="" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name="signup" class="">Submit</button>
        </form>
    </div>
</div>

<!-- Coding End -->

</body>
</html>