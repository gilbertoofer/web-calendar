<?php
require_once "../vendor/autoload.php";

use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;


use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;


$mAuthSign = new AuthSign();


$bSession = $mAuthSign->bExistsSession();
if(!$bSession){
    header("Location: ". "login.php");
}




if(isset($_POST['signin'])){
    if($mAuthSign) {
        $mAuthSign->createAuthWithDbGoogle($_POST['emailSignin'], $_POST['passSignin']);

    }//if
}

if(isset($_POST['signup'])){
    if($mAuthSign) {
        $mAuthSign->addLoginData($_POST['emailSignup'], $_POST['passSignup']);

        header("Location: ". "login.php");
    }
}

