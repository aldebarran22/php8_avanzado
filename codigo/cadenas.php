<?php 
$meses = ["ene","feb","mar","abr","may","jun"];
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
</body>
</html>