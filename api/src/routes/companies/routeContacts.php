<?php

use crmteenus\dao\ContactsDao;

$contactsDao = new ContactsDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/contacts', function (Request $request, Response $response, $args) use ($contactsDao) {
    $contacts = $contactsDao->findAll();
    $response->getBody()->write(json_encode($contacts, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addContact', function (Request $request, Response $response, $args) use ($contactsDao) {
    $dataContact = $request->getParsedBody();

    if (empty($dataContact['names']) || empty($dataContact['lastname']) || empty($dataContact['phone1']) || empty($dataContact['email']) || empty($dataContact['position']) || empty($dataContact['company']))
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos');
    else {
        $contact = $contactsDao->saveContact($dataContact);
        if ($contact == 1)
            $resp = array('success' => true, 'message' => 'Contacto creado correctamente');
        else if ($contact == 2)
            $resp = array('success' => true, 'message' => 'Contacto actualizado correctamente');
        else
            $resp = array('error' => true, 'message' => 'El email ya existe. Intente con uno nuevo');
    }

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->post('/deleteContact', function (Request $request, Response $response, $args) use ($contactsDao) {
    $dataContact = $request->getParsedBody();
    $contact = $contactsDao->deleteContact($dataContact);
    $response->getBody()->write(json_encode($contact, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
