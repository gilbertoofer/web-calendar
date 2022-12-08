<?php
require_once $_SERVER['DOCUMENT_ROOT']."/webcalendar/vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT']."/webcalendar/config/bSession.php";



use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;


use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;

$bot = new CronofyBot();
if(isset($_POST['nProfiles'])){


    $bot->getObjCronofy()->revokeProfile($_POST['nProfiles']) ;

    header("Location: revoke_profile.php");
}else{

    header("Location: revoke_profile.php");
}