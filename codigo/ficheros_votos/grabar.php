<?php
/* Recoger el nombre del candidato votado y agregarlo al fichero */

function sanitizacion(string $cadena):string {
    // Funcion que limpia los caracteres especiales.
    return htmlspecialchars($cadena, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if (isset($_REQUEST['nombre']) ){
    $nombre = sanitizacion($_REQUEST['nombre']);
    $candidatos = array('Miguel','Gabriel','Concepcion','Julia');

    if (in_array($nombre, $candidatos)){
        $fich = fopen("votos.txt", "at");
        fputs($fich, $nombre."\n");
        fclose($fich);

        header('location: index.html');
    } else {
        echo "<h3>No es un candidato válido</h3>";
    }

} else {
        echo "<h3>No es un candidato válido</h3>";
}
?>