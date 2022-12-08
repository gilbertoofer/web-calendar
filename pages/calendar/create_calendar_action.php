<?php
//sCreateCalendar


require_once $_SERVER['DOCUMENT_ROOT'] . "/webcalendar/vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/webcalendar/config/bSession.php";


use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;


use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;

$bot = new CronofyBot();
if (isset($_POST['sCreateCalendar'])) {


    $params = [
        'profile_id' => $_POST['sProfiles'],
        'name' => $_POST['sCalendarName']
    ];

    $bot->getObjCronofy()->createCalendar($params);

    header("Location: create_calendar.php");
} else {

    header("Location: create_calendar.php");
}