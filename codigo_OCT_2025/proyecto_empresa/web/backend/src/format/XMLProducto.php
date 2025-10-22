<?php
namespace App\format;

use App\dao\ProductoDAO;
use App\data\Categoria;
use App\data\Producto;

class XMLProducto {

    private string $path;
    private ProductoDAO $dao;

    public function __construct(string $path, ProductoDAO $dao){
        $this->path = $path;
        $this->dao = $dao;
    }

    public function exportar(?string $categoria=null):void{
        $productos = $this->dao->select($categoria);

        // Crear el documento XML:
        $doc = new \DOMDocument();

        $root = $doc->createElement('productos');
        $doc->appendChild($root);

        foreach($productos as $p){
            // Crear un nodo por cada producto:
            $nodoP = $doc->createElement('producto');
            $nodoP->setAttribute("id",$p->getId());

            // Rellenar los datos
            $nombre = $doc->createElement('nombre');
            $nombre->appendChild($doc->createTextNode($p->getNombre()));
            $nodoP->appendChild($nombre);

            $cat = $doc->createElement('categoria');
            $cat->appendChild($doc->createTextNode($p->getCategoria()->getNombre()));
            $nodoP->appendChild($cat);

            $precio = $doc->createElement('precio');
            $precio->appendChild($doc->createTextNode($p->getPrecio()));
            $nodoP->appendChild($precio);

            $existencias = $doc->createElement('existencias');
            $existencias->appendChild($doc->createTextNode($p->getExistencias()));
            $nodoP->appendChild($existencias);

            // Anexar a la raiz:
            $root->appendChild($nodoP);
        }
        $doc->save($this->path);    
        echo "Fichero generado: ".$this->path;
    }    
}
?>