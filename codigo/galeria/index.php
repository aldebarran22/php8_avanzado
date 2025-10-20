<?php
function cargarImagenes(string $pathDir):array {
    $fotos = array();

    // Abrir el directorio:
    $dir = opendir($pathDir);
    while (($fich = readdir($dir))){
        if (preg_match("/\.jpg$/", $fich)){
            $fotos[] = $fich;
        }
    }
    // Cerrar el directorio
    closedir($dir);
    return $fotos;
}

$fotos = cargarImagenes("fotos");
print_r($fotos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>