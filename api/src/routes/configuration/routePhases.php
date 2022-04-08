<?php

use crmteenus\dao\SalesPhasesDao;

$salesphasesDao = new SalesPhasesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/salesPhases', function (Request $request, Response $response, $args) use ($salesphasesDao) {
    $salesphases = $salesphasesDao->findAll();
    $response->getBody()->write(json_encode($salesphases, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Forma de Contacto */
$app->post('/addSalePhase', function (Request $request, Response $response, $args) use ($salesphasesDao) {
    $datasalesphases = $request->getParsedBody();

    if (!empty($datasalesphases['salePhase']) && !empty($datasalesphases['oportunity'])) {

        $salesphases = $salesphasesDao->saveSalesPhases($datasalesphases);

        if ($salesphases == 2)
            $resp = array('success' => true, 'message' => 'Fase de Venta actualizada correctamente');

        if ($salesphases == 1)
            $resp = array('success' => true, 'message' => 'Fase de Venta creada correctamente');

        if ($salesphases == 3)
            $resp = array('error' => true, 'message' => 'Fase de Venta ya existe');
    }else{
        $resp = array('error' => true, 'message' => 'Complete todos los datos');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Forma de Contacto */
$app->get('/deleteSalePhase/{id}', function (Request $request, Response $response, $args) use ($salesphasesDao) {
    $salesphases = $salesphasesDao->deleteSalesPhases($args['id']);

    if ($salesphases == null)
        $resp = array('success' => true, 'message' => 'Fase de Venta eliminada correctamente');

    if ($salesphases != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar la fase de venta, existe información registrada con este fase');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
