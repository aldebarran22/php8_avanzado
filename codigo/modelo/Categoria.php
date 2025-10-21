<?php
class Categoria {

    // Atributos:
    private int $id;
    private string $nombre;

    public function __construct(int $id=0, string $nombre=''){
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // set / get
    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setId(int $id):void {
        $this->id = $id;
    }

    public function setNombre(string $nombre):void{
        $this->nombre = $nombre;
    }

    public function __toString():string {
        return $this->id . " " . $this->nombre;
    }

    public function toArray():array {
        return [
            "id"=>$this->id,
            "nombre"=>$this->nombre
        ];
    }

    public static function create(array $cat): Categoria {
        // Construye una categoria a partir de un array:
        return new Categoria((int)$cat[0], $cat[1]);
    }

    public function __destruct(){

    }
}
?>