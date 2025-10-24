<?php

require_once __DIR__ . "/Categoria.php";

class Producto {

    // acceso tipo nombre_atributo
    private int $id;
	private string $nombre;
	private ?Categoria $categoria;
	private float $precio;
    private int $existencias;

	public function __construct(int $id = 0, string $nombre = "", ?Categoria $categoria=null,  float $precio = 0.0, int $existencias = 0){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->categoria = $categoria;
		$this->precio = $precio;
        $this->existencias = $existencias;
	}

    public static function create(array $arr):Producto {
        $arrCat = array_slice($arr, 2,2);
        $categoria = Categoria::create($arrCat);
        return new Producto((int)$arr[0],$arr[1],
            $categoria, (float)$arr[4],(int)$arr[5]);
    }

    public static function createPost(array $post):Producto{
        $producto = new Producto();

        if (isset($post['nombre']) && !empty($post['nombre'])){
            $producto->setNombre($post['nombre']);
        } else {
            throw new Exception("Nombre no válido");
        }

        if (isset($post['categoria']) && !empty($post['categoria'])){
            if (!is_int($post['categoria']))
                throw new Exception("Categoría no válida");

            $idcat = (int) $post['categoria'];
            $cat = new Categoria($idcat, '');
            $producto->setCategoria($cat);

        } else {
            throw new Exception("Categoría no válido");
        }

        if (isset($post['existencias']) && !empty($post['existencias'])){
            if (!is_int($post['existencias']))
                throw new Exception("Existencias no válidas");

            $exis = (int) $post['existencias'];
            $producto->setExistencias($exis);
            
        } else {
            throw new Exception("Existencias no válidas");
        }

        if (isset($post['precio']) && !empty($post['precio'])){
            if (!is_float($post['precio']))
                throw new Exception("Precio no válido");

            $precio = (float) $post['precio'];
            $producto->setprecio($precio);
            
        } else {
            throw new Exception("Precio no válido");
        }
    }

	public function getId():int {
		return $this->id;
	}

    public function setId(int $id):void {
        $this->id = $id;
    }

    public function getNombre():string {
        return $this->nombre;
    }

    public function setNombre(string $nombre):void {
        $this->nombre = $nombre;
    }

    public function getCategoria(): ?Categoria {
        return $this->categoria;
    }

    public function setCategoria($categoria): void {
        $this->categoria = $categoria;
    }

    public function getPrecio():float {
        return $this->precio;
    }

    public function setPrecio(float $precio):void {
        $this->precio = $precio;
    }

    public function getExistencias(): int {
        return $this->existencias;
    }

    public function setExistencias(int $existencias):void {
        $this->existencias = $existencias;
    }

    public function __toString(): string {
        return $this->id . " " . $this->nombre . " " . $this->categoria->__toString() . " " . $this->precio . " " . $this->existencias;
    }

    // modificacion posterior para la generación de formatos:
    public function toArray():array {
        return [
            "id"=>$this->id,
            "nombre"=>$this->nombre,
            "categoria"=>$this->getCategoria()->toArray(),
            "precio"=>$this->getPrecio(),
            "existencias"=>$this->getExistencias()        
        ];
    }

     public function toArrayExp():array {
        return [
            "id"=>$this->id,
            "nombre"=>$this->nombre,
            "idcategoria"=>$this->getCategoria()->getId(),
            "categoria"=>$this->getCategoria()->getNombre(),
            "precio"=>$this->getPrecio(),
            "existencias"=>$this->getExistencias()        
        ];
    }
}
?>