<?php
// Prueba de las clases data
require __DIR__ . "/../../vendor/autoload.php";

use App\data\Producto;
use App\data\Categoria;
use App\dao\ProductoDAO;
use App\format\XMLProducto;
use App\format\JSONProducto;

// Prueba con la conexión:
$pdo = new PDO("mysql:host=localhost;dbname=empresa3;charset=utf8mb4", 'root', 'antonio', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
]);

// Construye un dao:
$dao = new ProductoDAO($pdo);
$xml = new XMLProducto("productos.xml", $dao);
$xml->exportar();

$json = new JSONProducto("productos.json", $dao);
$json->exportar();
?>
