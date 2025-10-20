<?php
function sanitizacion(string $cadena):string {
    // Funcion que limpia los caracteres especiales.
    return htmlspecialchars($cadena, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

echo "<p>qs:".$_SERVER['QUERY_STRING']."</p>";

if (strcmp($_SERVER['QUERY_STRING'],'')==0)
    echo "No hay querystring";

else {
    $qs = $_SERVER['QUERY_STRING'];
    $arr = [];
    parse_str($qs, $arr);
    echo $arr['nombre'] . " " . $arr['curso'];

    echo "type de qs: ".gettype($qs)."<br>";
    echo "type de arr: ".gettype($arr)."<br>";

}

$cad = "<script>alert('hola')</script>";
echo $cad; // ojo interpreta
echo sanitizacion($cad); // lo deja como una cadena
?>