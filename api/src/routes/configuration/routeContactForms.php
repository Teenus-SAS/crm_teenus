<?php

use crmteenus\dao\ContactFormsDao;

$contactformsDao = new ContactFormsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/contactForms', function (Request $request, Response $response, $args) use ($contactformsDao) {
    $contactforms = $contactformsDao->findAll();
    $response->getBody()->write(json_encode($contactforms, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Forma de Contacto */
$app->post('/addContactForms', function (Request $request, Response $response, $args) use ($contactformsDao) {
    $dataContactForms = $request->getParsedBody();
    $contactforms = $contactformsDao->saveContactForms($dataContactForms);

    if ($contactforms == 2)
        $resp = array('success' => true, 'message' => 'Forma de Contacto actualizada correctamente');

    if ($contactforms == 1)
        $resp = array('success' => true, 'message' => 'Forma de Contacto creada correctamente');

    if ($contactforms == 3)
        $resp = array('error' => true, 'message' => 'Forma de Contacto ya existe');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Forma de Contacto */
$app->post('/deleteContactForm/{id}', function (Request $request, Response $response, $args) use ($contactformsDao) {

    $contactforms = $contactformsDao->deleteContactForms($args['id']);

    if ($contactforms == null)
        $resp = array('success' => true, 'message' => 'Forma de Contacto eliminada correctamente');

    if ($contactforms != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar la forma de contacto, existe información registrada con este método');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
