<?php
    echo "<p>Numero de ficheros: " . count($_FILES) . "</p>";
    foreach ($_FILES as $k => $info_file){
        echo "FICHERO $k<br>";

        foreach($info_file as $k2 => $info){
            echo "$k2 => $info<br>";
        }
        echo "<hr>";
    }

    // Para grabar los ficheros:
    foreach ($_FILES as $k => $info_file){
        if (is_uploaded_file($_FILES[$k]['tmp_name'])){
            // Si ha subido correctamente:
            
            $path = $_SERVER['DOCUMENT_ROOT'] . "/curso_php8/almacen/" . $_FILES[$k]['name'];
            move_uploaded_file($_FILES[$k]['tmp_name'], $path);
        }
    }
?>