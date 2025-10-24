<?php
require_once __DIR__ . "/modelo/dao/ProductoDAO.php";
require_once __DIR__ . "/Config.php";

class Controller {

    public function inicio(){
        // Muestra la pantalla principal de la Web.

        // Mostrar la vista:
        require __DIR__ . "/templates/inicio.php";
    }

    public function nuevoProducto(){
        // Muestra un form de nuevo producto
        // Necesita el listado de categorias

        // Solicita los datos al modelo:
        $dao = new ProductoDAO(Config::mvc_bd_hostname, Config::mvc_bd_nombre, 
                               Config::mvc_bd_usuario, Config::mvc_bd_clave);
        $categorias = $dao->selectCategorias();

        // Cargar los parámetros:
        $params = array("categorias"=>$categorias);

        // Mostrar una vista:
        require __DIR__ . "/templates/form_producto.php";
    }

    public function grabarProducto(){
        // Graba los datos del producto en la BD
    }

    public function buscadorProductos(){
        // Muestra el form buscador y necesita las categorias

        require __DIR__ . "/templates/form_buscador_productos.php";
    }

    public function listarProductos(){
        // Muestra una colección de productos.

        require __DIR__ . "/templates/listado_productos.php";
    }
}
?>