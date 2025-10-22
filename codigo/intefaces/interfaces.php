<?php
interface Operaciones {

    function grabar(string $path):void;
    function cargar(string $path):array;
}

class Ficheros implements Operaciones {

    function grabar(string $path):void{
         echo "grabar a fichero<br>";
    }
    function cargar(string $path):array{
        echo "cargar de fichero<br>";
        return array();
    }
}

class BaseDatos implements Operaciones {

    function grabar(string $path):void{
        echo "grabar a BD<br>";
    }

    
    function cargar(string $path):array{
         echo "cargar de BD<br>";
        return array(); 

    }
}

function operar(Operaciones $op){
    $datos = $op->cargar("datos.csv");
    $op->grabar("datos2.csv");
}

operar(new Ficheros());
operar(new BaseDatos());
?>