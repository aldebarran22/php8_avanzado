<?php
    echo "<p>Numero de ficheros: " . count($_FILES) . "</p>";
    foreach ($_FILES as $k => $info_file){
        echo "FICHERO $k<br>";

        foreach($info_file as $k2 => $info){
            echo "$k2 => $info<br>";
        }
        echo "<hr>";
    }
?>