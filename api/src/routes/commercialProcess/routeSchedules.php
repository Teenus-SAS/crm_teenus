<?php

use crmteenus\dao\SchedulesDao;

$schedulesDao = new SchedulesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/schedules', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $tasks = $schedulesDao->findAll();
    $response->getBody()->write(json_encode($tasks, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/completedSchedules', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $tasks = $schedulesDao->findAllCompleted();
    $response->getBody()->write(json_encode($tasks, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/todaySchedules', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $tasks = $schedulesDao->findAllTaskToday();
    $response->getBody()->write(json_encode($tasks, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/delaySchedules', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $tasks = $schedulesDao->findAllTaskDelay();
    $response->getBody()->write(json_encode($tasks, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/activateSchedule', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $id_task = $request->getParsedBody();
    $tasks = $schedulesDao->activateSchedule($id_task);
    $response->getBody()->write(json_encode($tasks, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar Forma de Contacto */
$app->post('/addSchedule', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $dataSchedule = $request->getParsedBody();

    if (empty($dataSchedule['contactForms']) || empty($dataSchedule['company']) || empty($dataSchedule['contact']) || empty($dataSchedule['fechaAccion']) || empty($dataSchedule['descriptionAction'])) {
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos');
    } else {
        $schedule = $schedulesDao->saveSchedule($dataSchedule);
        if ($schedule == 2)
            $resp = array('success' => true, 'message' => 'Agenda actualizada correctamente');

        if ($schedule == 1)
            $resp = array('success' => true, 'message' => 'Agenda creada correctamente');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Forma de Contacto */
$app->post('/deleteSchedule', function (Request $request, Response $response, $args) use ($schedulesDao) {
    $dataCompanie = $request->getParsedBody();
    $companies = $schedulesDao->deleteSchedule($dataCompanie);
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
