<?php
 // carga del modelo y los controladores
 require_once __DIR__ . '/../app/Config.php';
 require_once __DIR__ . '/../app/modelo/dao/ProductoDAO.php';
 require_once __DIR__ . '/../app/Controlador.php';
 

 // enrutamiento
 $map = array(
     'inicio' => array('controller' =>'Controller', 'action' =>'inicio'),
     'nuevoproducto' => array('controller' =>'Controller', 'action' =>'nuevoProducto'),
     'grabarproducto' => array('controller' =>'Controller', 'action' =>'grabarProducto'),
     'buscarproductos' => array('controller' =>'Controller', 'action' =>'buscadorProductos'),
     'listarproductos' => array('controller' =>'Controller', 'action' =>'listarProductos')
 );

 // Analizar la ruta:
 if (isset($_GET['action'])) {
     if (isset($map[$_GET['action']])) {
         $ruta = $_GET['action'];

     } else {
         header('Status: 404 Not Found');
         echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                 $_GET['action'] .
                 '</p></body></html>';
         exit;
     }
 } else {
     $ruta = 'inicio';
 }

  $controlador = $map[$ruta];
 // Ejecucion del controlador asociado a la ruta

 if (method_exists($controlador['controller'],$controlador['action'])) {
     call_user_func(array(new $controlador['controller'], $controlador['action']));
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: El controlador <i>' .
             $controlador['controller'] .
             '->' .
             $controlador['action'] .
             '</i> no existe</h1></body></html>';
 }
 ?>