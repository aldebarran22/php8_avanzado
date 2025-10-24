<?php 
    require_once 'Categoria.php';
    require_once 'Producto.php';
    require_once 'ProductoDAO.php';

    // Prueba con la conexión:
    $pdo = new PDO("mysql:host=localhost;dbname=empresa3;charset=utf8mb4", 'root', 'antonio', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // devuelve arrays asociativos
    ]);

    // Construye un dao:
    $dao = new ProductoDAO($pdo);
    $categorias = $dao->selectCategorias();   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#categoria").on('change', function() {

                // Si queremos obtener el id de la opcion seleccionada:
                //const categoriaSeleccionada = $(this).val() 

                // Obtener el texto de la opcion seleccionada:
                const categoriaSeleccionada = $('#categoria option:selected').text()
                
                // Hacer la peticion para obtener el combo cargado
                $.ajax({
                    url: 'getCombo.php',
                    method: 'POST',
                    data: 'categoria='+categoriaSeleccionada,
                    success: function(respuesta) {
                        $("#capa_combo").html(respuesta)
                    },
                    error: function(e) {
                        alert('Error: '+e)
                    }
                })
            })
        })            
    </script>
</head>
<body>
    <h3>Ejemplo de dos combos dependientes con jquery</h3>
    <label for="categoria">Categoría</label>
    <select name="categoria" id="categoria">
        <option value="">Seleccionar categoría ...</option>
        <?php foreach($categorias as $c){ ?>
            <option value="<?=$c->getId()?>"><?=$c->getNombre()?></option>
        <?php } ?>
    </select>
    <br>
    <br>
    <label for="producto">Producto</label>
    <div id="capa_combo">
        <select name="producto" id="producto"></select>
    </div>
</body>
</html>