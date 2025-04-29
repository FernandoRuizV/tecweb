<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use MYAPI\CREATE\Create;
use MYAPI\READ\Read;
use MYAPI\UPDATE\Update;
use MYAPI\DELETE\Delete as Delete;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath('/tecweb/practicas/p18/p18/product_app/backend');



$app->post('/product', function ($request, $response, $args){
    $prodObj = new Create('marketzone');
    $data = $request->getParsedBody(); 
    $Producto = (object)$data;
    $prodObj->add($Producto);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->put('/product', function ($request, $response, $args){
    $prodObj = new Update('marketzone');
    $input = $request->getBody()->getContents();
    $data = json_decode($input, true);
    $Producto = (object)$data;
    $prodObj->edit($Producto); 
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/busq', function ($request, $response, $args){
    $prodObj = new Read('marketzone');
    $params = $request->getQueryParams();
    $id = $params['id'];
    $prodObj->busq($id);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});
$app->delete('/product/{id}', function ($request, $response, $args){
    $prodObj = new Delete('marketzone');
    $id = $args['id'];
    $prodObj->delete($id);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/search', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $data = $request->getQueryParams();
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

$app->get('/products', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $prodObj->list();
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
?>
