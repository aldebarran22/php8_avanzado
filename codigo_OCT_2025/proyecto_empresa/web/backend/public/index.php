<?php

// Esta deberia de funciona, pero no funciona!!!
//require realpath(__DIR__ . '/../../../../vendor/autoload.php');

require 'D:/apache/Apache24/htdocs/php8_avanzado/proyecto_empresa/vendor/autoload.php';

use Slim\Factory\AppFactory;


// Crear la aplicacion de Slim
$app = AppFactory::create();

// Establecer una ruta base: SOLO NECESARIO SI NO SE MONTAR VIRTUAL HOSTS
$app->setBasePath('/php8_avanzado/proyecto_empresa/web/backend/public');

// CORS Middleware
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*') // o 'http://localhost:5173' Vue.JS
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});


// Para procesar rutas y errores:
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);


// Crear la conexion:
$pdo = new PDO("mysql:host=localhost;dbname=empresa3", "root", "antonio",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

// Cargar rutas como una funcion:
(require __DIR__ . '/../src/routes/producto.php')($app, $pdo);

// Esto se añade para comprobar posibles errores en las rutas:
// luego comentar:
/*
$app->add(function ($request, $handler) {
    error_log('Metodo recibido: ' . $request->getMethod());
    return $handler->handle($request);
});*/

// Poner en marcha el servidor:
$app->run();
?>