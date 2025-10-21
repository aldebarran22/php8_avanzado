<?php
if (isset($_REQUEST['n'])){
    $n = $_REQUEST['n'];
    if (is_numeric($n)){
        $n = ($n >= 1 && $n <= 10) ? $n : 5;

    } else {
        $n = 1;
    }

} else {
    // Si no hay parametro, por defecto 1 fich.
    $n = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="recibir.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="20000">
        <?php for($i=1; $i <= $n ; $i++){ ?>
            <div>
                <label for="fich<?=$i?>">Fichero: <?=$i?></label>
                <input type="file" name="fich<?=$i?>" id="fich<?=$i?>">
            </div>
        <?php } ?>
        <input type="submit" value="SUBIR">
    </form>
</body>
</html>
