<?php



require_once __DIR__. "/vendor/autoload.php";
require_once "config/bSession.php";




use \am\internet\CronofyBot;
use \config\AuthSign;
use \config\DbGoogle;


use Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;



$bot = new CronofyBot();

//carregar todos os Events para o Json File
$bot->createJsonFileWithArray($bot->loadAllEvents());



?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Webcalendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="" type="image/x-icon">

    <!-- Bootstrap CSS -->

    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="">


    <script src="js/loadEvents.js"></script>
</head>

<body>
<center>
    <h1 > Webcalendar</h1>
</center>


    <form action="index.php" method="post" enctype="multipart/form-data">
        Bem-vindo, <?php echo $_SESSION['emailSignin']; ?>
        <button type="submit" name="logout" >Sair</button>
    </form>


    <a href="<?php echo $bot->generateLinkGrantAuthorizationUserAccountMail();?>" alt="Dar permissões de acesso ao Cronofy"> Conectar perfil </a> |
    <a href="pages/profile/revoke_profile.php" alt=""> Remover perfil </a> |
    <a href="pages/calendar/create_calendar.php" alt=""> Criar calendário </a>

    <br>


    <fieldset>
        <div id="idSectionEventsResults"> </div>
        <legend for="idSectionEventsResults">Eventos</legend>
    <fieldset>




</body>
</html>





