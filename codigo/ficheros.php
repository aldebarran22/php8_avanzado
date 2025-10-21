<?php
    function filtrar(string $pathPedidos, string $pais, string $pathSalida):bool{
        // Filtra los pedidos de un pais y los guarda en otro
        // fichero.
        $checkPais = true;
        $pos = 0;
        $pathPais = $pathSalida . '/' . $pais . ".csv";

        // Abrir ficheros: pedidos de lectura
        $fich = fopen($pathPedidos, "rt") or die('Error en el fichero de entrada');
        
        // Fichero de salida: pais.csv
        $fichOut = fopen($pathPais, 'wt');

        while ($linea = fgetcsv($fich,1024,';')){
            // Comprobar si las cabs tienen una columna pais:
            if ($checkPais){
                $pos = array_search('pais', $linea);
                if (!$pos){
                    // Viene un fichero que no tiene pais:
                    return false;
                }
                $checkPais = false;
               
            } else {
                // comprobar si el pedido es del pais que buscamos:
                if (strncasecmp($pais, $linea[$pos], strlen($pais))==0){
                    // Grabar en la salida:
                    fputcsv($fichOut, $linea, ';');
                }
            }
        
        }
        fclose($fich);
        fclose($fichOut);
        return true;
    }

    filtrar('ficheros/Pedidos.txt', 'Finlandia','out');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV</title>
</head>
<body>
    
</body>
</html>