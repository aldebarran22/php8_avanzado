<?php
// Prueba de las clases data
require __DIR__ . "/../../vendor/autoload.php";

use App\data\Producto;
use App\data\Categoria;

// Prueba con los objetos independientes:
$categoria = new Categoria(1, 'Bebidas');
$producto = new Producto(1, 'CocaCola', $categoria, 1.7, 100);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Prueba con las clases del namespace data</h3>
    <p>__DIR__: <?=__DIR__?></p>
    <p>Categoria: <?=$categoria?></p>
    <p>Producto: <?=$producto?></p>
</body>
</html>