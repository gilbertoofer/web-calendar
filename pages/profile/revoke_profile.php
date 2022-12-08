<?php

require_once $_SERVER['DOCUMENT_ROOT']."/webcalendar/vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT']."/webcalendar/config/bSession.php";



use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;


use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;

$bot = new CronofyBot();
?>





<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title> Remover profile | Webcalendar</title>
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
    <h1 > Remover profile | Webcalendar</h1>
</center>


<form action="../../index.php" method="post" enctype="multipart/form-data">
    Bem-vindo, <?php echo $_SESSION['emailSignin']; ?>
    <button type="submit" name="logout" >Sair</button>
</form>

    <fieldset>
        <form method="post" action="revoke_profile_action.php">

            <?php  $bot->loadProfilesToRadioForm();  ?>

            <br>
            <input type='submit' name='sRevokeProfile' value="Revoke profile"/>
        </form>
    <legend>Profiles</legend>
    <fieldset>




</body>
</html>

