<?php 
// Inicia el buffer para acumular todo lo que queremos
// mostrar en el Layout:
ob_start(); 
?>
<h3>Listado de productos</h3>
<table>
    <tr>
        <th>PRODUCTO</th>
        <th>CATEGORIA</th>
        <th>PRECIO</th>
        <th>EXISTENCIAS</th>
    </tr>
    <?php foreach($params['productos'] as $p){ ?>
        <tr>
            <td>
                <a href="index.php?action=verproducto&id=<?=$p->getId()?>">
                    <?=$p->getNombre()?>
                </a>
            </td>
            <td><?=$p->getCategoria()->getNombre()?></td>
            <td><?=$p->getPrecio()?></td>
            <td><?=$p->getExistencias()?></td>
        </tr>
    <?php } ?>
</table>
<?php 
 // Vuelca el buffer a una variable: $contenido 
 $contenido = ob_get_clean(); 

 // Mostrar la plantilla principal:
 include 'layout.php' 
 ?>