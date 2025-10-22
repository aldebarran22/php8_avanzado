<?php
namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\dao\ProductoDAO;
use App\data\Producto;

class ProductoController {
	private ProductoDAO $dao;

	public function __construct(ProductoDAO $dao) {
		$this->dao = $dao;
	}

	public function getAll(Request $request, Response $response): Response {
		$registros = $this->dao->select();
		$data = array_map(fn($reg) => [
			'id' => $reg->getId(),
            'nombre' => $reg->getNombre(),
            'categoria' => $reg->getCategoria()->getNombre(),
            'precio' => $reg->getPrecio(),
            'existencias' => $reg->getExistencias()
		], $registros);
		$response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
		return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
	}

    /*
	public function getById($request, Response $response, array $args): Response {
		$id = (int) $args['id'];
		$reg = $this->dao->read($id);

		if (!$reg) {
			$response->getBody()->write(json_encode(['error' => 'No encontrado']));
			return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
		}

		$data = [
			'id' => $reg->getId(),'iduser' => $reg->getIduser(),'color' => $reg->getColor(),'descripcion' => $reg->getDescripcion()
		];
		$response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
		return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
	}
    
	public function save($request, Response $response, array $args): Response {
		$data = ['save' => 1];
		$payload = json_encode($data);
		$response->getBody()->write($payload);
		return $response->withHeader('Content-Type', 'application/json');
	}

	public function delete($request, Response $response, array $args): Response {
		$data = ['delete' => 1];
		$payload = json_encode($data);
		$response->getBody()->write($payload);
		return $response->withHeader('Content-Type', 'application/json');
	}

	public function update($request, Response $response, array $args): Response {
		$data = ['update' => 1];
		$payload = json_encode($data);
		$response->getBody()->write($payload);
		return $response->withHeader('Content-Type', 'application/json');
	}*/

}

?>
