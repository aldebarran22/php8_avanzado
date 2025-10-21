<?php
    require_once __DIR__ . '/Categoria.php';
    require_once __DIR__ . '/Producto.php';
     require_once __DIR__ . '/ProductoCSV.php';

    // Crear un objeto:
    $cat1 = new Categoria(1, 'Bebidas');
    print_r($cat1->toArray());
    echo "<br>";
    $p1 = new Producto(1, "CocaCola", $cat1, 2.6, 100);
    print_r($p1->toArray());
    $p1->setNombre("Cola Cola");
    echo "<br>";

    // Objeto->metodo()
    echo "Producto: " . $p1->__toString() . "<br>";

    $arr = array(2, 'Comidas');
    // Para llamar a un metodo static: NombreClase::nombreMetodoStatic
    $obj = Categoria::create($arr);
    echo "obj: " . $obj->__toString();

    // Para llamar a un metodo de instancia: objeto->nombreMetodo()

    ProductoCSV::load("productos.csv");

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