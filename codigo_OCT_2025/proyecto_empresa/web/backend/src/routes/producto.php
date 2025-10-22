<?php
use Slim\App;
use App\controllers\ProductoController;
use App\dao\ProductoDAO;

return function(App $app, PDO $pdo){
	$dao = new ProductoDAO($pdo);
	$controller = new ProductoController($dao);

	// Definicion de rutas:
	$app->get('/productos', [$controller, 'getAll']);
	
    //$app->post('/productos', [$controller, 'save']);
	//$app->get('/productos/{id}', [$controller, 'getById']);
	//$app->delete('/productos/{id}', [$controller, 'delete']);
	//$app->put('/productos', [$controller, 'update']);
}

?>