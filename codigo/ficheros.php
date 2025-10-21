<?php
    function filtrar($pathPedidos, $pais, $pathSalida){
        // Filtra los pedidos de un pais y los guarda en otro
        // fichero.
        $checkPais = true;

        $fich = fopen($pathPedidos, "rt") or die('Error en el fichero de entrada');
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


            }
            
        }
        fclose($fich);
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