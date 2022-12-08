<?php


require_once $_SERVER['DOCUMENT_ROOT'] . "/webcalendar/vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/webcalendar/config/bSession.php";


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
    <title>Criar calendário | Webcalendar</title>
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
    <h1 > Criar calendário | Webcalendar</h1>
</center>


<form action="../../index.php" method="post" enctype="multipart/form-data">
    Bem-vindo, <?php echo $_SESSION['emailSignin']; ?>
    <button type="submit" name="logout" >Sair</button>
</form>
<br>

<a href="../../index.php"> < Voltar </a>

<fieldset>
    <?php  $bot->loadCalendars();  ?>

<legend>Calendários existentes </legend>
</fieldset>



<fieldset>
    <form method="post" action="create_calendar_action.php">

        Escolher perfil: <?php  $bot->loadProfilesToSelectOption();  ?>

        <br>
        Nome do calendário: <input type='text' name='sCalendarName' id="idCalendarName"/>

        <br>
        <input type='submit' name='sCreateCalendar' value="Criar calendário"/>
    </form>
    <legend>Formulário de criar calendário</legend>
    </fieldset>




</body>
</html>
