<?php 
$meses = ["ene","feb","mar","abr","may","jun"];
$texto = "id;empresa|1;Speedy Express|2;United Package|3;Federal Shipping";

$filas = explode("|",$texto);
$matriz = [];
foreach($filas as $f){
    $matriz[] = explode(";", $f);
}
//var_dump($matriz);
//echo "<br>";
//print_r($matriz);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Pruebas con cadenas</h3>
    <select name="meses" id="meses">
        <?php foreach($meses as $mes){ ?>
            <option value="<?=$mes?>"><?=$mes?></option>
        <?php } ?>
    </select>
    <br>
    <table>
        <?php foreach($matriz as $fila){ ?>
            <tr>
                <?php foreach($fila as $col){ ?>
                    <td><?=$col?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</body>
</html>