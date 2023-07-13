<?php

use crmteenus\dao\BillingsDao;

$billingsDao = new BillingsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/billings', function (Request $request, Response $response, $args) use ($billingsDao) {
    session_start();
    $rol = $_SESSION['rol'];
    $billings = $billingsDao->findAllBillings($rol);
    $response->getBody()->write(json_encode($billings, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
