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
    session_start();
    $id_user = $_SESSION['idUser'];

    $dataSupport = $request->getParsedBody();

    $support['status'] = 'success';
    $support['message'] = 'Correo enviado exitosamente.';

    // Obtener contactos
    if ($dataSupport['group'] == 'all')
        $contacts = $salesClientsDao->findAllSalesClientsByIdUser($id_user);
    else {
        $contacts = $generalSalesClientsDao->findAllSalesClientsByGroup($id_user, $dataSupport['group']);
    }

    $totalContacts = count($contacts); // Total de contactos para el conteo
    $currentCount = 0;

    foreach ($contacts as $arr) {
        $currentCount++;
        $dataEmail = $sendMakeEmailDao->sendEmailSupport($dataSupport, $arr['email']);
        $support = $sendEmailDao->sendEmail($dataEmail, 'sergio.velandia@teenus.com.co', 'Sergio Velandia', $arr['email']);

        if (!isset($support['status'])) break;

        // Enviar el progreso actual
        $progressData = [];
        $progressData = json_encode([
            'status' => 'progress',
            'message' => "{$currentCount}/{$totalContacts}"
        ]);

        // Enviar la respuesta parcial
        echo $progressData;
        ob_flush(); // Limpiar el buffer de salida
        flush();

        // Esperar 15 segundos antes de pasar al siguiente usuario
        sleep(15);
    }

    // Respuesta final
    if ($support['status'] == 'success') {
        $resp = array('success' => true, 'message' => $support['message']);
    } elseif ($support['status'] == 'error') {
        $resp = array('error' => true, 'message' => $support['message']);
    } else {
        $resp = array('error' => true, 'message' => 'Ocurrió un error al enviar el correo. Intente nuevamente');
    }

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

    $support = $sendEmailDao->sendEmail($dataEmail, 'sergio.velandia@teenus.com.co', 'Sergio Velandia', $dataSupport['email']);

    if ($support['status'] == 'success')
        $resp = array('success' => true, 'message' => $support['message']);
    elseif ($support['status'] == 'error')
        $resp = array('error' => true, 'message' => $support['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error al enviar el correo. Intente nuevamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});
