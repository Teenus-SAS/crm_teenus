<?php

use crmteenus\dao\ZonesDao;

$zonesDao = new ZonesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Configuracion de Zonas */

$app->get('/zones', function (Request $request, Response $response, $args) use ($zonesDao) {
    $zones = $zonesDao->findAll();
    $response->getBody()->write(json_encode($zones, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Zonas */
$app->post('/addZones', function (Request $request, Response $response, $args) use ($zonesDao) {
    $datazone = $request->getParsedBody();
    $zones = $zonesDao->saveZones($datazone);

    if ($zones == 2)
        $resp = array('success' => true, 'message' => 'Zona actualizada correctamente');

    if ($zones == 1)
        $resp = array('success' => true, 'message' => 'Zona creada correctamente');

    if ($zones == 3)
        $resp = array('error' => true, 'message' => 'Zona ya existe');

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Zonas */
$app->get('/deleteZones/{id}', function (Request $request, Response $response, $args) use ($zonesDao) {
    $zones = $zonesDao->deleteZone($args['id']);

    if ($zones == null)
        $resp = array('success' => true, 'message' => 'Zona eliminada correctamente');

    if ($zones != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar la zona, existe información registrada con esta zona');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});


/* Assigned Zones */

$app->get('/zonesAssigned', function (Request $request, Response $response, $args) use ($zonesDao) {
    $zones = $zonesDao->findAllZonesAssigned();
    $response->getBody()->write(json_encode($zones, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/addZonesAssigned', function (Request $request, Response $response, $args) use ($zonesDao) {
    $dataassignedzone = $request->getParsedBody();
    $assignedzone = $zonesDao->saveZonesAssigned($dataassignedzone);

    if ($assignedzone == 2)
        $resp = array('success' => true, 'message' => 'Asignación de zona actualizada correctamente');

    if ($assignedzone == 1)
        $resp = array('success' => true, 'message' => 'Zona asignada correctamente');

    if ($assignedzone == 3)
        $resp = array('info' => true, 'message' => 'La zona ya se encuentra registrada, para actualizarla puede hacerlo en la columna de acciones');

    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

/* Eliminar Zonas Asignadas */

$app->get('/deleteZonesAssigned/{id}', function (Request $request, Response $response, $args) use ($zonesDao) {
    $zones = $zonesDao->deleteZonesAssigned($args['id']);

    if ($zones == null)
        $resp = array('success' => true, 'message' => 'Zona eliminada correctamente');

    if ($zones != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar la zona, existe información registrada con esta zona');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});