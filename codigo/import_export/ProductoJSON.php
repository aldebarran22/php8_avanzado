<?php
require_once __DIR__ . "/Producto.php";

class ProductoJSON {

    public static function save(string $path, array $productos):void{
        
        // Convertir el array de objetos producto a un array de arrays asociativos:
        $productos_array = array_map(fn($p)=>$p->toArray(), $productos);

        // Codifica a formato json
        $json = json_encode($productos_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Grabar a un fichero:
        file_put_contents($path, $json);
    }

    public static function load(string $path):array {
        return array();
    }
}
?>