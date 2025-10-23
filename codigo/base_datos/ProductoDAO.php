<?php
require_once __DIR__ . "/Producto.php";

/* operaciones CRUD:

C -> create -> insert into
R -> read -> select pk
U -> update -> update
D -> delete -> delete pk
select()
*/

class ProductoDAO  {
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

    function create(Producto &$p):bool {
        $sql = "insert into productos(nombre, idcategoria, precio, existencias) ".
        " values(:nombre, :idcategoria, :precio, :existencias)";

        // Crear la sentencia con el SQL
        $stmt = $this->pdo->prepare($sql);
            
        $stmt->bindValue(":nombre", $p->getNombre(), PDO::PARAM_STR);
        $stmt->bindValue(":idcategoria", $p->getCategoria()->getId(),PDO::PARAM_INT);
        $stmt->bindValue(":precio", $p->getPrecio(), PDO::PARAM_STR);
        $stmt->bindValue(":existencias", $p->getExistencias(), PDO::PARAM_INT);

        // Ejecutar:
        $stmt->execute();

        
    
        return true;
    }

    function read(int $id):?Producto {
        return null;
    }

    function delete(int $id):bool {
        return true;
    }

    function update(Producto $p):bool {
        return true;
    }

    function select():array {
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
?>