<?php

use crmteenus\dao\StatusUserDao;

$statusUserDao = new StatusUserDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


/* Inactivar/Activar Usuario */

$app->get('/inactivateActivateUser/{id}', function (Request $request, Response $response, $args) use ($statusUserDao) {
    $users = $statusUserDao->inactivateActivateUser($args['id']);
    if ($users == 0)
        $resp = array('info' => true, 'message' => 'Usuario inactivado correctamente');

    if ($users == 1)
        $resp = array('success' => true, 'message' => 'Usuario activado correctamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});