<?php
    require_once 'Categoria.php';
    require_once 'Producto.php';
    require_once 'ProductoDAO.php';

    if (isset($_REQUEST['categoria'])){
        $categoria = $_REQUEST['categoria'];

        // Prueba con la conexión:
        $pdo = new PDO("mysql:host=localhost;dbname=empresa3;charset=utf8mb4", 'root', 'antonio', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
        ]);

        // Construye un dao:
        $dao = new ProductoDAO($pdo);
        $productos = $dao->select($categoria);   

        $combo = "<select id='producto' name='producto'>";
        foreach($productos as $p) {
            $combo .= "<option value='".$p->getId()."'>".$p->getNombre()."</option>";
        }
        $combo .= "</select>";
       
    } else {
        $combo = "<select id='producto' name='producto'></select>";
    }
    echo $combo;
?>