<?php

use crmproyecformas\dao\SalesChannelsDao;

$saleschannelsDao = new SalesChannelsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/salesChannels', function (Request $request, Response $response, $args) use ($saleschannelsDao) {
    $saleschannels = $saleschannelsDao->findAll();
    $response->getBody()->write(json_encode($saleschannels, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addSaleChannel', function (Request $request, Response $response, $args) use ($saleschannelsDao) {
    $dataSalesChannels = $request->getParsedBody();
    $saleschannels = $saleschannelsDao->saveSaleChannel($dataSalesChannels);

    if ($saleschannels == 2)
        $resp = array('success' => true, 'message' => 'Canal de ventas actualizado correctamente');

    if ($saleschannels == 1)
        $resp = array('success' => true, 'message' => 'Canal de ventas creado correctamente');

    if ($saleschannels == 3)
        $resp = array('error' => true, 'message' => 'Canal de ventas ya existe');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->get('/deleteSaleChannel/{id}', function (Request $request, Response $response, $args) use ($saleschannelsDao) {
    $saleschannels = $saleschannelsDao->deleteSaleChannel($args['id']);

    if ($saleschannels == null)
        $resp = array('success' => true, 'message' => 'Canal de ventas eliminado correctamente');

    if ($saleschannels != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar el canal de ventas, existe información registrada con este canal');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
