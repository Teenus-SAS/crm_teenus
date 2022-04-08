<?php

use crmteenus\dao\RemissionsDao;
use crmteenus\dao\UserDao;

$remissionDao = new RemissionsDao();
$userDao = new UserDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consultar Pedidos */

$app->get('/remissions', function (Request $request, Response $response, $args) use ($remissionDao) {
    $remission = $remissionDao->findAll();
    $response->getBody()->write(json_encode($remission, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consultar Pedidos por Id */

$app->get('/remission/{id_order}/{id_remission}', function (Request $request, Response $response, $args) use ($remissionDao, $userDao) {
    $dataOrder = $remissionDao->findOrderById($args['id_order']);
    $dataRemission = $remissionDao->findRemissionById($args['id_remission']);
    $dataDeliveryRemission = $remissionDao->findDataDeliveryRemissionById($args['id_order'], $args['id_remission']);
    $user = $userDao->findUser();
    $remissionAll = array_merge($user, $dataOrder, $dataDeliveryRemission, $dataRemission);

    $response->getBody()->write(json_encode($remissionAll, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consultar Pedidos y Cotizacion por Id */

$app->get('/remission_order/{id}', function (Request $request, Response $response, $args) use ($remissionDao) {
    $remission = $remissionDao->findRemissionByIdOrder($args['id']);
    $response->getBody()->write(json_encode($remission, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Adicionar Pedido */

$app->post('/addRemission', function (Request $request, Response $response, $args) use ($remissionDao) {
    $dataRemission = $request->getParsedBody();

    $remission = $remissionDao->saveRemission($dataRemission);

    if ($remission == 1)
        $resp = array('success' => true, 'message' => 'Remisión creada correctamente');
    else
        $resp = array('error' => true, 'message' => 'Remisión creada con anterioridad');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Crear remision por producto */

$app->get('/loadProductsRemission/{id}', function (Request $request, Response $response, $args) use ($remissionDao) {
    $remission = $remissionDao->loadProductsRemission($args['id']);
    $response->getBody()->write(json_encode($remission));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Crear remision por producto */

$app->post('/remissionUpdateProducts', function (Request $request, Response $response, $args) use ($remissionDao) {
    $productsRemission = $request->getParsedBody();
    $remission = $remissionDao->updateProductsRemission($productsRemission['prod']);
    $response->getBody()->write(json_encode($remission));
    return $response->withHeader('Content-Type', 'application/json');
});


/* Cancelar Remision */

$app->post('/cancelRemission', function (Request $request, Response $response, $args) use ($remissionDao) {
    $dataremission = $request->getParsedBody();
    $remission = $remissionDao->cancelRemission($dataremission['id'], $dataremission['observation']);

    if ($remission == 1)
        $resp = array('success' => true, 'message' => 'Pedido cancelado correctamente');
    else
        $resp = array('error' => true, 'message' => 'Hubo un error, por favor intente nuevamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
