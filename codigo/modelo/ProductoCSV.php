<?php
require_once __DIR__ . "/Producto.php";

class ProductoCSV {

    public static function load(string $path):array {
        $productos = [];

        // Fichero de productos:
        $fich = fopen($path, 'rt');

        while ($linea = fgetcsv($fich,1024)){ 
            $producto = Producto::create($linea);
            $productos[] = $producto;
        }
        fclose($fich);
        return $productos;
    }
}
?>