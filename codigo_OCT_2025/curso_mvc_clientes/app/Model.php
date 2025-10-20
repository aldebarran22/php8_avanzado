 <?php 
 class Model {
    protected $conexion;

    public function __construct($dbname,$dbuser,$dbpass,$dbhost){
        try {
            $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
            ]);

            $this->conexion = $pdo;

        } catch (PDOException $e){
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function dameClientes(): array{
        $clientes = [];
        $sql = "select idcliente,nombre,pais from clientes order by nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        while (($fila = $stmt->fetch(PDO::FETCH_ASSOC))){
            $clientes[] = $fila;
        }
        return $clientes;
    }

    public function buscarClientesPorNombre($nombre):array {
        $clientes = [];
        $nombre = htmlspecialchars($nombre);
        $sql = "select idcliente,nombre,pais from clientes where nombre like :nombre order by nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':nombre'=>$nombre]);
        
        while (($fila = $stmt->fetch(PDO::FETCH_ASSOC))){
            $clientes[] = $fila;
        }
        return $clientes;
    }

    public function dameCliente($id):?array {
        $id = htmlspecialchars($id);
        $sql = "select idcliente,nombre,pais from clientes where idcliente=:id";       
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id'=>$id]);
        $fila = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!is_null($fila))
            return $fila;
        else 
            return null;
    }

    public function insertarClientes($i, $n, $p){
        $i = htmlspecialchars($i);
        $n = htmlspecialchars($n);
        $p = htmlspecialchars($p);
      
        $sql = "insert into clientes(idcliente, nombre, pais) values(:idcliente, :nombre, :pais)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':idcliente'=>$i,':nombre'=>$n,':pais'=>$p]);
        return $stmt->rowCount();
    }

    public function validarDatos($id,$n,$p){
         return (is_string($id) & is_string($id) & is_string($id));                
    }
 }
 ?>
