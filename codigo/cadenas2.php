<?php
    $d = 1;
    $m = 9;
    $y = 2025;

    $valor = 6.567;
    $mensaje = "hola";

    printf("%02d-%02d-%04d<br>", $d, $m, $y);
    printf("%f  %.2f<br>", $valor, $valor);
    printf("%10s %.2s", $mensaje, $mensaje);

    // A partir de un nombre compuesto dividirlo en nombre y apellidos
    $nombreCompleto = "Juan Gomez Perez";

    // Extraer las 3 partes del nombre:
    $pos = strpos($nombreCompleto, " ");
    $pos2 = strrpos($nombreCompleto, " ");
    echo "<p>$nombreCompleto</p>";
    echo "<p>$pos</p>";
    echo "<p>$pos2</p>";
    $nom = substr($nombreCompleto, 0, $pos);
    $ape1 = substr($nombreCompleto, $pos+1, $pos2-$pos);
    $ape2 = substr($nombreCompleto, $pos2+1);
    echo "$nom<br>";
    echo "$ape1<br>";
    echo "$ape2<br>";
?>