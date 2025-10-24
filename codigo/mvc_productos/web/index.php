<?php
 // carga del modelo y los controladores
 require_once __DIR__ . '/../app/Config.php';
 require_once __DIR__ . '/../app/Model.php';
 require_once __DIR__ . '/../app/Controller.php';
 

 // enrutamiento
 $map = array(
     'inicio' => array('controller' =>'Controller', 'action' =>'inicio'),
     'listar' => array('controller' =>'Controller', 'action' =>'listar'),
     'insertar' => array('controller' =>'Controller', 'action' =>'insertar'),
     'buscar' => array('controller' =>'Controller', 'action' =>'buscarPorNombre'),
     'ver' => array('controller' =>'Controller', 'action' =>'ver')
 );
 ?>