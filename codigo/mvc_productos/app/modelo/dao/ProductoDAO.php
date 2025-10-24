<?php
require_once __DIR__ . "../data/Producto.php";


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

        // Obtener el último id:
        $nuevoId = $this->pdo->lastInsertId();
        $p->setId($nuevoId);

        // Obtener numero de filas afectadas:
        $filasAfectadas = $stmt->rowCount();    
        return $filasAfectadas > 0;
    }

    function read(int $id):?Producto {
        $sql = $this->getSQL() . " where p.id=:id";

        // Crear la sentencia con el SQL
        $stmt = $this->pdo->prepare($sql);            
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        // Ejecutar:
        $stmt->execute();

        $fila = $stmt->fetch();
        if ($fila){
            $cat = new Categoria((int)$fila['idc'], $fila['nombrec']);

            return new Producto((int) $fila["idp"], 
            $fila['nombrep'], $cat, (float)$fila['precio'], 
            (int)$fila['existencias']);

        } else {
            return null;
        }
    }

    function delete(int $id):bool {
        try {
            $this->pdo->beginTransaction(); // inicio de Tx:

            $sql = "delete from detallespedido where idproducto=:id";
            $sql2 = "delete from productos3 where id=:id";

            // Crear la sentencia con el SQL
            $stmt = $this->pdo->prepare($sql);            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $filasAfectadas = $stmt->rowCount();
            echo "detallesPedido: $filasAfectadas<br>"; 

            // Crear la sentencia con el SQL
            $stmt = $this->pdo->prepare($sql2);            
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $filasAfectadas += $stmt->rowCount();

            $this->pdo->commit(); // Confirma la Tx:
            echo "commit:<br>"; 

            return $filasAfectadas > 0;

        } catch(PDOException $e){
            $this->pdo->rollback(); // Revocar Tx.
            echo "rollback:<br>"; 
            throw $e;
            //throw new Exception("Error al borrar: " . $e->getMessage()); // Relanzar la excepcion.
        }
    }

    function update(Producto $p):bool {
         $sql = "update productos set nombre=:nombre, " .
         " idcategoria=:idcategoria, precio=:precio, " .
         " existencias=:existencias where id=:id";

        // Crear la sentencia con el SQL
        $stmt = $this->pdo->prepare($sql);  
        $stmt->bindValue(":nombre", $p->getNombre(), PDO::PARAM_STR);
        $stmt->bindValue(":idcategoria", $p->getCategoria()->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":precio", $p->getPrecio(), PDO::PARAM_STR);
        $stmt->bindValue(":existencias", $p->getExistencias(), PDO::PARAM_INT);
        $stmt->bindValue(":id", $p->getId(), PDO::PARAM_INT);

        // Ejecutar:
        $stmt->execute();

        $filasAfectadas = $stmt->rowCount();
        return $filasAfectadas > 0;
    }

    private function getSQL(){
        return "SELECT p.id as idp, p.nombre as nombrep, " .
        " c.id as idc, c.nombre as nombrec, p.precio, p.existencias " .
        " FROM productos p inner join categorias c " .
        " on c.id = p.idcategoria";
    }

    function selectCategorias():array {
        $categorias = array();
        $sql = "select id, nombre from categorias order by 1";

        // Crear la sentencia con el SQL
        $stmt = $this->pdo->prepare($sql);

        // Ejecutar el sql
        $stmt->execute();

        $resultados = $stmt->fetchAll();
        foreach ($resultados as $fila) {
            $cat = new Categoria((int)$fila['id'], $fila['nombre']);
            $categorias[] = $cat;
        }
        return $categorias;
    }

    function select():array {
        $productos = array();
        $sql = $this->getSQL();

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