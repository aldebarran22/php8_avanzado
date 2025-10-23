<?php
    require_once __DIR__ . "/ProductoDAO.php";

    // Crear la conexión:
    $dao = new ProductoDAO("localhost","empresa3","root","antonio");
    $productos = $dao->select();

    $id = 0;
    $producto = new Producto(0, "Trina Manzana", 
    new Categoria(1, "Bebidas"),2.55, 10);

    if ($dao->create($producto)){
        $id = $producto->getId();
        echo "Producto creado con el id: " . $id . "<br>";
    } else {
        echo "No se ha podido crear<br>";
    }

    if ($dao->delete(93)){
         echo "Producto borrado<br>";
    } else {
        echo "No se ha podido borrar<br>";
    }

    $producto = $dao->read(1);
    if (is_null($producto))
        echo "No existe el producto<br>";
    else {
        echo "Producto: <br>";
        echo $producto;

        // Cambiar campos del objeto y actualizar:
        $producto->setExistencias(25);
        $producto->setPrecio(3.5);
        
        if ($dao->update($producto)){
            echo "Producto actualizado<br>";
        } else {
            echo "No se ha podido actualizar<br>";
        }

    }

    $categorias = $dao->selectCategorias();
    var_dump($categorias);
?>