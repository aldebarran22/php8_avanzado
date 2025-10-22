<?php
namespace App\format;

use App\dao\ProductoDAO;
use App\data\Categoria;
use App\data\Producto;

class JSONProducto {

    private string $path;
    private ProductoDAO $dao;

    public function __construct(string $path, ProductoDAO $dao){
        $this->path = $path;
        $this->dao = $dao;
    }

    public function exportar(?string $categoria=null):void{
        $productos = $this->dao->select($categoria);
        
        $arrayProductos = array_map(fn($p)=>$p->toArray(), $productos);
        $json = json_encode($arrayProductos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($this->path, $json);
        echo "Fichero generado: ".$this->path;
    }
}
?>