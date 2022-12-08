<?php

require_once $_SERVER['DOCUMENT_ROOT']."/webcalendar/vendor/autoload.php";

$redirect_uri = "http://localhost:88/webcalendar/oauth2/callback";

$cronofy = new \Cronofy\Cronofy(["client_id" => "f54rsN1HvOJC2UUeyAw5jZDcuWsXPm-i",  "client_secret" => "qQT8J9rKjrTMTEV3jtPV2vTRUX3sRNMDgAd1mI4ai8_hY2sUYIXyBZdyUVpOxGlCQAgvoKtGpLZUMgMRHQnGHg"]);

//echo $_GET['code'];

$params = [
    'redirect_uri' => $redirect_uri,
    'code' => $_GET['code']
];

$cronofy->requestToken($params);

//Sucesso na Authorization, redirecionar para esta pagina
header('Location: http://localhost:88/webcalendar/');