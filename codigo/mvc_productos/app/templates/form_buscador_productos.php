<?php 
// Inicia el buffer para acumular todo lo que queremos
// mostrar en el Layout:
ob_start(); 
?>
<h3>Buscador de Productos</h3>
<form action="index.php?action=buscarproductos" method="post">

    <label for="categoria">Categoría</label>
    <select name="categoria" id="categoria">
        <option value="0">Seleccione una categoría ...</option>
        <?php foreach($params['categorias'] as $cat){ ?>
            <option value="<?=$cat->getId()?>"><?=$cat->getNombre()?></option>
        <?php } ?>   
    </select>

    <label for="precio">Precio</label>
    <div>
        <label for="min">Mínimo</label>
        <input type="number" name="min" id="min">
        <label for="max">Máximo</label>
        <input type="number" name="max" id="max">
    </div>

    <input type="submit" value="Grabar">
    <input type="reset" value="Cancelar">
</form>
<?php 
 // Vuelca el buffer a una variable: $contenido 
 $contenido = ob_get_clean(); 

 // Mostrar la plantilla principal:
 include 'layout.php' 
 ?>