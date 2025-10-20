<?php

class Controller
 {

     public function inicio()
     {
         $params = array(
             'mensaje' => 'Ejemplo de MVC en PHP',
             'fecha' => date('d-m-Y'),
         );
         require __DIR__ . '/templates/inicio.php';
     }

     public function listar()
     {
         $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

         $params = array(
             'clientes' => $m->dameClientes(),         	
         );

         require __DIR__ . '/templates/mostrarClientes.php';
     }

     public function insertar()
     {
         $params = array(
             'idcliente' => '',
             'nombre' => '',
             'pais' => '',            
         );

         $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

             // comprobar campos formulario
             if ($m->validarDatos($_POST['idcliente'], $_POST['nombre'],$_POST['pais'])) {
             	
                 $m->insertarClientes($_POST['idcliente'], $_POST['nombre'], $_POST['pais']);
                 header('Location: index.php?ctl=listar');

             } else {
                 $params = array('idcliente' => $_POST['idcliente'],'nombre' => $_POST['nombre'],'pais' => $_POST['pais']);                                    
                 $params['mensaje'] = 'No se ha podido grabar el cliente. Revisa el formulario';
             }
         }

         require __DIR__ . '/templates/formInsertar.php';
     }

     public function buscarPorNombre()
     {
         $params = array(
             'nombre' => '',
             'resultado' => array(),
         );

         $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $params['nombre'] = $_POST['nombre'];
             $params['resultado'] = $m->buscarClientesPorNombre($_POST['nombre']);
         }

         require __DIR__ . '/templates/buscarPorNombre.php';
     }

     public function ver()
     {
         if (!isset($_GET['id'])) {
             throw new Exception('Pagina no encontrada');
         }
         $id = $_GET['id'];
         $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
         $cliente = $m->dameCliente($id);
         $params = $cliente;
         require __DIR__ . '/templates/verCliente.php';
     }
 }
?>