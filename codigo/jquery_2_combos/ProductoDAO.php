<?php
require_once 'BaseDAO.php';

class ProductoDAO extends BaseDAO {

    public function __construct(PDO $conexion) {
        parent::__construct($conexion);
    }

    public function create(Producto $p):bool {
        $sql = "insert into productos(nombre, idcategoria, precio, existencias) " .
        "values(:nombre, :idcategoria, :precio, :existencias)";

        // Preparar la consulta:
        $stmt = $this->conexion->prepare($sql);

        // Ejecutar el SQL indicando los parámetros: se pasan como un array asociativo
        $stmt->execute(
            [
                ':nombre'=>$p->getNombre(), 
                ':idcategoria'=>$p->getCategoria()->getId(),
                ':precio'=>$p->getPrecio(),
                ':existencias'=>$p->getExistencias()
            ]);

        $filasAfectadas = $stmt->rowCount();
        return $filasAfectadas > 0;
    }

    public function update(Producto $p):bool {
        $sql = "update productos set nombre=:nombre, idcategoria=:idcategoria, " .
        "precio=:precio, existencias=:existencias where id=:id";

        // Preparar la consulta:
        $stmt = $this->conexion->prepare($sql);

        // Ejecutar el SQL indicando los parámetros: se pasan como un array asociativo
        $stmt->execute(
            [
                ':nombre'=>$p->getNombre(), 
                ':idcategoria'=>$p->getCategoria()->getId(),
                ':precio'=>$p->getPrecio(),
                ':existencias'=>$p->getExistencias(),
                ':id'=>$p->getId()
            ]);

        $filasAfectadas = $stmt->rowCount();
        return $filasAfectadas > 0;
    }

    public function delete(int $id):bool {
        // Borrar el producto, y los pedidos asociados:
        try {
            $this->comenzarTransaccion();
            $sql = "delete from productos where id=:id";
            
            // Preparar la consulta:
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id'=>$id]); 
            $filasAfectadas = $stmt->rowCount();
            $this->confirmarTransaccion();

            return $filasAfectadas > 0;

        } catch (Exception $e){
            $this->revertirTransaccion();
        }
    }

    private function getSQL(): string {
        $sql = "select p.id as idpro, p.nombre as nombrep, c.id as idcat, c.nombre as nombrec, " .
        "p.precio, p.existencias from productos p inner join categorias c on " .
        "c.id = p.idcategoria ";
        return $sql;
    }

    public function read(int $id): ?Producto {
        // Puede devolver null si no encuentra el producto:
        $sql = $this->getSQL();
        $sql .= " where p.id = :id";

        // Preparar la consulta:
        $stmt = $this->conexion->prepare($sql);

        // Ejecutar el SQL indicando los parámetros: se pasan como un array asociativo
        $stmt->execute([':id' => $id]);

        // Leer: la \ antes de PDO es porque estamos dentro de un namespace personalizado,
        // en un namespace global no es necesario.
        $fila = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!is_null($fila)){
            // Crear primero la categoria
            $cat = new Categoria((int)$fila['idcat'], $fila['nombrec']);
            $prod = new Producto((int)$fila['idpro'], $fila['nombrep'], $cat, (float)$fila['precio'], (int)$fila['existencias']);
            return $prod;

        } else {
            // Si es null, lo retorna:
            return $fila;
        }
    }

    public function selectCategorias():array {
        $categorias = [];
        $sql = "select id, nombre from categorias order by 1";

        $stmt = $this->conexion->prepare($sql);            
        $stmt->execute();
        
        while (($fila = $stmt->fetch(\PDO::FETCH_ASSOC))){
            // Crear el objeto:
            $cat = new Categoria((int)$fila['id'], $fila['nombre']);
            $categorias[] = $cat;
        }

        return $categorias;
    }

    public function select(?string $categoria=null): array {
        // Si lo dejamos vacio, recupera todos los productos, si no
        // filtra por una categoria concreta.
        $productos = [];
        $sql = $this->getSQL();

        if (!is_null($categoria)){
            // Filtrar por una categoria:
            $sql .= " where c.nombre = :categoria";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':categoria'=>$categoria]);

        } else {
            // Van todos los productos:        
            // Preparar la consulta:
            $stmt = $this->conexion->prepare($sql);            
            $stmt->execute();
        }

        while (($fila = $stmt->fetch(\PDO::FETCH_ASSOC))){
            // Crear el objeto:
            $cat = new Categoria((int)$fila['idcat'], $fila['nombrec']);
            $prod = new Producto((int)$fila['idpro'], $fila['nombrep'], $cat, (float)$fila['precio'], (int)$fila['existencias']);

            $productos[] = $prod;
        }

        return $productos;
    }

}
?>
