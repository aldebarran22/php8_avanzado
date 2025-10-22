<?php
require_once __DIR__ . "/ProductoCSV.php";

interface Operaciones {

    //function grabar(string $path):void;
    function cargar():array;
}

class Ficheros implements Operaciones {

    private string $path;
        
    function __construct(string $path){
        $this->path = $path;
    }

    function cargar():array{
        return ProductoCSV::load($this->path);
    }
}

class BaseDatos implements Operaciones {

    private PDO $pdo;

    function __construct($host, $bd, $user, $pwd){
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$$bd;charset=utf8mb4", $user, $pwd, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
            ]);
            $this->pdo = $pdo;
          

        } catch (PDOException $e) {
            throw $e;
        }
    }
    
    function cargar():array {
        $productos = array();
        $sql = "SELECT p.id as idp, p.nombre as nombrep, " .
        " c.id as idc, c.nombre as nombrec, p.precio, p.existencias " .
        " FROM productos p inner join categorias c " .
        " on c.id = p.idcategoria";

        // Crear la sentencia con el SQL
        $stmt = $this->pdo->prepare($sql);

        // Ejecutar el sql
        $stmt->execute();

        // Recuperar los resultados:
        $resultados = $stmt->fetchAll();
        foreach ($resultados as $resul) {
            $producto = Producto::create($resul);
            $productos[] = $producto;
        }
        return $productos;
    }
}

function operar(Operaciones $op){
    $productos = $op->cargar();
    echo "Productos: " . count($productos);

}

operar(new Ficheros("productos.csv"));
//operar(new BaseDatos("localhost","empresa3","root","antonio"));
?>