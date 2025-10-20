<?php
define("PATH_FOTOS", "fotos");

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

function galeria(array $imagenes, int $numCols): array {
    // Devuelve un array de arrays con tantas posiciones
    //como columnas hayamos indicado.
    return array_chunk($imagenes, $numCols);
}

if (isset($_REQUEST['cols'])){
    $visible = true;
    $cols = $_REQUEST['cols'];
    $fotos = galeria(cargarImagenes(PATH_FOTOS), $cols);

} else {
    $visible = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img {
            width:100px;
            margin-left: 20px;
            margin-right: 20px;

        }

        #contenedor {
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>  
    <div id="contenedor">
        <h3>Formulario</h3>
        <form action="#" method="post">
            <label for="cols">Columnas</label>
            <input type="text" name="cols" id="cols">
            <input type="submit" value="Enviar">
        </form>
        <?php if ($visible){ ?>
            <h3>Galería de imágenes</h3>
            <?php foreach($fotos as $fila){ ?>
                <div>
                    <?php foreach($fila as $foto){ ?>
                        <img src="fotos/<?=$foto?>">
                    <?php } ?>
                </div>
            <?php } ?>
         <?php } ?>
    </div>
</body>
</html>