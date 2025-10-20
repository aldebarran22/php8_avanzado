 <?php ob_start() ?>

      <form name="formBusqueda" action="index.php?ctl=buscar" method="POST">

          <table>
              <tr>
                  <td>nombre cliente:</td>
                  <td><input type="text" name="nombre" value="<?php echo $params['nombre']?>">(puedes utilizar '%' como comodín)</td>

                  <td><input type="submit" value="buscar"></td>
              </tr>
          </table>      
      </form>

      <?php if (count($params['resultado'])>0): ?>
      <table>
         <tr>
             <th>IdCliente</th>
             <th>Nombre</th>
             <th>Pais</th>
         </tr>
         <?php foreach ($params['resultado'] as $cliente) : ?>
             <tr>
                 <td><a href="index.php?ctl=ver&id=<?php echo $cliente['idcliente'] ?>"><?php echo $cliente['idcliente'] ?></a></td>
                 <td><?php echo $cliente['nombre'] ?></td>
                 <td><?php echo $cliente['pais'] ?></td>
             </tr>
         <?php endforeach; ?>

     </table>
      <?php endif; ?>

      <?php $contenido = ob_get_clean() ?>

      <?php include 'layout.php' ?>
