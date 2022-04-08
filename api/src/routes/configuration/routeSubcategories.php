<?php

use crmteenus\dao\SubcategoriesDao;

$subcategoriesDao = new SubcategoriesDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/* Consulta todos */

$app->get('/subcategories', function (Request $request, Response $response, $args) use ($subcategoriesDao) {
    $categories = $subcategoriesDao->findAll();
    $response->getBody()->write(json_encode($categories, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/subcategoriesUnique', function (Request $request, Response $response, $args) use ($subcategoriesDao) {
    $categories = $subcategoriesDao->findAllSubcategories();
    $response->getBody()->write(json_encode($categories, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});


/* Insertar y actualizar usuario */
$app->post('/addSubcategory', function (Request $request, Response $response, $args) use ($subcategoriesDao) {
    $dataSubcategory = $request->getParsedBody();

    if (!empty($dataSubcategory['subcategory']) && !empty($dataSubcategory['selectCategory'])) {

        $category = $subcategoriesDao->saveSubcategory($dataSubcategory);

        if ($category == 2)
            $resp = array('success' => true, 'message' => 'Subcategoria actualizada correctamente');

        if ($category == 1)
            $resp = array('success' => true, 'message' => 'Subcategoria creada correctamente');

        if ($category == 3)
            $resp = array('error' => true, 'message' => 'Subcategoria ya existe');
    } else {
        $resp = array('error' => true, 'message' => 'Complete todos los datos');
    }

    /* $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json'); */

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

/* Eliminar Usuario */
$app->get('/deleteSubcategory/{id}', function (Request $request, Response $response, $args) use ($subcategoriesDao) {
    $category = $subcategoriesDao->deleteSubcategory($args['id']);
    if ($category == null)
        $resp = array('success' => true, 'message' => 'Categoria eliminada correctamente');

    if ($category != null)
        $resp = array('error' => true, 'message' => 'No es posible eliminar la categoria, existe información registrada');

    $response->getBody()->write(json_encode($resp));
    return $response->withHeader('Content-Type', 'application/json');
});
