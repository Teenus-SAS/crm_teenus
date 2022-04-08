<?php

use crmproyecformas\dao\OrdersDao;

$ordersDao = new OrdersDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consultar Pedidos */

$app->get('/orders', function (Request $request, Response $response, $args) use ($ordersDao) {
    $orders = $ordersDao->findAll();
    $response->getBody()->write(json_encode($orders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consultar Pedidos por Id */

$app->get('/order/{id_order}/{id_remission}', function (Request $request, Response $response, $args) use ($ordersDao) {
    $orders = $ordersDao->findOrderById($args['id_order'], $args['id_remission']);
    $response->getBody()->write(json_encode($orders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Consultar Pedidos y Cotizacion por Id */

$app->get('/order_quote/{id}', function (Request $request, Response $response, $args) use ($ordersDao) {
    $orders = $ordersDao->findOrderByIdQuote($args['id']);
    $response->getBody()->write(json_encode($orders, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Adicionar Pedido */

$app->post('/addOrder', function (Request $request, Response $response, $args) use ($ordersDao) {
    $dataOrder = $request->getParsedBody();

    if (empty($dataOrder['purchase_order']))
        $dataOrder['purchase_order'] = null;
    if (empty($dataOrder['advance_date']))
        $dataOrder['advance_date'] = null;
    if (empty($dataOrder['advance_value']))
        $dataOrder['advance_value'] = null;
    if (empty($dataOrder['policy']))
        $dataOrder['policy'] = null;

    if (empty($dataOrder['date_delivery']))
        $dataOrder['date_delivery'] = null;
    if (empty($dataOrder['contact_delivery']))
        $dataOrder['contact_delivery'] = null;
    if (empty($dataOrder['address_delivery']))
        $dataOrder['address_delivery'] = null;
    if (empty($dataOrder['phone']))
        $dataOrder['phone'] = null;
    if (empty($dataOrder['city']))
        $dataOrder['city'] = null;
    if (empty($dataOrder['observation']))
        $dataOrder['observation'] = null;

    $order = $ordersDao->saveOrder($dataOrder);

    if ($order == 1)
        $resp = array('success' => true, 'message' => 'Pedido creado correctamente');
    else
        $resp = array('error' => true, 'message' => 'Pedido creado con anterioridad, Datos de Entrega Actualizados correctamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Modificar datos entrega Pedido */

$app->post('/modifyDataDeliveryOrder', function (Request $request, Response $response, $args) use ($ordersDao) {
    $dataOrder = $request->getParsedBody();

    if (empty($dataOrder['purchase_order']))
        $dataOrder['purchase_order'] = null;
    if (empty($dataOrder['date_delivery']))
        $dataOrder['date_delivery'] = null;
    if (empty($dataOrder['contact_delivery']))
        $dataOrder['contact_delivery'] = null;
    if (empty($dataOrder['address_delivery']))
        $dataOrder['address_delivery'] = null;
    if (empty($dataOrder['phone']))
        $dataOrder['phone'] = null;
    if (empty($dataOrder['city']))
        $dataOrder['city'] = null;

    $order = $ordersDao->updateDataDeliveryOrder($dataOrder);

    if ($order == 1)
        $resp = array('success' => true, 'message' => 'Datos de Entrega actualizado correctamente');
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error, intente nuevamente');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Cancelar Pedido */

$app->post('/cancelOrder', function (Request $request, Response $response, $args) use ($ordersDao) {

    session_start();
    $access = $_SESSION['access'];

    if ($access == 1) {
        $dataOrder = $request->getParsedBody();
        $order = $ordersDao->cancelOrder($dataOrder['id'], $dataOrder['observation']);

        if ($order == 1)
            $resp = array('success' => true, 'message' => 'Pedido cancelado correctamente');
        else
            $resp = array('error' => true, 'message' => 'Hubo un error, por favor intente nuevamente');
    } else
        $resp = array('error' => true, 'message' => 'Su usuario no tiene acceso para realizar esta acción, contacte a us administrador');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
