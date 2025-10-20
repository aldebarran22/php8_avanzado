<?php ob_start() ?>

 <table>
     <tr>
         <th>Id Cliente</th>
         <th>Nombre</th>
         <th>Pais</th>
     </tr>
     <?php foreach ($params['clientes'] as $cliente) :?>
     <tr>
         <td><a href="index.php?ctl=ver&id=<?php echo $cliente['idcliente']?>"><?php echo $cliente['idcliente'] ?></a></td>
         <td><?php echo $cliente['nombre']?></td>
         <td><?php echo $cliente['pais']?></td>
     </tr>
     <?php endforeach; ?>

 </table>
 <?php $contenido = ob_get_clean() ?>
 <?php include 'layout.php' ?>
