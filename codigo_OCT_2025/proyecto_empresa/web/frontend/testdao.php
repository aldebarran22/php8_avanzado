<?php
// Prueba de las clases data
require __DIR__ . "/../../vendor/autoload.php";

use App\data\Producto;
use App\data\Categoria;
use App\dao\ProductoDAO;

// Prueba con la conexión:
$pdo = new PDO("mysql:host=localhost;dbname=empresa3;charset=utf8mb4", 'root', 'antonio', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
]);

// Construye un dao:
$dao = new ProductoDAO($pdo);
$producto = $dao->read(1);
$productos = $dao->select("bebidas");

//$nuevo = new Producto(0, 'Trina2', new Categoria(1, 'bebidas'), 2.5, 100);
//$n = $dao->create($nuevo);

//$nuevo = $dao->read(93);
//$nuevo->setPrecio(3.55);
//$n2 = $dao->update($nuevo);

//$n3 = $dao->delete(93);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Prueba con el DAO</h3>  
    <p>Producto: <?=$producto?></p>
    <table>
        <?php foreach($productos as $p){ ?>
        <tr>
            <td><?=$p->__toString()?></td>
        </tr>
        <?php } ?>
    </table>
    <!--<p>Nuevo producto: <?=$n?></p>-->
    <!--<p>actualizar producto: <?=$n2?></p>-->
    <!--<p>Borrado: <?=$n3?></p>-->
</body>
</html>