<?php
	// Calcular el numero de votos por candidato y representarlo graficamente
  $votos = file('votos.txt');
  $candidatos = array('Miguel'=>0,
                      'Gabriel'=>0,
                      'Concepcion'=>0,
                      'Julia'=>0);

  foreach($votos as $voto){
    $candidatos[chop($voto)]++;
  }
  // ojo, no cambia indices (es asociativo)
  arsort($candidatos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuento de Votos</title>
  <style>
    #contenedor {
      margin:20px auto;
      text-align: center;
      width: 80%;
    }

    table {
      margin-left: auto;
      margin-right: auto;
      width: 300px;
    }

    .izq {
      text-align: left;
    }
  </style>
</head>
<body>
  <div id="contenedor">
  <h2>Resultados de los candidatos</h2>
  <table>
    <?php foreach($candidatos as $k => $v){ ?>
      <tr>
        <td class="izq"><?=$k?></td>
        <td><?=$v?></td>
        <td class="izq">
          <img src="rojo.gif" height="10px" width="<?=20 * $v?>px">
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>
