 <!DOCTYPE html>
 <html lang="en">
    <head>
         <title>MVC CLIENTES</title>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
     </head>
     <body>
         <div id="cabecera">
             <h1>Aplicación de Gestión de Clientes</h1>
         </div>

         <div id="menu">
             <hr/>
             <a href="index.php?ctl=inicio">Inicio</a> |
             <a href="index.php?ctl=listar">Listar</a> |
             <a href="index.php?ctl=insertar">Nuevo cliente</a> |
             <a href="index.php?ctl=buscar">buscar por nombre</a>       
             <hr/>
         </div>

         <div id="contenido">
             <?php echo $contenido ?>
         </div>

         <div id="pie">
             <hr/>
             <div align="center">&copy; copyright - Curso de PHP - 2016</div>
         </div>
     </body>
 </html>