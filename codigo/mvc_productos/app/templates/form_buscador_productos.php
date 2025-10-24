<?php 
// Inicia el buffer para acumular todo lo que queremos
// mostrar en el Layout:
ob_start(); 
?>
<h3>Buscador de Productos</h3>
<?php 
 // Vuelca el buffer a una variable: $contenido 
 $contenido = ob_get_clean(); 

 // Mostrar la plantilla principal:
 include 'layout.php' 
 ?>