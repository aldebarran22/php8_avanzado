<?php
    function filtrar($pathPedidos, $pais, $pathSalida){
        // Filtra los pedidos de un pais y los guarda en otro
        // fichero.
        $fich = fopen($pathPedidos, "rt") or die('Error en el fichero de entrada');
        while ($linea = fgetcsv($fich,1024,';')){
            print_r($linea);
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