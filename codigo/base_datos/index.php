<?php
    require_once __DIR__ . "/ProductoDAO.php";

    // Crear la conexión:
    $dao = new ProductoDAO("localhost","empresa3","root","antonio");
    $productos = $dao->select();

    var_dump($productos);

    $producto = new Producto(0, "Trina Manzana", 
    new Categoria(1, "Bebidas"),2.55, 10);
    
    if ($dao->create($producto)){
        echo "Producto creado con el id: " . $producto->getId() . "<br>";
    } else {
        echo "No se ha podido crear<br>";
    }
?>