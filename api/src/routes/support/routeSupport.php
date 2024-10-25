<?php

use crmteenus\dao\SendMakeEmailDao;
use crmteenus\dao\SendEmailDao;
use crmteenus\dao\UserDao;

$sendMakeEmailDao = new SendMakeEmailDao();
$sendEmailDao = new SendEmailDao();
$usersDao = new UserDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/sendEmailSupport', function (Request $request, Response $response, $args) use (
    $sendMakeEmailDao,
    $sendEmailDao,
    $usersDao
) {
    $dataSupport = $request->getParsedBody();

    $users = $usersDao->findAllUsers();

    foreach ($users as $arr) {
        $dataEmail = $sendMakeEmailDao->sendEmailSupport($dataSupport, $arr['email']);

        $support = $sendEmailDao->sendEmail($dataEmail, 'soporteTezlik@tezliksoftware.com.co', 'SoporteTezlik');

        if (!isset($support['status'])) break;
        // Esperar 60 segundos antes de pasar al siguiente usuario
        sleep(60);
    }

    if ($support['status'] == 'success')
        $resp = array('success' => true, 'message' => $support['message']);
    elseif ($support['status'] == 'error')
        $resp = array('error' => true, 'message' => $support['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error al enviar el correo. Intente nuevamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});
