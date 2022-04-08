<?php

use crmteenus\dao\BusinessDao;

$businessDao = new BusinessDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/business', function (Request $request, Response $response, $args) use ($businessDao) {
    $business = $businessDao->findAll();
    $response->getBody()->write(json_encode($business, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/businessCompany/{id_company}', function (Request $request, Response $response, $args) use ($businessDao) {
    $business = $businessDao->findAllbyCompany($args['id_company']);
    $response->getBody()->write(json_encode($business, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consulta por asesor comercial */

$app->get('/businesscommercial', function (Request $request, Response $response, $args) use ($businessDao) {
    $business = $businessDao->findAll();
    $response->getBody()->write(json_encode($business, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consulta por asesor comercial */

$app->get('/business/{id}', function (Request $request, Response $response, $args) use ($businessDao) {
    $business = $businessDao->findAllbySeller($args["id"]);
    $response->getBody()->write(json_encode($business, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Forma de Contacto */
$app->post('/addBusiness', function (Request $request, Response $response, $args) use ($businessDao) {
    $databusiness = $request->getParsedBody();

    if (empty($databusiness['name_business']) || empty($databusiness['company']) || empty($databusiness['contact']) || empty($databusiness['saleEstimated']) || empty($databusiness['selectSalesPhase']) || empty($databusiness['term']))
        $resp = array('error' => true, 'message' => 'Datos incompletos, intente nuevamente');
    else {
        $business = $businessDao->saveBusiness($databusiness);
        if ($business == null)
            $resp = array('success' => true, 'message' => 'Proyecto creado correctamente');
        else if ($business == 2)
            $resp = array('success' => true, 'message' => 'Proyecto actualizado correctamente');
        else
            $resp = array('error' => true, 'message' => 'Error al ingresar el proyecto, intente nuevamente');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Delete Business */
/* $app->post('/deleteBusiness', function (Request $request, Response $response, $args) use ($businessDao) {
    $dataCompanie = $request->getParsedBody();
    $companies = $businessDao->deleteSalesPhases($dataCompanie);
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
}); */
