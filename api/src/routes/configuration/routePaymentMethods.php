<?php

use crmteenus\dao\PaymentMethodsDao;

$paymentmethodsDao = new PaymentMethodsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/paymentMethods', function (Request $request, Response $response, $args) use ($paymentmethodsDao) {
    $companies = $paymentmethodsDao->findAll();
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Forma de Contacto */
$app->post('/addPaymentMethod', function (Request $request, Response $response, $args) use ($paymentmethodsDao) {
    $paymentMethod = $request->getParsedBody();
    $paymentMethod = $paymentmethodsDao->savePaymentMethods($paymentMethod);

    if ($paymentMethod == 2)
        $resp = array('success' => true, 'message' => 'Método de pago actualizado correctamente');

    if ($paymentMethod == 1)
        $resp = array('success' => true, 'message' => 'Método de pago creado correctamente');

    if ($paymentMethod == 3)
        $resp = array('error' => true, 'message' => 'Método de pago ya existe');


    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Forma de Contacto */
$app->get('/deletePaymentMethod/{PaymentMethod}', function (Request $request, Response $response, $args) use ($paymentmethodsDao) {
    $paymentmethod = $paymentmethodsDao->deletePaymentMethods($args['PaymentMethod']);

    if ($paymentmethod == null)
        $resp = array('success' => true, 'message' => 'Método de pago eliminado correctamente');

    if ($paymentmethod != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar el Método de Pago, existe información registrada con este método');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
