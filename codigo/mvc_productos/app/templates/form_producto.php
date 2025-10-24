<?php 
// Inicia el buffer para acumular todo lo que queremos
// mostrar en el Layout:
ob_start(); 
?>
<h3>Nuevo Producto</h3>
<form action="index.php?action=grabarproducto" method="post">
    <label for="nombre">Nombre del producto</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="categoria">Categoría</label>
    <select name="categoria" id="categoria">
        <option value="0">Seleccione una categoría ...</option>
        <?php foreach($params['categorias'] as $cat){ ?>
            <option value="<?=$cat->getId()?>"><?=$cat->getNombre()?></option>
        <?php } ?>   
    </select>

    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio">

    <label for="existencias">Existencias</label>
    <input type="number" name="existencias" id="existencias">

    <input type="submit" value="Grabar">
    <input type="reset" value="Cancelar">

</form>
<?php 
 // Vuelca el buffer a una variable: $contenido 
 $contenido = ob_get_clean(); 

 // Mostrar la plantilla principal:
 include 'layout.php' 
 ?>