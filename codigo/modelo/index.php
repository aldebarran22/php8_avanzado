<?php
    require_once __DIR__ . '/Categoria.php';

    // Crear un objeto:
    $cat1 = new Categoria(1, 'Bebidas');

    // Objeto->metodo()
    echo "categoria: " . $cat1->__toString() . "<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3><?=$cat1?></h3>
</body>
</html>