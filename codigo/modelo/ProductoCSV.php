<?php
require_once __DIR__ . "/Producto.php";

class ProductoCSV {

    public static function save(string $path, array $productos):void{
        // Recibe la colección de productos y graba en un CSV:
        $cabs = array();
        $primera = true;

        $fich = fopen($path, "wt");
        foreach($productos as $p){
            $fila = $p->toArrayExp();

            if ($primera){
                // Extraer las claves del array, las utilizamos
                // como cabeceras del fichero:
                $cabs = array_keys($fila);
              
                fputcsv($fich, $cabs);
                $primera = false;
            }
            
            fputcsv($fich, $fila);
        }
        fclose($fich);
    }

    public static function load(string $path):array {
        // Carga un CSV y devuelve una colección de productos:
        $cabs = true; 
        $productos = [];

        // Fichero de productos:
        $fich = fopen($path, 'rt');

        while ($linea = fgetcsv($fich,1024)){ 
            if ($cabs){
                $cabs = false;

            } else {
                $producto = Producto::create($linea);
                $productos[] = $producto;
            }
        }
        fclose($fich);
        return $productos;
    }
}
?>