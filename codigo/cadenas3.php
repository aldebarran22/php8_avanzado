<?php
echo "<p>qs:".$_SERVER['QUERY_STRING']."</p>";

if (strcmp($_SERVER['QUERY_STRING'],'')==0)
    echo "No hay querystring";

else {
    $qs = $_SERVER['QUERY_STRING'];
    $arr = [];
    parse_str($qs, $arr);
    echo $arr['nombre'] . " " . $arr['curso'];
}
?>