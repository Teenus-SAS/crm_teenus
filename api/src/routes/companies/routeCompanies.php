<?php

use crmteenus\dao\CompaniesDao;

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
        if (empty($dataCompany['id_company'])) {
            $result = $companieDao->findCompany($dataCompany);
            if ($result > 0)
                $resp = array('error' => true, 'message' => 'La empresa ya se encuentra creada');
            else {
                $result = $companieDao->insertCompany($dataCompany);
                if ($result)
                    $resp = array('success' => true, 'message' => 'Empresa creada correctamente');
                else
                    $resp = array('error' => true, 'message' => 'Ocurrio un error. Intente Nuevamente');
            }
        } else {
            $result = $companieDao->updateCompany($dataCompany);
            if ($result)
                $resp = array('success' => true, 'message' => 'Empresa actualizada correctamente');
            else
                $resp = array('error' => true, 'message' => 'Ocurrio un error. Intente Nuevamente');
        }
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
