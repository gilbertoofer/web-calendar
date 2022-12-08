<?php


use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;


use Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;


session_start();


$mAuthSign = new AuthSign();


if(!$mAuthSign->bExistsSession()){
    // $user = new User($_POST['emailSignin'], $_POST['passSignin']);

    header("Location: ". "./login/login.php");
}

if(isset($_POST['logout'])){
    $mAuthSign->closeSession();

}