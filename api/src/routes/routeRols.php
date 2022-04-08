<?php

use crmproyecformas\dao\RolsDao;

$rolsDao = new RolsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/rols', function (Request $request, Response $response, $args) use ($rolsDao) {
    $rols = $rolsDao->findAll();
    $response->getBody()->write(json_encode($rols, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});