<?php
require_once __DIR__ . "/ProductoCSV.php";
require_once __DIR__ . "/ProductoJSON.php";

interface Operaciones {

    function grabar(array $productos, ?string $pathOut=null):void;
    function cargar():array;
}

class Ficheros implements Operaciones {

    private string $path;
        
    function __construct(string $path){
        $this->path = $path;
    }

    function grabar(array $productos, ?string $pathOut=null):void {
        if (is_null($pathOut)){
            throw new Exception("Falta el path de salida");
        }

        // Extraer la extension del path:
        $ext = strtolower(pathinfo($pathOut, PATHINFO_EXTENSION));

        switch($ext){
            case "csv":
                ProductoCSV::save($pathOut, $productos);
                break;

            case "json":
                ProductoJSON::save($pathOut, $productos);
                break;

            case "xml":
                break;
        }
    }

    function cargar():array{
        // Extraer la extension del path:
        $ext = strtolower(pathinfo($this->path, PATHINFO_EXTENSION));

        switch($ext){
            case "csv":
                return ProductoCSV::load($this->path);
               
            case "json":
                return ProductoJSON::load($this->path);
               
            default:
                return array();

          }
    }
}

class BaseDatos implements Operaciones {

    private PDO $pdo;

    function __construct($host, $bd, $user, $pwd){
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$bd;charset=utf8mb4", $user, $pwd, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // lanza excepciones en errores
            ]);
            $this->pdo = $pdo;          

        } catch (PDOException $e) {
            throw $e;
        }
    }

    function grabar(array $productos,  ?string $pathOut=null):void{
        $sql = "insert into productos2(nombre, idcategoria, precio, existencias) ".
        " values(:nombre, :idcategoria, :precio, :existencias)";

        // Crear la sentencia con el SQL
        $stmt = $this->pdo->prepare($sql);

        foreach ($productos as $p){            
            $stmt->bindValue(":nombre", $p->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":idcategoria", $p->getCategoria()->getId(),PDO::PARAM_INT);
            $stmt->bindValue(":precio", $p->getPrecio(), PDO::PARAM_STR);
            $stmt->bindValue(":existencias", $p->getExistencias(), PDO::PARAM_INT);

            $stmt->execute();
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
            // Extraer los valores del array que viene de la consulta:
            $fila = array_values($resul);
            $producto = Producto::create($fila);
            $productos[] = $producto;
        }
        return $productos;
    }
}

function operar(Operaciones $op){
    $productos = $op->cargar();
    echo "Productos: " . count($productos);

}

function importar(string $path, string $host, string $bd, string $usr, string $pwd):void{
    $ficheros = new Ficheros($path);
    $productos = $ficheros->cargar();

    if (count($productos) > 0){
        $baseDatos = new BaseDatos($host, $bd, $usr, $pwd);
        $baseDatos->grabar($productos);
        echo count($productos) . " productos importados<br>";

    } else {
        echo "No se ha podido importar los productos<br>";
    }
}

function exportar(string $path, string $host, string $bd, string $usr, string $pwd):void{
    $baseDatos = new BaseDatos($host, $bd, $usr, $pwd);
    $productos = $baseDatos->cargar();

    if (count($productos) > 0){
        $ficheros = new Ficheros($path);
        $ficheros->grabar($productos);
        echo "Se han exportado: " . count($productos) . " productos<br>";

    } else {
        echo "No se ha podido exportar los productos<br>";
    }
}

/*
importar("productos.csv", "localhost","empresa3","root","antonio");
exportar("productos2.csv", "localhost","empresa3","root","antonio");
*/

try {
    $ficheros = new Ficheros("productos.csv");
    $productos = $ficheros->cargar();
    $ficheros->grabar($productos, "productos.json");

    $ficheros = new Ficheros("productos.json");
    $productos = $ficheros->cargar();
    echo "Productos: " . count($productos);
    echo $productos[0];

} catch(Exception $e){
    echo $e->getMessage();
}
?>