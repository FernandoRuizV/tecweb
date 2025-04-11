<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use MYAPI\CREATE\Create;
use MYAPI\READ\Read;
use MYAPI\UPDATE\Update;
use MYAPI\DELETE\Delete as Delete;

require __DIR__ . '/../vendor/autoload.php';
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath('/tecweb/practicas/p17/p17/product_app/backend/public');


$app->post('/add', function ($request, $response, $args){
    $prodObj = new Create('marketzone');
    $data = $request->getParsedBody(); 
    $Producto = (object)$data;
    $prodObj->add($Producto);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/edit', function ($request, $response, $args){
    $prodObj = new Update('marketzone');
    $data = $request->getParsedBody(); // ✅
    $Producto = (object)$data;
    $prodObj->edit($Producto); 
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->post('/update', function ($request, $response, $args){
    $prodObj = new Update('marketzone');
    $data = $request->getParsedBody();
    $id = $data['id'];
    $prodObj->asignar($id);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->post('/eliminar', function ($request, $response, $args){
    $prodObj = new Delete('marketzone');
    $data = $request->getParsedBody();
    $id = $data['id'];
    $prodObj->delete($id);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/search', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $data = $request->getParsedBody(); // ✅
    $search = $data['search'] ?? '';
    $prodObj->search($search);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/search-name', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $params = $request->getQueryParams();
    $name = $params['name'] ?? '';
    $prodObj->single($name);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/list', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $prodObj->list();
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
?>
