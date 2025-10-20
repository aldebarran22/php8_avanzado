<?php
// Fechas:

$fecha = date("Y-m-d");
$txt = implode("_", getdate());
$bisiesto = (checkdate(2,29,2025)) ? "si" : "no";
$ahora = getdate();
$yy = $ahora['year'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Fechas</h3>
    <p>hoy es: <?=$fecha?></p>
    <p><?=$txt?></p>
    <p>Año <?=$yy?> bisiesto:<?=$bisiesto?></p>
    <h6>Copyright &copy; 2025</h6>
</body>
</html>