<?php

use crmteenus\dao\GeneralSalesClientsDao;
use crmteenus\dao\SalesClientsDao;
use crmteenus\dao\SendMakeEmailDao;
use crmteenus\dao\SendEmailDao;
use crmteenus\dao\UserDao;

$sendMakeEmailDao = new SendMakeEmailDao();
$sendEmailDao = new SendEmailDao();
$salesClientsDao = new SalesClientsDao();
$generalSalesClientsDao = new GeneralSalesClientsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/sendEmailSupport', function (Request $request, Response $response, $args) use (
    $sendMakeEmailDao,
    $sendEmailDao,
    $salesClientsDao,
    $generalSalesClientsDao
) {
    $dataSupport = $request->getParsedBody();

    // if ($dataSupport['idGroup'] == 0)
    //     $contacts = $salesClientsDao->findAllSalesClients();
    // else
    $contacts = $generalSalesClientsDao->findAllSalesClientsByGroup($dataSupport['idGroup']);

    foreach ($contacts as $arr) {
        $dataEmail = $sendMakeEmailDao->sendEmailSupport($dataSupport, $arr['email']);

        $support = $sendEmailDao->sendEmail($dataEmail, 'sergio.velandia@teenus.com.co', 'Sergio Velandia');

        if (!isset($support['status'])) break;
        // Esperar 15 segundos antes de pasar al siguiente usuario
        sleep(15);
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

$app->post('/sendSimEmailSupport', function (Request $request, Response $response, $args) use (
    $sendMakeEmailDao,
    $sendEmailDao,
    $salesClientsDao
) {
    $dataSupport = $request->getParsedBody();

    $dataEmail = $sendMakeEmailDao->sendEmailSupport($dataSupport, $dataSupport['email']);

    $support = $sendEmailDao->sendEmail($dataEmail, 'sergio.velandia@teenus.com.co', 'Sergio Velandia');

    if ($support['status'] == 'success')
        $resp = array('success' => true, 'message' => $support['message']);
    elseif ($support['status'] == 'error')
        $resp = array('error' => true, 'message' => $support['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error al enviar el correo. Intente nuevamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});
