<?php
require_once __DIR__ . "/../Config.php";
require_once __DIR__ . "/../modelo/data/Categoria.php";
require_once __DIR__ . "/../modelo/data/Producto.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC Productos</title>
    <link rel="stylesheet" href="css/<?=Config::$mvc_vis_css?>">
</head>
<body>
    <div id="contenedor">
        <header>
            <h3>Aplicación MVC Productos</h3>
        </header>
        <nav>
            <a href="index.php?action=inicio">Inicio</a>
            <a href="index.php?action=nuevoproducto">Nuevo Producto</a>
            <a href="index.php?action=buscarproductos">Buscar productos</a>
            <a href="index.php?action=listarproductos">Listado de productos</a>
        </nav>
        <div id="contenido">
            <?php echo $contenido; ?>
        </div>
        <footer>
            <h5>Curso PHP 8.2 Avanzado. &copy; 2025</h5>
        </footer>
    </div>
</body>
</html>