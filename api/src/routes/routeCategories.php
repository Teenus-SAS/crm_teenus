<?php

use crmproyecformas\dao\CategoriesDao;

$categoryDao = new CategoriesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/categories', function (Request $request, Response $response, $args) use ($categoryDao) {
    $categories = $categoryDao->findAll();
    $response->getBody()->write(json_encode($categories, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/categoriesUnique', function (Request $request, Response $response, $args) use ($categoryDao) {
    $categories = $categoryDao->findAllCategories();
    $response->getBody()->write(json_encode($categories, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


/* Insertar y actualizar usuario */
$app->post('/addCategory', function (Request $request, Response $response, $args) use ($categoryDao) {
    $dataCategory = $request->getParsedBody();

    if (!empty($dataCategory['category'])) {

        $category = $categoryDao->saveCategory($dataCategory);

        if ($category == 2)
            $resp = array('success' => true, 'message' => 'Categoria actualizada correctamente');

        if ($category == 1)
            $resp = array('success' => true, 'message' => 'Categoria creada correctamente');

        if ($category == 3)
            $resp = array('error' => true, 'message' => 'Categoria ya existe');
    } else {
        $resp = array('error' => true, 'message' => 'Complete todos los datos');
    }

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');



    $response->getBody()->write(json_encode($category, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->get('/deleteCategory/{id}', function (Request $request, Response $response, $args) use ($categoryDao) {
    $category = $categoryDao->deleteCategory($args['id']);
    if ($category == null)
        $resp = array('success' => true, 'message' => 'Categoria eliminada correctamente');

    if ($category != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar la categoria, existe información registrada');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
