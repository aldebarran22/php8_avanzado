<?php ob_start() ?>

 <?php if(isset($params['mensaje'])) :?>
 <b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
 <?php endif; ?>
 <br/>
 <form name="formInsertar" action="index.php?ctl=insertar" method="POST">
     <table>
         <tr>
             <th>Id Cliente</th>
             <th>Nombre</th>
             <th>Pais</th>          
         </tr>
         <tr>
             <td><input type="text" name="idcliente" value="<?php echo $params['idcliente'] ?>" /></td>
             <td><input type="text" name="nombre" value="<?php echo $params['nombre'] ?>" /></td>
             <td><input type="text" name="pais" value="<?php echo $params['pais'] ?>" /></td>           
         </tr>

     </table>
     <input type="submit" value="insertar" name="insertar" />
 </form>
 <?php $contenido = ob_get_clean() ?>
 <?php include 'layout.php' ?>