<?php

use crmproyecformas\dao\CompaniesDao;

$companieDao = new CompaniesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/companies', function (Request $request, Response $response, $args) use ($companieDao) {
    $companies = $companieDao->findAll();
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Insertar y actualizar usuario */
$app->post('/addCompany', function (Request $request, Response $response, $args) use ($companieDao) {
    $dataCompany = $request->getParsedBody();

    if (empty($dataCompany['nit']) || empty($dataCompany['company_name']) || empty($dataCompany['address']) || empty($dataCompany['city']) || empty($dataCompany['category']) || empty($dataCompany['subcategory']))
        $resp = array('error' => true, 'message' => 'Ingrese todos los datos');
    else {
        $company = $companieDao->saveCompany($dataCompany);
        if ($company == 1)
            $resp = array('success' => true, 'message' => 'Empresa creada correctamente');
        else if ($company == 2)
            $resp = array('success' => true, 'message' => 'Empresa actualizada correctamente');
        else if ($company == 3)
            $resp = array('error' => true, 'message' => 'La empresa ya se encuentra creada. Intente nuevamente');
        else
            $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */

$app->post('/deleteCompanie', function (Request $request, Response $response, $args) use ($companieDao) {
    $dataCompany = $request->getParsedBody();
    $companies = $companieDao->deleteCompany($dataCompany);
    $response->getBody()->write(json_encode($companies, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* reasignar empresa */

$app->get('/reassignCompany/{id_company}/{id_seller}', function (Request $request, Response $response, $args) use ($companieDao) {
    $companies = $companieDao->reassignCompany($args['id_company'], $args['id_seller']);
    if ($companies == null) {
        $resp = array('success' => true, 'message' => 'Empresa reasignada correctamente');
        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

/* reasignar empresas */

$app->get('/reassignCompanies/{id_seller}/{id_seller_old}', function (Request $request, Response $response, $args) use ($companieDao) {
    $companies = $companieDao->reassignCompanies($args['id_seller'], $args['id_seller_old']);
    if ($companies == null) {
        $resp = array('success' => true, 'message' => 'Empresas reasignadas correctamente');
        $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
        return $response->withHeader('Content-Type', 'application/json');
    }
});
