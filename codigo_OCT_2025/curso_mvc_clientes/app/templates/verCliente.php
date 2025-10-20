<?php ob_start() ?>
 <h1><?php echo $params['nombre'] ?></h1>
 <table border="1">
     <tr>
         <td>IdCliente</td>
         <td><?php echo $cliente['idcliente'] ?></td>
     </tr>
     <tr>
         <td>Nombre</td>
         <td><?php echo $cliente['nombre']?></td>
     </tr>
     <tr>
         <td>Pais</td>
         <td><?php echo $cliente['pais']?></td>
     </tr>    
 </table>
 <?php $contenido = ob_get_clean() ?>
 <?php include 'layout.php' ?>